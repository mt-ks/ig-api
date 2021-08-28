<?php


namespace IgApi;
use EJM\MainMapper;
use IgApi\Exceptions\InstagramRequestException;
use IgApi\Model\ChallengeDetailModel;
use IgApi\Model\CheckTwoFactorNotification;
use IgApi\Model\LoginResponse;
use IgApi\Request\Account;
use IgApi\Request\Direct;
use IgApi\Request\Media;
use IgApi\Request\Story;
use IgApi\Request\Timeline;
use IgApi\Request\User;
use IgApi\Storage\Settings;
use IgApi\Utils\Encryption;
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
     * @var \IgApi\Request\Direct
     */
    public Direct $direct;

    /**
     * @var \IgApi\Request\Media
     */
    public Media $media;

    /**
     * Instagram constructor.
     * @param $username
     * @param $password
     * @param array $settings
     */
    public function __construct($username, $password, array $settings = [])
    {
        $this->setAccount($username,$password);
        $this->settings = new Settings($this,$settings);
        $this->story = new Story($this);
        $this->user  = new User($this);
        $this->timeline = new Timeline($this);
        $this->account = new Account($this);
        $this->direct = new Direct($this);
        $this->media = new Media($this);
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

        if (empty($pubKeyId) || $pubKeyId === ""){
            throw new InstagramRequestException($request,"Public Id Missing");
        }

        if (empty($pubKey) || $pubKey === ""){
            throw new InstagramRequestException($request,"Public Id Missing");
        }


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
     * @param $challengePath
     * @return mixed
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function getChallengeDetail($challengePath)
    {
        $response = $this->request($challengePath)
            ->addParam('gui',$this->settings->info->getUuid())
            ->addParam('device_id',$this->settings->info->getDeviceId())
            ->execute()
            ->getDecodedResponse();

        return new ChallengeDetailModel($response);
    }

    /**
     * @param $path
     * @param $choice : 0 : phone_number, 1 : email
     * @return mixed
     * @throws \IgApi\Exceptions\InstagramRequestException
     * [step_name, step_data[form_type=phone_number]...]
     */
    public function sendChallengeCode($path,$choice)
    {
        return $this->request($path)
            ->addPost('_csrftoken',$this->settings->info->getToken())
            ->addPost('choice',$choice)
            ->addPost('guid',$this->settings->info->getUuid())
            ->addPost('device_id',$this->settings->info->getDeviceId())
            ->execute()
            ->getDecodedResponse(true);
    }

    public function challengeLoginReview(){
        return $this->request('challenge/')
            ->addPost('choice',0)
            ->addPost('_csrftoken',$this->settings->info->getToken())
            ->addPost('guid', $this->settings->info->getUuid())
            ->addPost('_uuid',$this->settings->info->getUuid())
            ->addPost('device_id', $this->settings->info->getDeviceId())
            ->execute()
            ->getDecodedResponse(true);
    }

    /**
     * @param $path
     * @param $securityCode
     * @return \IgApi\Model\LoginResponse
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function confirmChallengeCode($path,$securityCode): LoginResponse
    {
        $response = $this->request($path)
            ->addPost('security_code',$securityCode)
            ->addPost('_csrftoken',$this->settings->info->getToken())
            ->addPost('guid',$this->settings->info->getUuid())
            ->addPost('device_id',$this->settings->info->getDeviceId())
            ->execute()
            ->getDecodedResponse(true);
        if (isset($response["logged_in_user"])){
            $this->settings->set('user_id',$response["logged_in_user"]["pk"])->save();
            return new LoginResponse($response);
        }
        throw new \RuntimeException("Incorrect request code!");
    }

    /**
     * @param $twoFactorIdentifier
     * @param $verificationCode
     * @return \IgApi\Model\LoginResponse
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function finishTwoFactor($twoFactorIdentifier,$verificationCode,$verificationMethod = 1) : LoginResponse
    {
        $verificationCode = preg_replace('/\s+/', '', $verificationCode);
        $response = $this->request('accounts/two_factor_login/')
            ->addPost('verification_method',$verificationMethod)
            ->addPost('verification_code',$verificationCode)
            ->addPost('two_factor_identifier',$twoFactorIdentifier)
            ->addPost('_csrftoken',$this->settings->info->getToken())
            ->addPost('username',$this->username)
            ->addPost('device_id',$this->settings->info->getDeviceId())
            ->addPost('guid',$this->settings->info->getUuid())
            ->execute()
            ->getDecodedResponse(true);

        if (isset($response["logged_in_user"])){
            $this->settings->set('user_id',$response["logged_in_user"]["pk"])->save();
        }

        return new LoginResponse($response);
    }


    /**
     * @param $identifier
     * @return \IgApi\Model\CheckTwoFactorNotification
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function checkTrustedNotificationStatus($identifier): CheckTwoFactorNotification
    {
        $request = $this->request('two_factor/check_trusted_notification_status/')
            ->addPost('_csrftoken',$this->settings->info->getToken())
            ->addPost('two_factor_identifier',$identifier)
            ->addPost('username',$this->username)
            ->addPost('device_id',$this->settings->info->getDeviceId())
            ->execute()
            ->getDecodedResponse(true);

        return new CheckTwoFactorNotification($request);

    }

    public function sendTwoFactorSMS($twoFactorIdentifier){
       return $this->request('accounts/send_two_factor_login_sms/')
            ->addPost('two_factor_identifier',$twoFactorIdentifier)
            ->addPost('username',$this->username)
            ->addPost('device_id',$this->settings->info->getDeviceId())
            ->addPost('guid',$this->settings->info->getUuid())
            ->addPost('_csrftoken',$this->settings->info->getToken())
            ->execute()
            ->getDecodedResponse(true);
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

        //$this->saveCookie($request);

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
