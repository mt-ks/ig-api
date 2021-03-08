<?php


namespace IgApi\Utils;


class Encryption
{
    /**
     * @param bool $keepDashes
     * @return string|string[]
     */
    public static function generateUUID($keepDashes = true) {
        $uuid = sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );

        return $keepDashes ? $uuid : str_replace('-', '', $uuid);
    }


    public static function generateJazoest(
        $phoneId)
    {
        $jazoestPrefix = '2';
        $array = str_split($phoneId);
        $i = 0;
        foreach ($array as $char) {
            $i += ord($char);
        }
        return $jazoestPrefix.strval($i);
    }

    /**
     * @param $password_raw
     * @param $public_key
     * @param $public_key_id
     * @return string
     */
    public static function generate_password_enc($password_raw, $public_key, $public_key_id) : string
    {
        $formatString = "%s:%s:%s:%s";
        $PWD_INSTAGRAM = "#PWD_INSTAGRAM";
        $gen4 = 4;
        $timeInMillis = time();
        $password_enc = self::_encrypt($public_key, $public_key_id, $password_raw, $timeInMillis);

        return sprintf($formatString, $PWD_INSTAGRAM, $gen4, $timeInMillis, $password_enc);
    }

    public static function _encrypt($public_key, $public_key_id, $password_raw, $timeInMillis)  : string
    {
        $key = openssl_random_pseudo_bytes(32);
        $iv = openssl_random_pseudo_bytes(12);

        openssl_public_encrypt($key, $encryptedAesKey, base64_decode($public_key));
        $encrypted = openssl_encrypt($password_raw, 'aes-256-gcm', $key, OPENSSL_RAW_DATA, $iv, $tag, (string)$timeInMillis);

        return base64_encode("\x01" | pack('n', (int)$public_key_id) . $iv . pack('s', strlen($encryptedAesKey)) . $encryptedAesKey . $tag . $encrypted);

    }


}