<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class Reel
 * @package IgApi\Model
 * @method getId()
 * @method getLatestReelMedia()
 * @method getExpiringAt()
 * @method getSeen()
 * @method getCanReply()
 * @method getCanGifQuickReply()
 * @method getCanReshare();
 * @method getReelType()
 * @method getIsSensitiveVerticalAd()
 * @method \IgApi\Model\User getUser()
 * @method \IgApi\Model\Item[] getItems()
 */
class Reel extends MainMapper
{
    public const MAP = [
        'id' => 'string',
        'latest_reel_media' => 'string',
        'expiring_at' => 'string',
        'seen' => 'string',
        'can_reply' => 'string',
        'can_gif_quick_reply' => 'string',
        'can_reshare' => 'string',
        'reel_type' => 'string',
        'is_sensitive_vertical_ad' => 'string',
        'user' => User::class,
        'items' => Item::class.'[]'
    ];
}