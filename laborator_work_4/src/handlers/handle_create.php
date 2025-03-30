<?php

require_once __DIR__ . '/../helpers.php';

$title = trim($_POST['title']);
$category = trim($_POST['category']);
$description = trim($_POST['description']);
$price = trim($_POST['price']);

$errors = [];

if ($title === '') {
    $errors['title'] = 'Заполните название товара.';
} else if ($title < 3){
    $errors['title'] = 'Ваш заголовок меньше 3-х символов';
} 
if ($category == ''){
    $errors['category'] = 'Укажите одну из категорий вашего товара.';
}
if ($description === ''){
    $errors['description'] = 'Укажите описание товара.';
}
if ($price == '' || $price < 0 || !is_numeric($price)) {
    $errors['price'] = 'Укажите цену больше 0, и цифрой.';
}

if (!empty($errors)) {
    header('Location: /ads/create.php');
    exit;
}

$saveAds = [
    'title' => htmlspecialchars($title),
    'category' => htmlspecialchars($category),
    'description' => htmlspecialchars($description),
    'price' => htmlspecialchars($price),
    'createData' => date('d-m-y h:m')
];

$file = '../../storage/ads.txt';
file_put_contents($file, json_encode($saveAds), FILE_APPEND);

header('Location: /index.php');
exit;