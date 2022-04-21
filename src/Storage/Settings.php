<?php


namespace IgApi\Storage;
use IgApi\Instagram;
use IgApi\Model\StorageModel;
use IgApi\Utils\Encryption;
use IgApi\Utils\UserAgent;
use JsonException;
use RuntimeException;

class Settings
{
    protected string $cookieDirectory;
    protected string $sessionFile;
    protected Instagram $ig;
    private array $userData;
    public StorageModel $info;

    /**
     * Settings constructor.
     * @param Instagram $ig
     * @param array $settings
     */
    public function __construct(Instagram $ig,$settings = [])
    {
        $this->ig = $ig;
        $this->cookieDirectory = $settings['cookiesDir'] ?? __DIR__.'/sessions/';
        $this->sessionFile = $this->cookieDirectory.$this->ig->username.'-cookies.dat';
        $this->checkDirectory();
        $this->checkUserStorage();
    }


    /**
     * @param $key
     * @param $value
     * @return Settings
     */
    public function set($key,$value) : self
    {
        if (array_key_exists($key,$this->userData) || array_key_exists($key,self::extraStorageField())){
            $this->userData[$key] = $value;
        }
        $this->updateInfo();
        return $this;
    }

    public function get($key)
    {
        return $this->userData[$key] ?? null;
    }


    public function save() : void
    {
        $this->saveFile();
    }


    protected static function checkUserAgentVersion($currentUserAgent){
        $currentVersion = \IgApi\Constants::IG_VERSION;
        preg_match("@Instagram (.*?) Android@si",$currentUserAgent,$fetchUserVersion);
        if ($fetchUserVersion[1] != $currentVersion){
            $currentUserAgent = str_replace($fetchUserVersion[1],$currentVersion,$currentUserAgent);
        }
        return $currentUserAgent;
    }

    protected function checkUserStorage() : void
    {
        if (!file_exists($this->sessionFile))
        {
            $this->saveFile($this->storageModel());
        }

        $this->userData   = json_decode(file_get_contents($this->sessionFile), true, 512, JSON_THROW_ON_ERROR);
        $checkUserAgent   = self::checkUserAgentVersion($this->userData['useragent']);
        if ($checkUserAgent != $this->userData['useragent']){
            $this->set('useragent',$checkUserAgent)->save();
        }

        $this->updateInfo();
    }

    /**
     * @param null $data
     */
    protected function saveFile($data = null) : void
    {
        $fp = fopen($this->sessionFile,"wb");
        fwrite($fp, json_encode($data ?? $this->userData));
        fclose($fp);
    }


    protected function updateInfo() : void
    {
        $this->info =  new StorageModel($this->userData);
    }

    protected function checkDirectory(): void
    {
        if (!file_exists($this->cookieDirectory) && !mkdir($concurrentDirectory = $this->cookieDirectory) && !is_dir($concurrentDirectory)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
        }
    }

    public function hasInstaId(): bool
    {
        $userId = $this->info->getUserId();
        return $userId !== null && $userId !== "";
    }

    /**
     * @return array
     */
    protected function storageModel() : array
    {

        $megaRandomHash = md5(number_format(microtime(true), 7, '', ''));
        return [
            'username' => $this->ig->username,
            'user_id'  => '',
            'bearer_token' => '',
            'token'    => '',
            'cookie'   => '',
            'public_key' => '',
            'public_key_id' => '',
            'useragent' => UserAgent::randomUA(),
            'device_id' => Encryption::generateUUID(true),
            'phone_id' => Encryption::generateUUID(true),
            'advertising_id' => Encryption::generateUUID(true),
            'uuid' => Encryption::generateUUID(true),
            'last_login' => '',
            'android_id' =>  'android-' . substr($megaRandomHash, 16)
        ];
    }

    protected static function extraStorageField() : array{
        return ['bearer_token' => '','x_mid' => ''];
    }
}
