<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Ads</title>
</head>
<body> 
    <form 
    action="/handle_create.php"
    method="post" 
    autocomplete="off">
        <label>Название товара:</label><br />
        <input type="text" name="title" required><br />
        
        <label>Категории:</label>
        <select name="category" required>
            <option value="cars">Машины</option>
            <option value="clothes">Одежда</option>
            <option value="houses">Недвижимость</option>
        </select><br/>

        <label>Описание:</label><br>
        <textarea name="description" required></textarea><br/>
    
        <label>Цена:</label>
        <input type="number" name="price" min="0" required><br/>
    
        <button type="submit">Опубликовать</button>
    </form>
</body>
</html>