<?php

require "../vendor/autoload.php";
$username = "mt.ks0";
$password = "qweqwe07*";
$ig = new \IgApi\Instagram($username,$password);
try {
    $ig->setProxy("bddmedya:3aSwYyA3UqwbRc9v_country-Belgium@proxy.packetstream.io:31112");
    $inf = $ig->login();
    print_r($inf->asArray());
}catch (\IgApi\Exceptions\InstagramRequestException $exception){
    print_r($exception->getMessage());
    if ($exception->isChallenge()){
        //print_r("Challenge Required\n");
       getChallengeDetail($ig,$exception->getChallengeData());
    }
}

function getChallengeDetail(\IgApi\Instagram $ig,\IgApi\Model\ChallengeModel $challenge){
    print_r("Sending Challenge Detail Request\n");
    $path = ltrim($challenge->getChallenge()->getApiPath(),"/");
    try {
        $detail = $ig->getChallengeDetail(ltrim($challenge->getChallenge()->getApiPath(),'/'),urldecode($challenge->getChallenge()->getChallengeContext()));
        $challengeContext = json_decode($detail->getChallengeContext(),true);
        $userId = $challengeContext['user_id'];
        $cni = $challengeContext['cni'];
        bloksTakeChallenge($ig,$userId,$cni,$detail->getNonceCode(),$detail->getChallengeContext());
    }catch (Exception $e){
        print_r($e);
    }
}

function bloksTakeChallenge(\IgApi\Instagram $ig,$userId,$cni,$nonceCode,$challengeContext){
    try {
        print_r("Request Sending Bloks \n");
        $response = $ig->bloks->takeChallenge($userId,$cni,$nonceCode,$challengeContext);
        $encryptedCni = $response->getCni();
        $encryptedUserId = $response->getUserId();
        $ig->bloks->continueChallenge($response->asJson());
        sendConfirmationCode($ig,$response->asJson());
    }catch (Exception $e){
        print_r($e);
    }
}

function sendConfirmationCode(\IgApi\Instagram $ig,$challengeContext){
    print_r("sendConfirmationCode() \n");
    try{
        $send = $ig->bloks->sendChallengeConfirmationCode($challengeContext,0);
        confirmChallengeCode($ig,$challengeContext);
    }catch (Exception $e){
        print_r($e);
    }
}

function confirmChallengeCode(\IgApi\Instagram $ig, $challengeContext){
    print_r("confirmChallengeCode() \n");
    try{
        $send = $ig->bloks->confirmChallengeCode("111111",$challengeContext);
        print_r($send);
    }catch (Exception $e){
        print_r($e);
    }
}