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
        ];
}
