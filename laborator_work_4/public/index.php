<?php
/**
 * Путь к файлу с объявлениями.
 */
$adData = __DIR__ . '/../storage/ads.txt';

/**
 * Считывание из файла.
 * Если файл существует, считываем его построчно без символов перевода строки.
 * Затем декодируем каждую строку из JSON в ассоциативный массив.
 * Если файл не найден — устанавливаем пустой массив.
 *
 * @var array $ads Массив всех объявлений.
 */
$ads = file_exists($adData) ? file($adData, FILE_IGNORE_NEW_LINES) : []; 
$ads = array_map(function($item) {
    return json_decode($item, true); 
}, $ads);

/**
 * Получение последних двух объявлений.
 *
 * @var array $lastAds Массив с последними двумя объявлениями.
 */
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
        <!-- 
            Если массив $lastAds пустой, выводим сообщение об отсутствии объявлений.
        -->
        <p>Объявлений пока нет.</p>
    <?php else : ?>
        <!-- 
            Если есть объявления, отображаем их список (только последние два).
        -->
        <ul>
            <?php foreach ($lastAds as $ad) : ?>
                <li>
                    <!-- 
                        Вывод заголовка объявления.
                        htmlspecialchars защищает от XSS.
                    -->
                    <strong><?= htmlspecialchars($ad['title']) ?></strong><br>
                    <!-- 
                        Вывод категории объявления.
                    -->
                    Категория: <?= htmlspecialchars($ad['category']) ?><br>
                    <!-- 
                        Описание объявления с сохранением переносов строк.
                    -->
                    Описание: <?= htmlspecialchars($ad['description']) ?><br>
                    <!-- 
                        Теги объявления, объединённые через запятую.
                    -->
                    <small>Теги: <?= implode(', ', $ad['tags']) ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <a href="/index.php">Смотреть все объявления</a> |
    <a href="/create.php">Добавить объявление</a>
</body>
</html>