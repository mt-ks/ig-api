<?php


namespace IgApi\Model;


use EJM\MainMapper;
/**
 * @method Candidates[] getCandidates()
 * @method boolean hasCandidates()
 */

class ImageVersions2 extends MainMapper {

    public const MAP =
        [
            'candidates' => Candidates::class.'[]',
        ];
}
