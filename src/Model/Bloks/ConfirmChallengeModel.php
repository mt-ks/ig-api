<?php

namespace IgApi\Model\Bloks;

use EJM\MainMapper;

/**
 * @method getPk()
 * @method getUsername()
 * @method getIsVerified()
 * @method getProfilePicId()
 * @method getProfilePicUrl()
 * @method getPkId()
 * @method getFullName()
 * @method getIsPrivate()
 * @method getHasAnonymousProfilePicture()
 * @method getLikedClipsCount()
 * @method getFbidV2()
 * @method getAllowedCommenterType()
 * @method getReelAutoArchive()
 *
 */
class ConfirmChallengeModel extends MainMapper
{
    public const MAP = [
        'pk' => 'string',
        'username' => 'string',
        'is_verified' => 'string',
        'profile_pic_id' => 'string',
        'profile_pic_url' => 'string',
        'pk_id' => 'string',
        'full_name' => 'string',
        'is_private' => 'string',
        'has_anonymous_profile_picture' => 'string',
        'liked_clips_count' => 'string',
        'fbid_v2' => 'string',
        'allowed_commenter_type' => 'string',
        'reel_auto_archive' => 'string',
    ];

}