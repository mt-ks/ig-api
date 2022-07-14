<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class CarouselMedia
 * @package IgApi\Model
 * @method boolean getCanSeeInsightsAsBrand()
 * @method boolean hasCanSeeInsightsAsBrand()
 * @method string getCarouselParentId()
 * @method boolean hasCarouselParentId()
 * @method string getId()
 * @method bool hasId()
 * @method \IgApi\Model\ImageVersions2 getImageVersions2()
 * @method VideoVersions getVideoVersions()
 * @method boolean hasImageVersions2()
 * @method int getMediaType()
 * @method boolean hasMediaType()
 * @method int getOriginalHeight()
 * @method boolean hasOriginalHeight()
 * @method int getOriginalWidth()
 * @method boolean hasOriginalWidth()
 */
class CarouselMedia extends MainMapper
{
    public const MAP = [
        'can_see_insights_as_brand' => 'bool',
        'carousel_parent_id' => 'string',
        'id' => 'string',
        'image_versions2' => ImageVersions2::class,
        'video_versions' => VideoVersions::class,
        'media_type' => 'int',
        'original_height' => 'int',
        'original_width' => 'int'
    ];
}
