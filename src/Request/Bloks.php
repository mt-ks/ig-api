<?php

namespace IgApi\Request;

use IgApi\Constants;
use IgApi\Exceptions\InstagramRequestException;
use IgApi\Instagram;
use IgApi\Model\Bloks\ConfirmChallengeModel;
use IgApi\Model\Bloks\TakeChallengeModel;
use IgApi\Model\CurrentUserResponse;

class Bloks
{
    private Instagram $ig;
    public function __construct(Instagram $ig)
    {
        $this->ig = $ig;
    }


    /**
     * @param $userId
     * @param $cni
     * @param $nonceCode
     * @param $challengeContext
     * @return TakeChallengeModel
     * @throws InstagramRequestException
     */
    public function takeChallenge($userId,$cni,$nonceCode,$challengeContext): TakeChallengeModel
    {
        $bloks = $this->bloksRequest()
            ->addPost('user_id',$userId)
            ->addPost('cni',$cni)
            ->addPost('nonce_code',$nonceCode)
            ->addPost('bk_client_context','{"bloks_version":"'.Constants::BLOKS_VERSION_ID.'","styles_id":"instagram"}')
            ->addPost('fb_family_device_id',$this->ig->settings->info->getDeviceId())
            ->addPost('challenge_context',$challengeContext)
            ->addPost('bloks_versioning_id',Constants::BLOKS_VERSION_ID)
            ->addPost('get_challenge','true')
            ->execute()
            ->getResponse();
        preg_match('/{\\\\\\\(.*?)tep_(.*?)}/m',$bloks,$matches);
        if (!isset($matches[0])){
            throw new \RuntimeException("Bloks page error!");
        }
        $jsonData = json_decode(str_replace('\\','',$matches[0]),true);
        if (!is_array($jsonData)){
            throw new \RuntimeException("Bloks page error v:data!");
        }
        return new TakeChallengeModel($jsonData);
    }

    /**
     * @param $challengeContext - Need encrypted user_id and cid challenge context data.
     * @return string
     * @throws InstagramRequestException
     */
    public function continueChallenge($challengeContext): string
    {
        return $this->bloksRequest()
            ->addPost('should_promote_account_status',0)
            ->addPost('is_bloks_web','False')
            ->addPost('bk_client_context','{"bloks_version":"'.Constants::BLOKS_VERSION_ID.'","styles_id":"instagram"}')
            ->addPost('challenge_context',$challengeContext)
            ->addPost('bloks_versioning_id',Constants::BLOKS_VERSION_ID)
            ->execute()
            ->getResponse();
    }


    /**
     * @param $challengeContext - Need encrypted user_id and cid challenge context data.
     * @param int $choice
     * @return string
     * @throws InstagramRequestException
     */
    public function sendChallengeConfirmationCode($challengeContext, int $choice = 0)
    {
        return $this->bloksRequest()
            ->addPost('should_promote_account_status',0)
            ->addPost('choice',$choice)
            ->addPost('is_bloks_web','False')
            ->addPost('bk_client_context','{"bloks_version":"'.Constants::BLOKS_VERSION_ID.'","styles_id":"instagram"}')
            ->addPost('challenge_context',$challengeContext)
            ->addPost('bloks_versioning_id',Constants::BLOKS_VERSION_ID)
            ->execute()
            ->getResponse();
    }


    /**
     * @param $securityCode
     * @param $challengeContext
     * @return \MClient\HttpInterface
     * @throws InstagramRequestException
     */
    public function confirmChallengeCode($securityCode,$challengeContext)
    {
         return $this->bloksRequest()
            ->addPost('should_promote_account_status',0)
            ->addPost('security_code',$securityCode)
            ->addPost('is_bloks_web','False')
            ->addPost('bk_client_context','{"bloks_version":"'.Constants::BLOKS_VERSION_ID.'","styles_id":"instagram"}')
            ->addPost('challenge_context',$challengeContext)
            ->addPost('bloks_versioning_id',Constants::BLOKS_VERSION_ID)
            ->execute();
    }

    private function bloksRequest(){
        return $this->ig->request('bloks/apps/com.instagram.challenge.navigation.take_challenge/')
            ->setIsIgPost(false);
    }


}