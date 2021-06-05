<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class ChallengeModel
 * @package IgApi\Model
 * @method getMessage()
 * @method Challenge getChallenge()
 * @method getStatus()
 * @method getErrorType()
 */
class ChallengeModel extends MainMapper
{
    public const MAP = [
        'message' => 'string',
        'challenge' => Challenge::class,
        'status' => 'string',
        'error_type' => 'string'
    ];
}
