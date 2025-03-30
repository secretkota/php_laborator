<?php

    $adData = __DIR__ . '/../storage/ads.txt';

    $ads = file_exists($adData) ? file($adData, FILE_IGNORE_NEW_LINES) : []; 
    $ads = array_map(function($item) {
        return json_decode($item, true);  // Decode each item as an associative array
    }, $ads);
    $lastAds = array_slice($ads, 0, 2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Объявления!</title>
</head>
<body>
    <h1>Недавно добавлены:</h1>
    <?php if (empty($lastAds)) : ?>
        <p>Объявлений пока нет.</p>
    <?php else : ?>
        <ul>
            <?php foreach ($lastAds as $ad) :?>
                <li>
                <strong><?= htmlspecialchars($ad['title']) ?></strong><br>
                    Категория: <?= htmlspecialchars($ad['category']) ?><br>
                    Описание: <?= nl2br(htmlspecialchars($ad['description'])) ?><br>
                    <small>Теги: <?= implode(', ', $ad['tags']) ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <a href="ad/index.php">Смотреть все объявления</a> |
    <a href="ad/create.php">Добавить объявление</a>
</body>
</html>