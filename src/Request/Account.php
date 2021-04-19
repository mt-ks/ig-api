<?php


namespace IgApi\Request;


use IgApi\Instagram;
use IgApi\Model\CurrentUserResponse;

class Account
{
    private Instagram $ig;
    public function __construct(Instagram $ig)
    {
        $this->ig = $ig;
    }

    /**
     * @return \IgApi\Model\CurrentUserResponse
     * @throws \IgApi\Exceptions\InstagramRequestException
     */
    public function getCurrentUser(): CurrentUserResponse
    {
        $request = $this->ig->request('accounts/current_user/')
            ->addParam('edit','true')
            ->execute()
            ->getDecodedResponse();

        return new CurrentUserResponse($request);
    }
}
