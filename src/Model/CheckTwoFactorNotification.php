<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class CheckTwoFactorNotification
 * @package IgApi\Model
 * @method getReviewStatus()
 * @method getStatus()
 */
class CheckTwoFactorNotification extends MainMapper
{
    public const MAP = [
        'review_status' => 'int',
        'status' => 'string'
    ];
}
