<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class FollowListResponse
 * @package IgApi\Model
 * @method  \IgApi\Model\User[] getUsers()
 * @method  getBigList();
 * @method  int getPageSize();
 * @method getNextMaxId();
 * @method getStatus()
 */
class FollowListResponse extends MainMapper
{
    public const MAP = [
        'users' => User::class.'[]',
        'big_list' => 'string',
        'page_size' => 'int',
        'next_max_id' => 'int',
        'status' => 'string'
    ];
}