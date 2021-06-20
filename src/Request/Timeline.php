<?php


namespace IgApi\Request;


use IgApi\Instagram;
use IgApi\Model\UserFeedResponse;

class Timeline
{
    private Instagram $ig;
    public function __construct(Instagram $ig)
    {
        $this->ig = $ig;
    }

    /**
     * @param $userId
     * @param null $maxId
     * @return \IgApi\Model\UserFeedResponse
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function getUserFeeds($userId, $maxId = null): UserFeedResponse
    {
        $request = $this->ig->request("feed/user/{$userId}/")
            ->addParam('exclude_comment','true')
            ->addParam('only_fetch_first_carousel_media','false');

        if ($maxId !== null):
            $request->addParam('max_id',$maxId);
        endif;
        return new UserFeedResponse($request->execute()->getDecodedResponse());
    }

}
