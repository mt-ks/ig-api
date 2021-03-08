<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * @method getMode()
 * @method getGradient()
 * @method getEmoji()
 * @method getEmojiColor()
 * @method getSelfieSticker()
 */

class Nametag extends MainMapper {
    const MAP =
        [
            'mode' => 'string',
            'gradient' => 'string',
            'emoji' => 'string',
            'emoji_color' => 'string',
            'selfie_sticker' => 'string',
        ];
}
