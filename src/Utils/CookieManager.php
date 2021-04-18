<?php


namespace IgApi\Utils;


use MClient\HttpCookies;

class CookieManager
{
    public ?string $token = null;
    public function cookieMerge($currentCookies, $responseCookies) : string
    {
        $responseCookies = $this->stringToArray($responseCookies);
        $currentCookies = $this->stringToArray($currentCookies);
        foreach ($responseCookies as $cookieKey => $cookieValue)
        {
            $currentCookies[$cookieKey] = $cookieValue;
            if ($cookieKey === 'csrftoken')
            {
                $this->token = $cookieValue;
            }
        }
        return $this->cookieToString($currentCookies);
    }

    protected function cookieToString(array $cookies) : string{
        $cookie = '';
        foreach ($cookies as $key => $value)
        {
            $cookie .= $key.'='.$value.'; ';
        }
        return $cookie;
    }

    protected function stringToArray(string $cookie) : array
    {
        $cookieArray = [];
        $parseLine = explode(";",$cookie);

        foreach (array_values($parseLine) as $data)
        {
            $kv = explode("=",$data);
            if (isset($kv[0], $kv[1])):
                $cookieArray[trim($kv[0])] = trim($kv[1]);
                if (trim($kv[0]) === 'csrftoken'):
                    $this->token = trim($kv[1]);
                endif;
            endif;
        }
        return $cookieArray;
    }
}