<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class Inbox
 * @package IgApi\Model
 * @method boolean getBlendedInboxEnabled()
 * @method boolean hasBlendedInboxEnabled()
 * @method boolean getHasOlder()
 * @method boolean hasHasOlder()
 * @method Cursor getNextCursor()
 * @method boolean hasNextCursor()
 * @method string getOldestCursor()
 * @method boolean hasOldestCursor()
 * @method Cursor getPrevCursor()
 * @method boolean hasPrevCursor()
 * @method Thread[] getThreads()
 * @method boolean hasThreads()
 *
 */
class Inbox extends MainMapper
{
    public const MAP = [
        'blended_inbox_enabled' => 'boolean',
        'has_older' => 'boolean',
        'next_cursor' => Cursor::class,
        'oldest_cursor' => 'string',
        'prev_cursor' => Cursor::class,
        'threads' => Thread::class.'[]',
        'unseen_count' => 'int',
        'unseen_count_ts' => 'string'
    ];
}
