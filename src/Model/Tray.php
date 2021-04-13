<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * @method getId()
 * @method getLatestReelMedia()
 * @method getSeen()
 * @method getCanReply()
 * @method getCanGifQuickReply()
 * @method getCanReshare()
 * @method getReelType()
 * @method getIsSensitiveVerticalAd()
 * @method CoverMedia getCoverMedia()
 * @method User getUser()
 * @method getRankedPosition()
 * @method getTitle()
 * @method getCreatedAt()
 * @method getIsPinnedHighlight()
 * @method getSeenRankedPosition()
 * @method getPrefetchCount()
 * @method getMediaCount()
 * @method getContainsStitchedMediaBlockedByRm()
 */

class Tray extends MainMapper {
    const MAP =
        [
            'id' => 'string',
            'latest_reel_media' => 'string',
            'seen' => 'string',
            'can_reply' => 'string',
            'can_gif_quick_reply' => 'string',
            'can_reshare' => 'string',
            'reel_type' => 'string',
            'is_sensitive_vertical_ad' => 'string',
            'cover_media' => CoverMedia::class,
            'user' => User::class,
            'ranked_position' => 'string',
            'title' => 'string',
            'created_at' => 'string',
            'is_pinned_highlight' => 'string',
            'seen_ranked_position' => 'string',
            'prefetch_count' => 'string',
            'media_count' => 'string',
            'contains_stitched_media_blocked_by_rm' => 'string'
        ];
}

