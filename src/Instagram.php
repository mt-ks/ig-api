<?php


namespace IgApi;
use IgApi\Model\LoginResponse;
use IgApi\Storage\Settings;
use IgApi\Utils\Encryption;
use JsonException;
use MClient\HttpInterface;

class Instagram
{
    protected Request $request;
    public string $username;
    public string $password;
    public Settings $settings;

    /**
     * Instagram constructor.
     * @param $username
     * @param $password
     * @param array $settings
     * @throws JsonException
     */
    public function __construct($username,$password,$settings = [])
    {
        $this->request  = new Request($this);
        $this->setAccount($username,$password);
        $this->settings = new Settings($this,$settings);
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
     * @throws JsonException
     */
    public function qeSync()
    {
        $request = $this->request->request('qe/sync/')
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
     * @throws JsonException
     */
    public function login()
    {
        $this->zrToken();
        $this->qeSync();
        $request = $this->request->request('accounts/login/')
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
        if (strpos($request->getHeaderLine('http_code'),"200"))
        {
            $this->saveCookie($request);
        }
        $loginResponse = new LoginResponse($request->getDecodedResponse(true));
        $this->settings->set('user_id',$loginResponse->getLoggedInUser()->getPk())->save();
        return $loginResponse;
    }

    /**
     * @return array|mixed|null
     * @throws JsonException
     */
    public function zrToken()
    {
        $request = $this->request->request('zr/token/result/')
            ->addParam('device_id',$this->settings->info->getDeviceId())
            ->addParam('token_hash','')
            ->addParam('custom_device_id',$this->settings->info->getDeviceId())
            ->addParam('fetch_reason','token_expired')
            ->execute();

        $this->saveCookie($request);

        return $request->getResponse();
    }


    public function saveCookie(HttpInterface $request)
    {
        $this->settings
            ->set('token',$request->getCookies('csrftoken'))
            ->set('cookie',$request->getCookies())
            ->save();
    }

}