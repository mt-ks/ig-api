<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class AdditionalCandidates
 * @package IgApi\Model
 * @method Candidates getFirstFrame()
 * @method boolean hasFirstFrame()
 * @method Candidates getIgtvFirstFrame()
 * @method boolean hasIgtvFirstFrame()
 */
class AdditionalCandidates extends MainMapper
{
    public const MAP = [
        'first_frame' => Candidates::class,
        'igtv_first_frame' => Candidates::class
    ];
}
