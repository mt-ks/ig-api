<?php


namespace IgApi\Request;


use IgApi\Instagram;
use IgApi\Model\CommentsResponse;
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
     * @return void
     * @throws \IgApi\Exceptions\InstagramRequestException
     * @description : This method for only test actions.
     */
    public function like($mediaId){
        $request = $this->ig->request("media/$mediaId/like/")
            ->addPost('inventory_source','media_or_ad')
            ->addPost('delivery_class','organic')
            ->addPost('media_id',$mediaId)
            ->addPost('radio_type','wifi-none')
            ->addPost('_uid',$this->ig->settings->info->getUserId())
            ->addPost('_uuid',$this->ig->settings->info->getUuid())
            ->addPost('nav_chain','1oG:feed_timeline:1')
            ->addPost('is_carousel_bumped_post','false')
            ->addPost('container_module','feed_timeline')
            ->addPost('feed_position','0')
            ->execute()
            ->getDecodedResponse();
       print_r($request);
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


    /**
     * @param $mediaId
     * @param array $options
     * @return \IgApi\Model\CommentsResponse
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function getComments($mediaId, array $options = []){
        $request = $this->ig->request("media/{$mediaId}/comments/");
        if (isset($options['min_id'])) {
            $request->addParam('min_id', $options['min_id']);
        }
        if (isset($options['max_id'])) {
            $request->addParam('max_id', $options['max_id']);
        }
        return new CommentsResponse($request->execute()->getDecodedResponse());
    }
}
