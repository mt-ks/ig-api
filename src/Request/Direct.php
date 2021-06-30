<?php


namespace IgApi\Request;


use IgApi\Instagram;
use IgApi\Model\DirectV2InboxResponse;

class Direct
{
    public Instagram $ig;
    public function __construct(Instagram $ig){
        $this->ig = $ig;
    }

    /**
     * @param null $cursorId
     * @return \IgApi\Model\DirectV2InboxResponse
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function getInbox($cursorId = null): DirectV2InboxResponse
    {
        $request = $this->ig->request('direct_v2/inbox/')
            ->addParam('persistentBadging', 'true')
            ->addParam('use_unified_inbox', 'true');

        if ($cursorId !== null){
            $request->addParam('cursor',$cursorId);
        }

        return (new DirectV2InboxResponse($request->execute()->getDecodedResponse(true)));
    }

}
