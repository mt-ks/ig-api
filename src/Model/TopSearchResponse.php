<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class TopSearchResponse
 * @package IgApi\Model
 * @method \IgApi\Model\TopSearchList[] getList()
 * @method getHasMore()
 * @method getPageToken()
 * @method getRankToken()
 * @method getStatus()
 */
class TopSearchResponse extends MainMapper
{
    public const MAP = [
        'list' => TopSearchList::class.'[]',
        'has_more' => 'string',
        'page_token' => 'string',
        'rank_token' => 'string',
        'status' => 'string'
    ];
}
