<?php
require_once __DIR__ . '/../helpers.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $tags = $_POST['tags'];
    $tags = (array) $tags;

    $errorValid = [];

    if (empty($title)) {
        $errors[] = "Название объявления обязательно.";
    }
    if (empty($category)) {
        $errors[] = "Выберите категорию.";
    }
    if (empty($description)) {
        $errors[] = "Введите описание.";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        echo "<a href='/create.php'>Назад</a>";
        exit;
    }

    $newAd = [
        'title' => htmlspecialchars($title),
        'category' => htmlspecialchars($category),
        'description' => nl2br(htmlspecialchars($description)),
        'tags' => array_map('htmlspecialchars', $tags),
        'date' => date('Y-m-d H:i:s')
    ];

    $file = '../../storage/ads.txt';
    file_put_contents(__DIR__ . '/' . $file, json_encode($newAd) . PHP_EOL, FILE_APPEND);

    header('Location: /index.php');
}
