<?php

namespace IgApi\Model\Bloks;

use EJM\MainMapper;

/**
 * @method getStepName()
 * @method getNonceCode()
 * @method getUserId()
 * @method getCni()
 * @method getIsStateless()
 * @method getChallengeTypeEnum()
 * @method getPresentAsModal()
 */
class TakeChallengeModel extends MainMapper
{
    public const MAP = [
        'step_name' => 'string',
        'nonce_code' => 'string',
        'user_id' => 'string',
        'cni' => 'string',
        'is_stateless' => 'string',
        'challenge_type_enum' => 'string',
        'present_as_modal' => 'string'
    ];
}