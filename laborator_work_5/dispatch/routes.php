<?php
require_once '../db.php';

try {
    $query = "SELECT * FROM routes";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $routes = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

function showRoutes($routes) {
    if (empty($routes)) {
        echo "<p>No routes found.</p>";
        return;
    } else {
        foreach ($routes as $route) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($route['id']) . "</td>";
            echo "<td>" . htmlspecialchars($route['abberature']) . "</td>";
            echo "<td>" . htmlspecialchars($route['start']) . "</td>";
            echo "<td>" . htmlspecialchars($route['end']) . "</td>";
            echo "<td>" . htmlspecialchars($route['distance']) . "км". "</td>";
            echo "<td>" . htmlspecialchars($route['time']) . "</td>";
            echo "<td>" . htmlspecialchars($route['price']) . " Леев" . " </td>";
            echo "</tr>";
        }
    }
}
?>

<link rel="stylesheet" href="../css/style.css">
<a href="./dispatcher_dashboard.php">Back</a>
<br><br>
<h1>Маршуты в базе:</h1>
<table>
    <tr>
        <th>№</th>
        <th>Аббревиатура</th>
        <th>Стартует с</th>
        <th>Конечная</th>
        <th>Расстояние</th>
        <th>Время полного круга</th>
        <th>Цена проезда</th>
    </tr>
    <?php showRoutes($routes)?>
</table>
<br><br>
<a href="./addRoute.php">Добавить маршрут</a>