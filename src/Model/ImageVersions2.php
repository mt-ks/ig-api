<?php


namespace IgApi\Model;


use EJM\MainMapper;
/**
 * @method Candidates[] getCandidates()
 * @method boolean hasCandidates()
 * @method AdditionalCandidates getAdditionalCandidates()
 * @method boolean hasAdditionalCandidates()
 */

class ImageVersions2 extends MainMapper {

    public const MAP =
        [
            'candidates' => Candidates::class.'[]',
            'additional_candidates' => AdditionalCandidates::class,
        ];
}
