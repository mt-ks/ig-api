<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class UserInfoResponse
 * @package IgApi\Model
 * @method User getUser()
 * @method getStatus()
 */
class UserInfoResponse extends MainMapper
{
    public const MAP = [
        'user' => User::class,
        'status' => 'string'
    ];
}