<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * @method getWidth()
 * @method getHeight()
 * @method getUrl()
 */

class CroppedImageVersion extends MainMapper {
    const MAP =
        [
            'width' => 'string',
            'height' => 'string',
            'url' => 'string',
        ];
}

