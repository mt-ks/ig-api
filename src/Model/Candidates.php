<?php


namespace IgApi\Model;

use EJM\MainMapper;

/**
 * @method getWidth()
 * @method boolean hasWidth()
 * @method getHeight()
 * @method boolean hasHeight()
 * @method getUrl()
 * @method boolean hasUrl()
 * @method getScansProfile()
 * @method boolean hasScansProfile()
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
