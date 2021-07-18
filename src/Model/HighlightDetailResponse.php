<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class HighlightDetailResponse
 * @package IgApi\Model
 * @method \IgApi\Model\Reel[] getReels()
 * @method boolean hasReels()
 * @method getStatus()
 * @method hasStatus()
 */
class HighlightDetailResponse extends MainMapper
{
    public const MAP = [
        'reels' => Reel::class.'[]',
        'status' => 'string'
    ];
}
