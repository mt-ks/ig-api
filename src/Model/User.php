<?php


namespace IgApi\Model;



use EJM\MainMapper;

/**
 * @method getPk()
 * @method boolean hasPk()
 * @method getUsername()
 * @method boolean hasUsername()
 * @method getFullName()
 * @method boolean hasFullName()
 * @method getIsPrivate()
 * @method boolean hasIsPrivate()
 * @method getProfilePicUrl()
 * @method boolean hasProfilePicUrl()
 * @method getProfilePicId()
 * @method boolean hasProfilePicId()
 * @method getIsVerified()
 * @method boolean hasIsVerified()
 * @method getHasAnonymousProfilePicture()
 * @method boolean hasHasAnonymousProfilePicture()
 * @method getMediaCount()
 * @method boolean hasMediaCount()
 * @method getFollowerCount()
 * @method boolean hasFollowerCount()
 * @method getFollowingCount()
 * @method boolean hasFollowingCount()
 * @method getExternalUrl()
 * @method boolean hasExternalUrl()
 * @method getTotalIgtvVideos()
 * @method boolean hasTotalIgtvVideos()
 * @method HdProfilePicVersions[] getHdProfilePicVersions()
 * @method boolean hasHdProfilePicVersions()
 * @method getPhoneNumber()
 * @method boolean hasPhoneNumber()
 * @method getGender()
 * @method boolean hasGender()
 * @method getEmail()
 * @method boolean hasEmail()
 * @method \IgApi\Model\FriendshipStatus getFriendshipStatus()
 * @method boolean hasFriendshipStatus()
 */

class User extends MainMapper {
    public const MAP =
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
            'phone_number' => 'string',
            'gender' => 'int',
            'email' => 'string',
            'friendship_status' => FriendshipStatus::class
        ];
}
