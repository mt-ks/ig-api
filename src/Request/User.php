<?php


namespace IgApi\Request;


use IgApi\Instagram;
use IgApi\Model\FollowListResponse;
use IgApi\Model\TopSearchResponse;
use IgApi\Model\UserInfoResponse;
use IgApi\Utils\Encryption;

class User
{
    private Instagram $ig;
    public function __construct(Instagram $ig)
    {
        $this->ig = $ig;
    }

    /**
     * @param $userId
     * @return \IgApi\Model\UserInfoResponse
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function getUserInfo($userId)
    {
        $request = $this->ig->request("users/{$userId}/info/")
            ->addParam('from_module','blended_search')
            ->execute()
            ->getDecodedResponse();

        return new UserInfoResponse($request);
    }

    /**
     * @param $userId
     * @param null $maxId
     * @param string $query
     * @return \IgApi\Model\FollowListResponse
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function getFollowers($userId,$maxId = null,$query = '') : FollowListResponse
    {
        $request = $this->ig->request("friendships/{$userId}/followers/")
            ->addParam('includes_hashtags','false')
            ->addParam('search_surface','follow_list_page')
            ->addParam('query',$query)
            ->addParam('enable_groups','true')
            ->addParam('rank_token',Encryption::generateUUID());
        if ($maxId !== null):
            $request->addParam('max_id',$maxId);
        endif;

        return new FollowListResponse($request->execute()->getDecodedResponse());
    }


    /**
     * @param $userId
     * @param null $maxId
     * @param string $query
     * @return \IgApi\Model\FollowListResponse
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function getFollowing($userId,$maxId = null,$query = '') : FollowListResponse
    {
        $request = $this->ig->request("friendships/{$userId}/following/")
            ->addParam('includes_hashtags','false')
            ->addParam('search_surface','follow_list_page')
            ->addParam('query',$query)
            ->addParam('enable_groups','true')
            ->addParam('rank_token',Encryption::generateUUID());
        if ($maxId !== null):
            $request->addParam('max_id',$maxId);
        endif;

        return new FollowListResponse($request->execute()->getDecodedResponse());
    }

    /**
     * @param $query
     * @return \IgApi\Model\TopSearchResponse
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function topSearch($query): TopSearchResponse
    {
        $request = $this->ig->request('fbsearch/topsearch_flat/')
            ->addParam('search_surface','top_search_page')
            ->addParam('timezone_offset','0')
            ->addParam('count','30')
            ->addParam('query',$query)
            ->addParam('context','blended')
            ->execute();

        return (new TopSearchResponse($request->getDecodedResponse()));
    }

}
