<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class HdProfilePicVersions
 * @package IgApi\Model
 * @method getWidth()
 * @method getHeight()
 * @method getUrl()
 */
class HdProfilePicVersions extends MainMapper
{
    public const MAP = [
        'width' => 'int',
        'height' => 'int',
        'url' => 'string'
    ];
}