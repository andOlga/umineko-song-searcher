<?php
function search($query)
{
    if (!$query) {
        return null;
    }

    $contents = file_get_contents('script.u');
    $nameMap = require('namemap.php');
    $ytMap = require('ytmap.php');

    $matches = preg_split('/bgm(1v?|play2?)/', $contents);
    foreach ($matches as $match) {
        if (stripos($match, $query) !== false) {
            $subMatches = [];
            $thing = trim(preg_split('/\n|\,/', $match)[0]);
            $title = $nameMap[$thing];
            $yt = $ytMap[$thing];
            preg_match("/BGM_s_Ch = $thing\s+mov.+\"(.+)\"/", $contents, $subMatches);
            $fileName = str_replace('\\', '/', $subMatches[1]);
            if ($title && $fileName && $yt) {
                return ['title' => $title, 'bgm' => $fileName, 'yt' => $yt];
            }
        }
    }

    return false;
}
