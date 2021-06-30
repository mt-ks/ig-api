<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class RecentActivityResponse
 * @package IgApi\Model
 * @method string getStatus()
 * @method Aymf getAymf()
 */
class RecentActivityResponse extends MainMapper
{
    public const MAP = [
        'aymf' => Aymf::class,
        'status' => 'string'
    ];
}
