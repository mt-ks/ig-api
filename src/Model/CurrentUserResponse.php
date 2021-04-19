<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class CurrentUserResponse
 * @package IgApi\Model
 * @method \IgApi\Model\User getUser()
 * @method getStatus()
 */
class CurrentUserResponse extends MainMapper
{
    public const MAP = [
        "user" => User::class,
        'status' => 'string'
    ];
}
