<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = :login AND password = :password");
    $stmt->execute([
        ':login' => $login, 
        ':password' => $password
    ]);

    $users = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($users) {
        if ($users['type'] === 'disp') {
            header("Location: dispatch/dispatcher_dashboard.php?username=$login");
            exit;
        } elseif ($users['type'] === 'driver') {
            header("Location: driver/accountDriver.php?username=$login");
            exit;
        } else {
            $errorMess = "Неизвестный тип пользователя.";
        }
    } else {
        $errorMess = "Неверный логин или пароль.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Логирование в таблицу</title>
</head>
<body>
    <div class="container">
        <div class="form-container">
        <h2>Авторизация:</h2>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="login" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Login">
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$users) {
                echo "<p style='color: red;'>$errorMess</p>";
            }?>
        </form>
        </div>
    </div>
</body>
</html>