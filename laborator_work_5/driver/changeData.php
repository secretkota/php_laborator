<?php
require_once '../db.php';
require_once '../vendor/autoload.php';


if (!isset($_GET['username'])) {
    header("Location: /index.php");
    exit;
}

$username = $_GET['username'];

// Подключаем Redis
$redis = new Predis\Client();
$redis->connect('127.0.0.1', 6379);

$redis->del("drivers_list");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $field = $_POST['field'];
    $newValue = $_POST['newValue'];

    try {
        // Подготовка запроса для обновления данных
        $sql = "UPDATE users SET $field = :newValue WHERE login = :login";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':newValue' => $newValue,
            ':login' => $username // Здесь мы используем $username
        ]);

        echo "Данные обновлены успешно!";
    } catch(PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}

?>

<link rel="stylesheet" href="../css/style.css">
<h1>Изменение данных для аккаунта <?php echo htmlspecialchars($username); ?>:</h1>

<div class="form-container">
<select class="changeData">
    <option value="">-- Выберите поле --</option>
    <option value="login">Логин</option>
    <option value="password">Пароль</option>
    <option value="phone">Телефон</option>
    <option value="email">Почта</option>
</select>
</div>

<script>
    const select = document.querySelector('.changeData');
    const formContainer = document.querySelector('.form-container');

    select.addEventListener('change', () => {
        const value = select.value;
        let label = '';
        let inputType = 'text';

        if (!value) {
            formContainer.innerHTML = '';
            return;
        }

        switch (value) {
            case 'login': label = 'Новый логин:'; break;
            case 'password': label = 'Новый пароль:'; inputType = 'password'; break;
            case 'phone': label = 'Новый телефон:'; break;
            case 'email': label = 'Новая почта:'; inputType = 'email'; break;
        }

        formContainer.innerHTML = `
            <form method="POST">
                <input type="hidden" name="field" value="${value}">
                <label>${label} <input type="${inputType}" name="newValue" required></label>
                <button type="submit">Сохранить</button>
            </form>
        `;
    });
</script>
<br><br>
<a href="./accountDriver.php?username=<?php echo htmlspecialchars($username); ?>">Назад</a>