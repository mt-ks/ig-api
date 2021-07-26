<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class Comment
 * @package IgApi\Model
 * @method string getPk()
 * @method string getUserId()
 * @method string getText()
 * @method boolean hasText()
 * @method \IgApi\Model\User getUser()
 * @method boolean hasUser()
 */
class Comment extends MainMapper
{
    public const MAP = [
        'pk' => 'string',
        'user_id' => 'string',
        'text' => 'string',
        'type' => 'int',
        'user' => User::class
    ];
}
