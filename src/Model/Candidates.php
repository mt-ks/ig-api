<?php


namespace IgApi\Model;

use EJM\MainMapper;

/**
 * @method getWidth()
 * @method getHeight()
 * @method getUrl()
 * @method getScansProfile()
 */

class Candidates extends MainMapper {

    public const MAP =
        [
            'width' => 'string',
            'height' => 'string',
            'url' => 'string',
            'scans_profile' => 'string'
        ];
}
