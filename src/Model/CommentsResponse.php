<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class CommentsResponse
 * @package IgApi\Model
 * @method \IgApi\Model\Comment[] getComments()
 * @method boolean hasComments()
 * @method boolean getCaptionIsEdited()
 * @method boolean hasCaptionIsEdited()
 * @method boolean getHasMoreComments()
 * @method boolean hasHasMoreComments()
 * @method boolean getNextMinId()
 * @method boolean hasNextMinId()
 * @method int getCommentCount()
 * @method boolean hasCommentCount()
 */
class CommentsResponse extends MainMapper
{
    public const MAP = [
        'comments' => Comment::class.'[]',
        'caption_is_edited' => 'boolean',
        'has_more_comments' => 'boolean',
        'next_min_id' => 'string',
        'comment_count' => 'int'
    ];
}
