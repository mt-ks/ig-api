<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class ChallengeStepData
 * @package IgApi\Model
 * @method getChoice()
 * @method getDecisionClassification()
 * @method getEnrollmentReason()
 * @method getEnrollmentSystemContext()
 * @method getEntrollmentTime()
 * @method getSigpToHl()
 * @method getSystemId()
 * @method getTakeDownUxTemplate()
 * @method getViolationType()
 * @method getRenderType()
 * @method getSecureContactPointTypeEmail()
 * @method getTrustedEmail()
 * @method getTrustedEmailSignature()
 * @method getTrustedEmailOrigin()
 * @method getEmail()
 * @method getSecureContactPointTypePhone()
 * @method getTrustedPhoneNumber()
 * @method getTrustedPhoneNumberOrigin()
 * @method getPhoneNumber()
 */
class ChallengeStepData extends MainMapper
{
    public const MAP = [
        'decision_classification' => 'string',
        'enrollment_reason' => 'string',
        'enrollment_system_context' => 'string',
        'enrollment_time' => 'string',
        'sigp_to_hl' => 'bool',
        'system_id' => 'string',
        'take_down_ux_template' => 'string',
        'violation_type' => 'string',
        'render_type' => 'int',
        'secure_contact_point_type_email' => 'string',
        'trusted_email' => 'string',
        'trusted_email_signature' => 'string',
        'trusted_email_origin' => 'string',
        'email' => 'string',
        'secure_contact_point_type_phone' => 'string',
        'trusted_phone_number' => 'string',
        'trusted_phone_number_signature' => 'string',
        'trusted_phone_number_origin' => 'string',
        'phone_number' => 'string',
        'choice' => 'string',
    ];
}
