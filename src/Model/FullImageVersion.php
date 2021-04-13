<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * @method getWidth()
 * @method getHeight()
 * @method getUrl()
 */

class FullImageVersion extends MainMapper {
    const MAP =
        [
            'width' => 'string',
            'height' => 'string',
            'url' => 'string',
        ];
}
