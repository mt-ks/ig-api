<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class Aymf
 * @package IgApi\Model
 *
 * @method boolean getMoreAvailable()
 * @method boolean hasItems()
 * @method AymfItem[] getItems()
 */
class Aymf extends MainMapper
{
    public const MAP = [
        'items' => AymfItem::class.'[]',
        'more_available' => 'boolean'
    ];
}
