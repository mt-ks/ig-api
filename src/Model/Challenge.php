<?php


namespace IgApi\Model;


use EJM\MainMapper;

/**
 * Class Challenge
 * @package IgApi\Model
 * @method getUrl()
 * @method getApiPath()
 * @method getLock()
 * @method getChallengeContext()
 */
class Challenge extends MainMapper
{
    public const MAP = [
        'url' => 'string',
        'api_path' => 'string',
        'hide_webview_header' => 'int',
        'lock' => 'int',
        'challenge_context' => 'string'
    ];
}
