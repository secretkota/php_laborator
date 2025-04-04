<?php

/**
 * Сохраняет объявление в файл.
 *
 * @param array $ad Ассоциативный массив с данными объявления.
 *
 * @throws RuntimeException Если не удалось сохранить данные в файл.
 */
function saveAd(array $ad): void
{
    $file = __DIR__ . '/../storage/ads.txt';
    $result = file_put_contents($file, json_encode($ad) . PHP_EOL, FILE_APPEND);

    if ($result === false) {
        throw new RuntimeException('Ошибка при сохранении объявления.');
    }
}
