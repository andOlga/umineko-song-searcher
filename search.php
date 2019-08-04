<?php
$questionContents = file_get_contents(
    'http://07th-mod.com/download.php?repository=umineko-question&file=master/InDevelopment/ManualUpdates/0.utf'
);
$answerContents = file_get_contents(
    'http://07th-mod.com/download.php?repository=umineko-answer&file=adv_mode/0.utf'
);
$contents =  $questionContents . $answerContents;
$matches = preg_split('/bgm(1v?|play2?)/', $contents);
foreach ($matches as $match) {
    if (stripos($match, $_POST['findstr']) !== false) {
        $subMatches = [];
        $thing = trim(preg_split('/\n|\,/', $match)[0]);
        preg_match("/BGM_s_Ch = $thing\s+mov.+\"(.+)\"/", $contents, $subMatches);
        echo $subMatches[1];
        break;
    }
}
