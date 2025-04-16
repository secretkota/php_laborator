<?php
    if (!isset($_GET['username'])) {
        header("Location: /index.php");
        exit;
    }

    $username = $_GET['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
    <a href="/index.php">Выйти из аккаунта.</a>
    <h1>Аккаунт водителя: <?php echo $username; ?></h1>
    <a href="./changeData.php?username=<?php echo $username?>">Изменить данные</a>
    <h2>Ваш рейс:</h2>
</body>
</html>