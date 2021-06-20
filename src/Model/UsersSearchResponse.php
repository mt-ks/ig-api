<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class UsersSearchResponse
 * @package IgApi\Model
 * @method int getNumResults()
 * @method \IgApi\Model\User[] getUsers()
 */
class UsersSearchResponse extends MainMapper
{
    public const MAP = [
        'num_results' => 'int',
        'users' => User::class.'[]'
    ];
}
