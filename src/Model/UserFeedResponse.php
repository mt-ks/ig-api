<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class UserFeedResponse
 * @package IgApi\Model
 * @method Item[] getItems()
 * @method getNumResults()
 * @method getMoreAvailable()
 * @method getNextMaxId()
 * @method getAutoLoadMoreEnabled()
 * @method getStatus()
 */
class UserFeedResponse extends MainMapper
{
    public const MAP = [
        'items' => Item::class.'[]',
        'num_results' => 'int',
        'more_available' => 'bool',
        'next_max_id' => 'string',
        'auto_load_more_enabled' => 'bool',
        'status' => 'string'
    ];
}