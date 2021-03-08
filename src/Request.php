<?php
namespace IgApi;
use MClient\Request as MRequest;


class Request {

    protected string $addressPrefix = "i";
    protected string $address = "instagram.com";
    protected string $version = "v1";
    protected Instagram $ig;
    public function __construct(Instagram $ig)
    {
        $this->ig = $ig;
    }

    /**
     * @param $prefix
     */
    public function setPrefix($prefix) : void
    {
        $this->addressPrefix = $prefix;
    }


    /**
     * @return string
     */
    public function getAddress() : string
    {
        return "https://{$this->addressPrefix}.{$this->address}/api/{$this->version}/";
    }

    /**
     * @param $endpoint
     * @return MRequest
     */
    public function request($endpoint) : MRequest
    {
        $request = new MRequest($this->getAddress().$endpoint);
        $request->addHeader('Accept-Language','tr-TR, en-US')
            ->setUserAgent($this->ig->settings->info->getUseragent())
            ->setCookieString($this->ig->settings->info->getCookie())
            ->addHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8')
            ->addHeader('X-IG-App-ID','567067343352427')
            ->addHeader('X-IG-Capabilities','3brTvx8=')
            ->addHeader('X-IG-Connection-Type','WIFI')
            ->addHeader('X-IG-Android-ID',$this->ig->settings->info->getAndroidId())
            ->addHeader('X-IG-Device-ID',$this->ig->settings->info->getDeviceId())
            ->addHeader('X-DEVICE-ID',$this->ig->settings->info->getDeviceId())
            ->setIsIgPost(true);

        return $request;
    }

}