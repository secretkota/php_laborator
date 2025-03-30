<?php
$file = __DIR__ . '/../storage/ads.txt';

if (!file_exists($file)) {
    echo '<p>Нет объявлений</p>';
    exit;
}

$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$ads = array_map('json_decode', $lines);

echo '<h1>Список объявлений</h1>';

foreach (array_reverse($ads) as $ad) {
    echo '<div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">';
    echo '<h3>' . htmlspecialchars($ad->title) . '</h3>';
    echo '<p>' . htmlspecialchars($ad->description) . '</p>';
    echo '<small>' . $ad->created_at . '</small>';
    echo '</div>';
}
