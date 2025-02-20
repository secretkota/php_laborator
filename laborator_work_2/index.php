<?php

function day($day) {
     switch ($day) {
        case "понедельник";
        case "среда";
        case "пятница";
            echo "<td>8:00-12:00</td>";
            echo "<td>Нерабочий день</td>";
            break;
        case "вторник";
        case "четверг";
        case "суббота";
            echo "<td>Нерабочий день</td>";
            echo "<td>12:00-16:00</td>";
            break;
        default:
            echo "Неизвестный день недели";
            break;
     }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            border: 2px solid;
            width: 100%;
        }
        td{
            border: 2px solid;
        }
    </style>
</head>
<body>

<table>
    <tr class="styled">
        <th>John Styles</th>
        <th>Jane Doe</th>
    </tr>
    <tr>
        <?php day("четверг"); ?>
    </tr>
</table>


</body>
</html>