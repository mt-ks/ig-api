<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class StoryFeedResponse
 * @package IgApi\Model
 * @method \IgApi\Model\Reel getReel()
 * @method getStatus()
 */
class StoryFeedResponse extends MainMapper
{
    public const MAP = [
        'reel' => Reel::class,
        'status' => 'string'
    ];
}