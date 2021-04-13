<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * @method Tray[] getTray()
 * @method getShowEmptyState()
 * @method getStatus()
 */

class HighlightsTray extends MainMapper {
    const MAP =
        [
            'tray' => Tray::class."[]",
            'show_empty_state' => 'string',
            'status' => 'string',
        ];
}
