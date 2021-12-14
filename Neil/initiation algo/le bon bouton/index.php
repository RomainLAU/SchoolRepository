<?php

$buttonList = [
    'czptih', 'oyniwx', 'uuknuv', 'czptih', 'lbyfrh', 'jfqvky',
    'zfikll', 'jfqvky', 'ivxgel', 'bhlunk', 'fttdoq', 'ddsnyy',
    'bhlunk', 'eyhrsq', 'ddsnyy', 'czptih', 'czptih', 'ddsnyy', 'bqfpvi',
    'jfqvky', 'jtornb', 'lbyfrh', 'bhlunk', 'uuknuv', 'jrzhfd', 'czptih',
    'uuknuv', 'czptih', 'ivxgel', 'etbwyp', 'ubwfdu', 'uuknuv', 'lbyfrh',
    'etbwyp', 'lbyfrh', 'ddsnyy', 'ddsnyy', 'bhlunk', 'czptih', 'kyskbf',
    'qcjojj', 'uuknuv', 'ivxgel', 'credvm', 'lbyfrh', 'eyhrsq', 'laxutf',
    'etbwyp', 'lkgcgo', 'etbwyp', 'jfqvky', 'uuknuv', 'lbyfrh', 'hpxtot',
    'ddsnyy', 'bhlunk', 'iafvaz', 'qdmxzc', 'ivxgel', 'dudgrg', 'oyniwx',
    'bhlunk', 'ohjyio', 'njbzhp', 'vfrfjx', 'uuknuv', 'eyhrsq', 'djlqqx',
    'oyniwx', 'kyskbf', 'ivxgel', 'laxutf', 'vfrfjx', 'eyhrsq', 'uuknuv',
    'sumqei', 'qcjojj', 'vfrfjx', 'dbioge', 'heaves', 'zkmjoy', 'ivxgel',
    'kyskbf', 'eyhrsq', 'bhlunk', 'czptih', 'jfqvky', 'etbwyp', 'jfqvky',
    'ngzhgt', 'laxutf', 'qcjojj', 'ivxgel', 'eyhrsq', 'etbwyp', 'ivxgel',
    'rpcaue', 'lbyfrh', 'jtornb'
];

function goodButton ($buttonList) {
    $isItTheGoodOne = [];
    foreach ($buttonList as $button) {
        if (isset($isItTheGoodOne[$button])) {
            $isItTheGoodOne[$button] = $isItTheGoodOne[$button] + 1;
        } else {
            $isItTheGoodOne[$button] = 1;
        }
    }
    if ($isItTheGoodOne[$button] === 2) {
        return $button;
    }
}

echo(goodButton($buttonList));

?>