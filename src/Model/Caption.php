<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * @method getPk()
 * @method getUserId()
 * @method getText()
 * @method getType()
 * @method getCreatedAt()
 * @method getCreatedAtUtc()
 * @method getContentType()
 * @method getStatus()
 * @method getBitFlags()
 * @method getDidReportAsSpam()
 * @method getShareEnabled()
 * @method User getUser()
 * @method getIsCovered()
 * @method getMediaId()
 * @method getHasTranslation()
 * @method getPrivateReplyStatus()
 */

class Caption extends MainMapper{
    public const MAP =
        [
            'pk' => 'string',
            'user_id' => 'string',
            'text' => 'string',
            'type' => 'string',
            'created_at' => 'string',
            'created_at_utc' => 'string',
            'content_type' => 'string',
            'status' => 'string',
            'bit_flags' => 'string',
            'did_report_as_spam' => 'string',
            'share_enabled' => 'string',
            'user' => User::class,
            'is_covered' => 'string',
            'media_id' => 'string',
            'has_translation' => 'string',
            'private_reply_status' => 'string',
        ];
}
