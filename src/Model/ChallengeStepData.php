<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class ChallengeStepData
 * @package IgApi\Model
 * @method getChoice()
 * @method getEmail()
 * @method getPhoneNumber()
 */
class ChallengeStepData extends MainMapper
{
    public const MAP = [
        'choice' => 'string',
        'phone_number' => 'string',
        'email' => 'string'
    ];
}
