<?php


namespace IgApi\Request;


use IgApi\Instagram;
use IgApi\Model\UserFeedResponse;

class Media
{
    private Instagram $ig;
    public function __construct(Instagram $ig)
    {
        $this->ig = $ig;
    }

    /**
     * @param $mediaId
     * @return \IgApi\Model\UserFeedResponse
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function getInfo($mediaId)
    {
        $request = $this->ig->request("media/{$mediaId}/info/")
            ->execute()
            ->getDecodedResponse();

        return new UserFeedResponse($request);
    }
}
