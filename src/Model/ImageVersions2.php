<?php


namespace IgApi\Model;


use EJM\MainMapper;
/**
 * @method Candidates[] getCandidates()
 */

class ImageVersions2 extends MainMapper {

    public const MAP =
        [
            'candidates' => Candidates::class.'[]',
        ];
}
