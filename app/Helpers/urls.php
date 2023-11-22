<?php

/**
 * Generate a locale URL with the current language segment.
 *
 * @param  string  $url The URL to be localized.
 * @return string The localized URL.
 */
function locale_url(string $url): string
{
    return url(request()->segment(1).'/'.$url);
}

/**
 * Get the domain name from a given URL.
 *
 * @param  string  $domain The URL to extract the domain from.
 * @param  bool  $debug Optional flag to enable debug output. Default is false.
 * @return string The extracted domain name.
 */
function get_domain(string $domain, bool $debug = false): string
{
    $original = $domain = strtolower($domain);

    if (filter_var($domain, FILTER_VALIDATE_IP)) {
        return $domain;
    }

    $debug ? print('<strong style="color:green">&raquo;</strong> Parsing: '.$original) : false;

    $arr = array_slice(array_filter(explode('.', $domain, 4), static function ($value) {
        return $value !== 'www';
    }), 0);

    if (count($arr) > 2) {
        $count = count($arr);
        $_sub = explode('.', $count === 4 ? $arr[3] : $arr[2]);

        $debug ? print(" (parts count: {$count})") : false;

        if (count($_sub) === 2) {
            $removed = array_shift($arr);
            if ($count === 4) {
                $removed = array_shift($arr);
            }
            $debug ? print("<br>\n".'[*] Two level TLD: <strong>'.implode('.', $_sub).'</strong> ') : false;
        } elseif (count($_sub) === 1) {
            $removed = array_shift($arr);

            if (strlen($_sub[0]) === 2 && $count === 3) {
                array_unshift($arr, $removed);
            } else {
                $tlds = [
                    'aero', 'arpa', 'asia', 'biz', 'cat', 'com', 'coop', 'edu',
                    'gov', 'info', 'jobs', 'mil', 'mobi', 'museum', 'name',
                    'net', 'org', 'post', 'pro', 'tel', 'test', 'travel', 'xxx',
                ];

                if (count($arr) > 2 && in_array($_sub[0], $tlds) !== false) {
                    array_shift($arr);
                }
            }
            $debug ? print("<br>\n".'[*] One level TLD: <strong>'.implode('.', $_sub).'</strong> ') : false;
        } else {
            for ($i = count($_sub); $i > 1; $i--) {
                $removed = array_shift($arr);
            }
            $debug ? print("<br>\n".'[*] Three level TLD: <strong>'.implode('.', $_sub).'</strong> ') : false;
        }
    } elseif (count($arr) === 2) {
        $arr0 = array_shift($arr);

        if (
            strpos(implode('.', $arr), '.') === false
            && in_array($arr[0], ['localhost', 'invalid']) === false
        ) { // not a reserved domain
            $debug ? print("<br>\n".'Seems invalid domain: <strong>'.implode('.', $arr).'</strong> re-adding: <strong>'.$arr0.'</strong> ') : false;
            // seems invalid domain, restore it
            array_unshift($arr, $arr0);
        }
    }

    $debug ? print("<br>\n".'<strong style="color:gray">&laquo;</strong> Done parsing: <span style="color:red">'.$original.'</span> as <span style="color:blue">'.implode('.', $arr)."</span><br>\n") : false;

    return implode('.', $arr);
}
