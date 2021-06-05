<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class TwoFactorInfo
 * @package IgApi\Model
 * @method getUsername()
 * @method getSmsTwoFactorOn()
 * @method getObfuscatedPhoneNumber()
 * @method getTwoFactorIdentifier()
 */
class TwoFactorInfo extends MainMapper
{
    public const MAP = [
        'username' => 'string',
        'sms_two_factor_on' => 'string',
        'obfuscated_phone_number' => 'string',
        'two_factor_identifier' => 'string'
    ];
}
