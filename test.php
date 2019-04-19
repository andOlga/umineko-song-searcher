<?php
$contents = file_get_contents('0.u') . file_get_contents('0answer.u');
$matches = preg_split('/bgm(1v?|play)/', $contents);
foreach ($matches as $match) {
    if (stripos($match, $_POST['findstr']) !== false) {
        $subMatches = [];
        $thing = trim(preg_split('/\n|\,/', $match)[0]);
        preg_match("/BGM_s_Ch = $thing\s+mov.+\"(.+)\"/", $contents, $subMatches);
        echo $subMatches[1];
        break;
    }
}
