<?php
function saveAd(array $ad)
{
    $file = __DIR__ . '/../storage/ads.txt';
    file_put_contents($file, json_encode($ad) . PHP_EOL, FILE_APPEND);
}
