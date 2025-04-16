<?php 
    require_once '../db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $abberature = $_POST['abberature'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $distance = $_POST['distance'];
        $time = $_POST['time'];
        $price = $_POST['price'];

        $sqlAdd = "CREATE TABLE IF NOT EXISTS routes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            abberature VARCHAR(255) NOT NULL,
            start VARCHAR(255) NOT NULL,
            end VARCHAR(255) NOT NULL,
            distance INT NOT NULL,
            time VARCHAR(255) NOT NULL,
            price INT NOT NULL
            )";
            $pdo->exec($sqlAdd);

        try {
            $sql = "INSERT INTO routes (abberature, start, end, distance, time, price) VALUES (:abberature, :start, :end, :distance, :time, :price)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':abberature' => $abberature,
                ':start' => $start,
                ':end' => $end,
                ':distance' => $distance,
                ':time' => $time,
                ':price' => $price
            ]);
            echo "Маршрут успешно добавлен!";
        } catch (PDOException $e) {
            echo "Ошибка: " . $e->getMessage();
        }
    }
?>

<link rel="stylesheet" href="../css/style.css">
<a href="./dispatcher_dashboard.php">Назад</a>
<br><br>    
<div class="form-container">
<h2>Добавление маршрута:</h2>
<p>Заполните все поля, чтобы добавить новый маршрут.</p>
<form method="post">
    <h1>Заполнение маршута:</h1>
    <label for="abberature">Аббература маршута:</label>
    <input type="text" id="abberature" name="abberature" required><br><br>
    <label for="start">Начальная точка:</label>
    <input type="text" id="start" name="start" required><br><br>
    <label for="end">Конечная точка:</label>
    <input type="text" id="end" name="end" required><br><br>
    <label for="distance">Расстояние:</label>
    <input type="number" id="distance" name="distance" required><br><br>
    <label for="time">Время полной поездки:</label>
    <input type="text" id="time" name="time" required><br><br>
    <label for="price">Цена:</label>
    <input type="number" id="price" name="price" required><br><br>

    <button type="submit" class="btnadd">Заполнить</button>
</form>
</div>