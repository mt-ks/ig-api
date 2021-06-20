<?php


namespace IgApi\Model;


use EJM\MainMapper;

class FriendshipStatus extends MainMapper
{
    public const MAP = [
        'following' => 'bool',
        'is_private' => 'bool',
        'incoming_request' => 'bool',
        'outgoing_request' => 'bool',
        'is_bestie' => 'bool',
        'is_restricted' => 'bool'
    ];
}
