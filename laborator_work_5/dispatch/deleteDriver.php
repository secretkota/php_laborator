<?php
require_once '../db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login = $_POST['login'];

    try{
        $sql = "DELETE FROM users WHERE login = :login";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':login' => $login
    ]);
        if ($stmt->rowCount() > 0) {
            echo "Водитель с логином $login был успешно удален.";
        } else {
            echo "Водитель с логином $login не найден.";
        }
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}

?>

<a href="./dispatcher_dashboard.php">Назад</a>
<link rel="stylesheet" href="../css/style.css">
<h2>Удаление водителя:</h2>
<div class="form-container">
<form method="POST">
    <label for="delete">Удаление только по логину!</label>
    <label for="login">Логин:</label>
    <input type="text" id="login" name="login" required><br><br>

    <button class="btndrop" type="submit">Удалить водителя</button>
</form>
</div>