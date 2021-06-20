<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class TopSearchList
 * @package IgApi\Model
 * @method getPosition()
 * @method \IgApi\Model\User getUser()
 */
class TopSearchList extends MainMapper
{
    public const MAP = [
        'position' => 'int',
        'user' => User::class,
    ];
}
