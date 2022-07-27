<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * @method CroppedImageVersion getCroppedImageVersion()
 * @method getMediaId()
 * @method FullImageVersion getFullImageVersion()
 */

class CoverMedia extends MainMapper {
    const MAP =
        [
            'cropped_image_version' => CroppedImageVersion::class,
            'media_id' => 'string',
            'full_image_version' => FullImageVersion::class
        ];
}

