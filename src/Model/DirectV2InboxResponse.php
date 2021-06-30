<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class DirectV2InboxResponse
 * @package IgApi\Model
 * @method User getViewer()
 * @method boolean hasViewer()
 * @method \IgApi\Model\Inbox getInbox()
 * @method boolean hasInbox()
 * @method string getStatus()
 * @method boolean hasStatus()
 * @method int getPendingRequestsTotal()
 * @method boolean hasPendingRequestsTotal()
 */
class DirectV2InboxResponse extends MainMapper
{
    public const MAP = [
        'viewer' => User::class,
        'inbox'  => Inbox::class,
        'status' => 'string',
        'pending_requests_total' => 'int'
    ];
}
