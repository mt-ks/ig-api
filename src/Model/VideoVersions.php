<?php

namespace IgApi\Model;

use EJM\MainMapper;

/**
 * @method string getId()
 * @method string getUrl()
 * @method int getWidth()
 * @method int getHeight()
 */
class VideoVersions extends MainMapper
{

    public const MAP = [
        'type' => 'int',
        'width' => 'int',
        'id' => 'string',
        'url' => 'string'
    ];
}