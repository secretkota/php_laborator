<?php

function getAds() {
    $file = __DIR__ . '/../storage/ads.txt';

    if (!file_exists($file)) {
        return [];
    }

    $lines = file($file, FILE_SKIP_EMPTY_LINES);
    return array_map('json_decode', $lines);
}