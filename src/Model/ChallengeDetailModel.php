<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class ChallengeDetailModel
 * @package IgApi\Model
 * @method  getStepName()
 * @method ChallengeStepData getStepData()
 * @method getNonceCode()
 * @method getUserId()
 * @method getChallengeContext()
 * @method getStatus()
 */
class ChallengeDetailModel extends MainMapper
{
    public const MAP = [
        'step_name' => 'string',
        'step_data' => ChallengeStepData::class,
        'nonce_code' => 'string',
        'user_id' => 'string',
        'challenge_context' => 'string',
        'status' => 'string'
    ];
}
