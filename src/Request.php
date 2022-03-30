<?php
namespace IgApi;
use IgApi\Exceptions\InstagramRequestException;
use IgApi\Utils\CookieManager;
use MClient\HttpInterface;
use MClient\Request as MRequest;


class Request extends MRequest{

    protected string $addressPrefix = "i";
    protected string $address = "instagram.com";
    protected string $version = "v1";
    protected string $fullAddress = "";
    protected Instagram $ig;
    protected HttpInterface $execute;
    protected bool $isDisabledCookies = false;

    public function __construct($endpoint,Instagram $ig)
    {
        $this->fullAddress = $this->getAddress().$endpoint;
        parent::__construct($this->fullAddress);
        $this->ig = $ig;
        $this->prepareRequest();
    }

    /**
     * @param $prefix
     * @return $this
     */
    public function setPrefix($prefix) : Request
    {
        $this->addressPrefix = $prefix;
        return $this;
    }

    /**
     * @param $version
     * @return $this
     */
    public function setVersion($version) : Request
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @param $bool
     * @return $this
     */
    public function setDisableCookies($bool) : Request
    {
        $this->isDisabledCookies = $bool;
        return $this;
    }


    /**
     * @return string
     */
    public function getAddress() : string
    {
        return "https://{$this->addressPrefix}.{$this->address}/api/{$this->version}/";
    }

    /**
     * @return MRequest
     */
    public function prepareRequest() : MRequest
    {
        $this->addHeader('Accept-Language','tr-TR, en-US')
            ->setUserAgent($this->ig->settings->info->getUseragent())
            ->addHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8')
            ->addHeader('X-IG-App-ID','567067343352427')
            ->addHeader('X-IG-Capabilities','3brTvx8=')
            ->addHeader('X-IG-Connection-Type','WIFI')
            ->addHeader('X-IG-Android-ID',$this->ig->settings->info->getAndroidId())
            ->addHeader('X-IG-Device-ID',$this->ig->settings->info->getDeviceId())
            ->addHeader('X-DEVICE-ID',$this->ig->settings->info->getDeviceId())
            ->addCurlOptions(CURLOPT_TIMEOUT,20)
            ->setIsIgPost(true);

        if ($this->ig->settings->info->getXMid()){
            $this->addHeader('X-Mid',$this->ig->settings->info->getXMid());
        }

        if (!$this->isDisabledCookies)
        {
            $this->setCookieString($this->ig->settings->info->getCookie());
            if ($this->ig->settings->info->hasBearerToken()){
                $this->addHeader('Authorization',$this->ig->settings->info->getBearerToken());
            }
        }

        if ($this->ig->proxy):
            $this->setProxy($this->ig->proxy);
        endif;

        return $this;
    }


    /**
     * @return \MClient\HttpInterface
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function execute(): HttpInterface
    {
        $this->execute = parent::execute();
        $this->debugHandler();

        if ($this->execute->hasCurlError() || !strpos($this->execute->getHeaderLine('http_code'),"200"))
        {
            throw new InstagramRequestException($this->execute);
        }

        if($this->execute->getResponse() === null || trim($this->execute->getResponse()) === ""){
            throw new InstagramRequestException($this->execute,"Too many API requests.");
        }

        if (!$this->isDisabledCookies){
            $cookieManager = new CookieManager();
            $settings = $this->ig->settings->set('cookie',$cookieManager->cookieMerge($this->ig->settings->info->getCookie(),$this->execute->getCookies()));
            if ($cookieManager->token !== null):
                $settings->set('token',$cookieManager->token);
            endif;

            if ($this->execute->getHeaderLine("ig-set-authorization")){
                $settings->set('bearer_token',$this->execute->getHeaderLine("ig-set-authorization"));
            }

            if ($this->execute->getHeaderLine("ig-set-x-mid")){
                $settings->set('x_mid',$this->execute->getHeaderLine("ig-set-x-mid"));
            }

            $settings->save();

        }

        return $this->execute;
    }


    private function debugHandler() : void
    {
        if ($this->ig->isDebug()){
            $requestType = $this->hasPosts() ? "POST" : "GET";
            echo $requestType.": ".$this->getRequestUri()."\n";
            if ($this->hasPosts()):
                echo "DATA:" . $this->getRequestPosts()."\n\n";
            endif;
            echo "RESPONSE:" . $this->execute->getResponse()."\n";
            echo "USER COOKIE DATA:" . $this->ig->settings->info->asJson();
            echo "\n\n";
        }
    }


}
