<?php
require_once '../db.php';
require_once '../vendor/autoload.php';

$drivers = [];
$useRedis = true;

try {
    if ($useRedis) {
        $redis = new Predis\Client();
        $cached = $redis->get("drivers_list");

        if ($cached) {
            $drivers = json_decode($cached, true);
            return;
        } else {

            $query = "SELECT * FROM users WHERE type = :type";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['type' => 'driver']);
            $drivers = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $redis->setex("drivers_list", 300, json_encode($drivers));
        }
    } else {
        $query = "SELECT * FROM users WHERE type = :type";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['type' => 'driver']);
        $drivers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

function showDrivers($drivers) {
    if (empty($drivers)) {
        echo "<p>No drivers found.</p>";
        return;
    } else {
        foreach ($drivers as $driver) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($driver['id']) . "</td>";
            echo "<td>" . htmlspecialchars($driver['login']) . "</td>";
            echo "<td>" . htmlspecialchars($driver['name']) . "</td>";
            echo "<td>" . htmlspecialchars($driver['prename']) . "</td>";
            echo "<td>" . htmlspecialchars($driver['phone']) . "</td>";
            echo "<td>" . htmlspecialchars($driver['email']) . "</td>";
            echo "</tr>";
        }
    }
}
?>
<link rel="stylesheet" href="../css/style.css">
<a href="./dispatcher_dashboard.php">Back</a>
<h1>Все водителя в базе:</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Login</th>
        <th>Name</th>
        <th>Prename</th>
        <th>Phone</th>
        <th>Email</th>
    </tr>
    <?php showDrivers($drivers) ?>
</table>
