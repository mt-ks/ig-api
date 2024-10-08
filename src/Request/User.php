<?php


namespace IgApi\Request;


use IgApi\Instagram;
use IgApi\Model\FollowListResponse;
use IgApi\Model\RecentActivityResponse;
use IgApi\Model\TopSearchResponse;
use IgApi\Model\UserInfoResponse;
use IgApi\Model\UsersSearchResponse;
use IgApi\Utils\Encryption;

class User
{
    private Instagram $ig;
    public function __construct(Instagram $ig)
    {
        $this->ig = $ig;
    }

    public function removeFollower($userId)
    {
        return $this->ig->request("friendships/remove_follower/{$userId}/")
            ->addPost('_uuid', $this->ig->settings->info->getUuid())
            ->addPost('_uid', $this->ig->settings->info->getUserId())
            ->addPost('_csrftoken', $this->ig->settings->info->getToken())
            ->addPost('user_id', $userId)
            ->addPost('radio_type', 'wifi-none')
            ->execute()
            ->getDecodedResponse();
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
     * @param $username
     * @param string $module
     * @return \IgApi\Model\UserInfoResponse
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function getInfoByName($username, $module = 'feed_timeline')
    {
        $request = $this->ig->request("users/{$username}/usernameinfo/")
            ->addParam('from_module', $module)
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

    /**
     * @param $query
     * @return \IgApi\Model\UsersSearchResponse
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function searchUser($query) : UsersSearchResponse{
        $request = $this->ig->request('users/search/')
            ->addParam('search_surface','user_search_page')
            ->addParam('timezone_offset','0')
            ->addParam('q',$query)
            ->addParam('count',30)
            ->execute();

        return (new UsersSearchResponse($request->getDecodedResponse()));
    }

    /**
     * @return \IgApi\Model\RecentActivityResponse
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function getRecentActivityInbox(): RecentActivityResponse
    {
        $request = $this->ig->request('news/inbox/')
            ->execute();

        return (new RecentActivityResponse($request->getDecodedResponse(true)));
    }

}
