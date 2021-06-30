<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class Thread
 * @package IgApi\Model
 * @method boolean getApprovalRequiredForNewMembers()
 * @method boolean hasApprovalRequiredForNewMembers()
 * @method boolean getArchived()
 * @method boolean hasArchived()
 * @method User getInviter()
 * @method boolean hasInviter()
 * @method string getThreadId()
 * @method string getThreadTitle()
 * @method string getThreadType()
 * @method string getThreadV2Id()
 * @method User[] getUsers()
 * @method boolean hasUsers()
 */
class Thread extends MainMapper
{
    public const MAP = [
        'approval_required_for_new_members' => 'boolean',
        'archived' => 'boolean',
        'assigned_admin_id' => 'int',
        'business_thread_folder' => 'int',
        'canonical' => 'boolean',
        'folder' => 'int',
        'has_groups_xac_ineligible_user' => 'boolean',
        'has_newer' => 'boolean',
        'has_older' => 'boolean',
        'has_restricted_user' => 'boolean',
        'input_mode' => 'int',
        'inviter' => User::class,
        'is_close_friend_thread' => 'boolean',
        'is_group' => 'boolean',
        'is_pin' => 'boolean',
        'is_verified_thread' => 'boolean',
        'thread_id' => 'string',
        'thread_title' => 'string',
        'thread_type' => 'string',
        'thread_v2_id' => 'string',
        'users' => User::class.'[]'
    ];
}
