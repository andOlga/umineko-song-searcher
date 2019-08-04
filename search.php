<?php
$fileMap = [
    '0question.u' => 'http://07th-mod.com/download.php?repository=umineko-question&file=master/InDevelopment/ManualUpdates/0.utf',
    '0answer.u' => 'http://07th-mod.com/download.php?repository=umineko-answer&file=adv_mode/0.utf'
];
$contents = '';

foreach ($fileMap as $file => $url) {
    if (file_exists($file)) {
        $contents .= file_get_contents($file);
    } else {
        $newContents = file_get_contents($url);
        $contents .= $newContents;
        file_put_contents($file, $newContents);
    }
}

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
