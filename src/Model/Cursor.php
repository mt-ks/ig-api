<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class Cursor
 * @package IgApi\Model
 * @method string getCursorThreadV2Id()
 * @method boolean hasCursorThreadV2Id()
 * @method string getCursorTimestampSeconds()
 * @method boolean hasCursorTimestampSeconds()
 */
class Cursor extends MainMapper
{
    public const MAP = [
        'cursor_thread_v2_id' => 'string',
        'cursor_timestamp_seconds' => 'string'
    ];
}
