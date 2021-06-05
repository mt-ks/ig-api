<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class TwoFactorResponse
 * @package IgApi\Model
 * @method getMessage()
 * @method getStatus()
 * @method getErrorType()
 * @method getTwoFactorRequired()
 * @method TwoFactorInfo getTwoFactorInfo()
 */
class TwoFactorResponse extends MainMapper
{
    public const MAP = [
        'message' => 'string',
        'two_factor_required' => 'int',
        'two_factor_info' => TwoFactorInfo::class,
        'status' => 'string',
        'error_type' => 'string'
    ];
}
