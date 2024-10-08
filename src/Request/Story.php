<?php


namespace IgApi\Request;


use IgApi\Constants;
use IgApi\Instagram;
use IgApi\Model\HighlightDetailResponse;
use IgApi\Model\HighlightsTray;
use IgApi\Model\StoryFeedResponse;

class Story
{
    private Instagram $ig;
    public function __construct(Instagram $ig)
    {
        $this->ig = $ig;
    }

    /**
     * @param $userId
     * @return \IgApi\Model\HighlightsTray
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function getHighlightsTray($userId): HighlightsTray
    {
        $request = $this->ig->request("highlights/{$userId}/highlights_tray/")
            ->execute();
        return new HighlightsTray($request->getDecodedResponse());
    }

    /**
     * @param $highlightId
     * @return mixed
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function getHighlightDetail($highlightIds = []){

        $request = $this->ig->request('feed/reels_media/')
            ->addPost('exclude_media_ids','[]')
            ->addPost('source','reel_highlight_profile')
            ->addPost('_uid',$this->ig->settings->info->getUserId())
            ->addPost('_uuid',$this->ig->settings->info->getUuid())
            ->addPost('user_ids',$highlightIds)
            ->execute();
        return new HighlightDetailResponse($request->getDecodedResponse());
    }


    /**
     * @param $userId
     * @return \IgApi\Model\StoryFeedResponse
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function getStory($userId)
    {
        $request = $this->ig->request("feed/user/{$userId}/story/")
            ->execute()
            ->getDecodedResponse();
        return new StoryFeedResponse($request);
    }

    public function getReelsTray(){
        $request = $this->ig->request("feed/reels_tray/")
            ->setIsIgPost(false)
            ->addPost('supported_capabilities_new',json_encode(Constants::SUPPORTED_CAPABILITIES_NEW))
            ->addPost('reason','cold_start')
            ->addPost('timezone_offset',10800)
            ->addPost('tray_session_id','')
            ->addPost('request_id','')
            ->addPost('_uuid',$this->ig->settings->info->getUuid())
            ->execute()
            ->getResponse();
        return $request;
    }

}
