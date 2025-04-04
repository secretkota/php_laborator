<?php
// Подключение вспомогательных функций (если есть в helpers.php)
require_once __DIR__ . '/../helpers.php';

/**
 * Обработка POST-запроса при создании нового объявления.
 */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Получение и очистка данных из формы
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $tags = $_POST['tags'];
    $tags = (array) $tags; // Убедимся, что это массив

    $errorValid = []; // (не используется, можно удалить)
    $errors = [];     // Сюда будут собираться сообщения об ошибках

    // Валидация данных формы
    if (empty($title)) {
        $errors[] = "Название объявления обязательно.";
    }
    if (empty($category)) {
        $errors[] = "Выберите категорию.";
    }
    if (empty($description)) {
        $errors[] = "Введите описание.";
    }

    // Если есть ошибки — выводим их и прекращаем выполнение
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        echo "<a href='/create.php'>Назад</a>";
        exit;
    }

    // Формируем новое объявление
    $newAd = [
        'title' => htmlspecialchars($title),
        'category' => htmlspecialchars($category),
        'description' => nl2br(htmlspecialchars($description)), // Переносы строк сохраняются
        'tags' => array_map('htmlspecialchars', $tags),
        'date' => date('Y-m-d H:i:s')
    ];

    /**
     * Сохраняем объявление в файл.
     * Каждый JSON-записан на отдельной строке.
     */
    $file = '../../storage/ads.txt';
    file_put_contents(__DIR__ . '/' . $file, json_encode($newAd) . PHP_EOL, FILE_APPEND);

    // Перенаправляем пользователя на главную страницу
    header('Location: /index.php');
}
