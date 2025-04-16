<?php
require_once '../db.php';
require '../vendor/autoload.php';

// Создаем клиент Redis
$redis = new Predis\Client();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login = $_POST['login'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $prename = $_POST['prename'];
    $type = $_POST['type'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    try{
        $sql = "INSERT INTO users (login, password, name, prename, type, phone, email) 
                VALUES (:login, :password, :name, :prename, :type, :phone, :email)";
    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':prename', $prename);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
    
        $stmt->execute();
        
        // Обновление кэша
        $redis->del('drivers_list');  // Удаляем старый кэш
        // Получаем обновленный список водителей
        $query = "SELECT * FROM users WHERE type = :type";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['type' => 'driver']);
        $drivers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Кэшируем обновленный список водителей
        $redis->setex("drivers_list", 300, json_encode($drivers));

        // Перенаправляем обратно на страницу с диспетчером
        header("Location: ./dispatcher_dashboard.php");
        exit;

    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}

?>

<link rel="stylesheet" href="../css/style.css">
<a href="./dispatcher_dashboard.php">Назад</a>

<h2>Добавление водителя:</h2>

<div class="form-container">
<form method="POST">
    <label for="login">Логин:</label>
    <input type="text" id="login" name="login" required><br><br>

    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="name">Имя:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="prename">Фамилия:</label>
    <input type="text" id="prename" name="prename" required><br><br>

    <label for="type">Должность:</label>
    <select id="type" name="type" required>
        <option value="driver">Водитель</option>
        <option value="disp" disabled>Диспетчер</option>
    </select><br><br>

    <label for="phone">Телефон:</label>
    <input type="text" id="phone" name="phone" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <button class="btnadd" type="submit">Добавить пользователя</button>
</form>
</div>
