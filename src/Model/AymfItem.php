<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class AymfItem
 * @package IgApi\Model
 * @method User getUser()
 */
class AymfItem extends MainMapper
{
    public const MAP = [
        'user' => User::class,
    ];
}
