<?php


namespace IgApi\Model;



use EJM\MainMapper;

/**
 * @method getPk()
 * @method getUsername()
 * @method getFullName()
 * @method getIsPrivate()
 * @method getProfilePicUrl()
 * @method getProfilePicId()
 * @method getIsVerified()
 * @method getHasAnonymousProfilePicture()
 * @method getMediaCount()
 * @method getFollowerCount()
 * @method getFollowingCount()
 * @method getExternalUrl()
 * @method getTotalIgtvVideos()
 * @method HdProfilePicVersions[] getHdProfilePicVersions()
 */

class User extends MainMapper {
    const MAP =
        [
            'pk' => 'string',
            'username' => 'string',
            'full_name' => 'string',
            'is_private' => 'string',
            'profile_pic_url' => 'string',
            'profile_pic_id' => 'string',
            'is_verified' => 'string',
            'has_anonymous_profile_picture' => 'string',
            'media_count' => 'int',
            'follower_count' => 'int',
            'following_count' => 'int',
            'biography' => 'string',
            'external_url' => 'string',
            'total_igtv_videos' => 'int',
            'hd_profile_pic_versions' => HdProfilePicVersions::class.'[]',
        ];
}
