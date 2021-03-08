<?php


namespace IgApi\Model;
use EJM\MainMapper;

/**
 * @method LoggedInUser getLoggedInUser()
 * @method getMacLoginNonce()
 * @method getStatus()
 */

class LoginResponse extends MainMapper {
    const MAP =
        [
            'logged_in_user' => LoggedInUser::class,
            'mac_login_nonce' => 'string',
            'status' => 'string',
        ];
}