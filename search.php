<?php
$contents = file_get_contents('script.u');

$nameMap = require('namemap.php');
$ytMap = require('ytmap.php');

$matches = preg_split('/bgm(1v?|play2?)/', $contents);
foreach ($matches as $match) {
    if (stripos($match, $_REQUEST['q']) !== false) {
        $subMatches = [];
        $thing = trim(preg_split('/\n|\,/', $match)[0]);
        $title = $nameMap[$thing];
        $yt = explode('&', str_replace('https://www.youtube.com/watch?v=', '', $ytMap[$thing]))[0];
        preg_match("/BGM_s_Ch = $thing\s+mov.+\"(.+)\"/", $contents, $subMatches);
        $fileName = str_replace('\\', '/', $subMatches[1]);
        if ($title && $fileName && $yt) {
            header('Content-Type: application/json');
            echo json_encode(['title' => $title, 'bgm' => $fileName, 'yt' => $yt], JSON_PRETTY_PRINT);
            break;
        }
    }
}
