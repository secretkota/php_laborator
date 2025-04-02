<?php require_once __DIR__ . "/../src/handlers/handle_create.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заполение объявления!</title>
</head>
<body>
    <h1>Заполните объявление!</h1>
    <form action="<?= $_SERVER["PHP_SELF"]; ?>" method="post">
    <label>Название объявления:
            <input type="text" name="title" required>
        </label><br><br>

        <label>Категория:
            <select name="category" required>
                <option value="sell">Продажа</option>
                <option value="car">Машины</option>
                <option value="job">Работа</option>
            </select>
        </label><br><br>

        <label>Описание:<br>
            <textarea name="description" required></textarea>
        </label><br><br>

        <label>Теги:
            <select name="tags[]" multiple>
                <option value="houses">Недвижимость</option>
                <option value="cars">Авто</option>
            </select>
        </label><br><br>

        <button type="submit">Отправить</button>
    </form>
</body>
</html>