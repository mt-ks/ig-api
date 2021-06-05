<?php


namespace IgApi;
use IgApi\Model\LoginResponse;
use IgApi\Request\Account;
use IgApi\Request\Story;
use IgApi\Request\Timeline;
use IgApi\Request\User;
use IgApi\Storage\Settings;
use IgApi\Utils\Encryption;
use JsonException;
use MClient\HttpInterface;

class Instagram
{
    public string $username;
    public string $password;
    public Settings $settings;
    protected bool $debug = false;
    public ?string $proxy = null;

    /**
     * @var \IgApi\Request\Story
     */
    public Story $story;

    /**
     * @var \IgApi\Request\User
     */
    public User $user;

    /**
     * @var \IgApi\Request\Timeline
     */
    public Timeline $timeline;

    /**
     * @var \IgApi\Request\Account
     */
    public Account $account;

    /**
     * Instagram constructor.
     * @param $username
     * @param $password
     * @param array $settings
     */
    public function __construct($username,$password,$settings = [])
    {
        $this->setAccount($username,$password);
        $this->settings = new Settings($this,$settings);
        $this->story = new Story($this);
        $this->user  = new User($this);
        $this->timeline = new Timeline($this);
        $this->account = new Account($this);
    }

    /**
     * @param $debug
     */
    public function enableDebug($debug) : void
    {
        $this->debug = $debug;
    }

    /**
     * @return bool
     */
    public function isDebug() : bool
    {
        return $this->debug;
    }

    /**
     * @param $username
     * @param $password
     */
    public function setAccount($username,$password) : void
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @param $proxy
     */
    public function setProxy($proxy) : void
    {
        $this->proxy = $proxy;
    }


    /**
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function qeSync() : void
    {
        $request = $this->request('qe/sync/')
            ->addPost('_csrftoken',$this->settings->info->getToken())
            ->addPost('id',$this->settings->info->getDeviceId())
            ->addPost('server_config_retrieval',1)
            ->addPost('experiments',Constants::EXPERIMENTS)
            ->execute();

        $pubKeyId = $request->getHeaderLine('ig-set-password-encryption-key-id');
        $pubKey   = $request->getHeaderLine('ig-set-password-encryption-pub-key');


        $this->settings->set('public_key',$pubKey)->set('public_key_id',$pubKeyId)->save();
    }


    /**
     * @return \IgApi\Model\LoginResponse
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function login() : LoginResponse
    {
        $this->zrToken();
        $this->qeSync();
        $request = $this->request('accounts/login/')
            ->addPost('jazoest',Encryption::generateJazoest($this->settings->info->getPhoneId()))
            ->addPost('country_codes','[{"country_code":"1","source":["default"]}]')
            ->addPost('phone_id',$this->settings->info->getPhoneId())
            ->addPost('enc_password',Encryption::generate_password_enc($this->password,$this->settings->info->getPublicKey(),$this->settings->info->getPublicKeyId()))
            ->addPost('_csrftoken',$this->settings->info->getToken())
            ->addPost('username',$this->username)
            ->addPost('adid',$this->settings->info->getAdvertisingId())
            ->addPost('guid',$this->settings->info->getUuid())
            ->addPost('device_id',$this->settings->info->getDeviceId())
            ->addPost('google_tokens','[]')
            ->addPost('login_attempt_count',0)
            ->execute();



        $loginResponse = new LoginResponse($request->getDecodedResponse(true));
        $this->settings->set('user_id',$loginResponse->getLoggedInUser()->getPk())->save();
        return $loginResponse;
    }


    /**
     * @return string
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function zrToken() : string
    {
        $request = $this->request('zr/token/result/')
            ->addParam('device_id',$this->settings->info->getDeviceId())
            ->addParam('token_hash','')
            ->addParam('custom_device_id',$this->settings->info->getDeviceId())
            ->addParam('fetch_reason','token_expired')
            ->execute();

        $this->saveCookie($request);

        return $request->getResponse();
    }


    /**
     * @param \MClient\HttpInterface $request
     */
    public function saveCookie(HttpInterface $request) : void
    {
        $this->settings
            ->set('token',$request->getCookies('csrftoken'))
            ->set('cookie',$request->getCookies())
            ->save();
    }


    public function request($endpoint) : Request
    {
        return (new Request($endpoint,$this));
    }

}
