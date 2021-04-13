<?php


namespace IgApi\Request;


use IgApi\Instagram;
use IgApi\Model\HighlightsTray;

class Story
{
    public Instagram $ig;
    public function __construct(Instagram $ig)
    {
        $this->ig = $ig;
    }

    /**
     * @param $userId
     * @return \IgApi\Model\HighlightsTray
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function getHighlightsTray($userId)
    {
        $request = $this->ig->request("highlights/{$userId}/highlights_tray/")
            ->execute();
        return new HighlightsTray($request->getDecodedResponse());
    }

}