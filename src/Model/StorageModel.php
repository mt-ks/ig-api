<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * @method getUsername()
 * @method getUserId()
 * @method getToken()
 * @method getCookie()
 * @method getPublicKey()
 * @method getPublicKeyId()
 * @method getUseragent()
 * @method getDeviceId()
 * @method getPhoneId()
 * @method getAdvertisingId()
 * @method getUuid()
 * @method getLastLogin()
 * @method getAndroidId()
 */

class StorageModel extends MainMapper{
    public const MAP =
        [
            'username' => 'string',
            'user_id' => 'string',
            'token' => 'string',
            'cookie' => 'string',
            'public_key' => 'string',
            'public_key_id' => 'string',
            'useragent' => 'string',
            'device_id' => 'string',
            'phone_id' => 'string',
            'advertising_id' => 'string',
            'uuid' => 'string',
            'last_login' => 'string',
            'android_id' => 'string',
        ];
}
