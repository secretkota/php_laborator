<?php

declare(strict_types=1);
 
$transactions = [
    [
        "id" => 1,
        "date" => "2025-06-02",
        "amount" => 1900.50,
        "description" => "Buy gas",
        "merchant" => "Gas Station"
    ],
    [
        "id" => 2,
        "date" => "2024-06-02",
        "amount" => 129.90,
        "description" => "Buy gas1",
        "merchant" => "Gas Station"
    ],
];


usort($transactions, function ($a, $b) {
    return $b["amount"] <=> $a["amount"];
});

function addTransaction(int $id, string $date, float $amount, string $description, string $merchant): void {
    global $transactions;
    $transactions[] = [
        "id" => $id, 
        "date" => $date, 
        "amount" => $amount, 
        "description"=> $description, 
        "merchant"=>$merchant
    ];
}

addTransaction(3, "2009-06-20", 2000.90, "test", "test");
addTransaction(4, "2021-06-20", 2000.90, "test1", "test2");


function findTransactionByDescription(string $descriptionPart, array $transactions){
    $descVal = array_column($transactions, 'description');
    $key = array_search($descriptionPart, $descVal);

    echo $transactions[$key]['id'];
}

function calculateTotalAmount(array $transactions): float{
    $sum = 0.0;

    foreach ($transactions as $transactions) {
        $sum += $transactions["amount"];
    }

    return $sum;
}

function findTransactionById(int $id, array $transactions) {
    foreach ($transactions as $transaction){
        if ($transaction["id"] === $id) {
            echo "Сущевствует";
            return;
        }
    }

    echo "Не существует";
}

function daysSinceTransaction(array $transactions) {
    $currentDate = new DateTime();
    $transactionDate = new DateTime($transactions["date"]);
    $diff = $transactionDate->diff($currentDate);
    return $diff->days;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border='1'>
        <thead>
            <td>ID</td>
            <td>Date</td>
            <td>amount</td>
            <td>description</td>
            <td>merchant</td>
            <td>была</td>
        </thead>
        <tbody>
            <?php foreach($transactions as $transaction) : ?>
            <tr>
                <td><?= $transaction["id"]?></td>
                <td><?= $transaction["date"]?></td>
                <td><?= $transaction["amount"]?></td>
                <td><?= $transaction["description"]?></td>
                <td><?= $transaction["merchant"]?></td>
                <td><?= daysSinceTransaction($transaction)?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= "Total sum amounts:". calculateTotalAmount($transactions) ?>;
    <br>
    <p>Транзакция по описанию имеет айди:</p>
    <?= findTransactionByDescription("test", $transactions) ?>
    <p>Транзация по айди</p>
    <?= findTransactionById(9, $transactions) ?>
    <br>
    <a href="http://localhost:808/part_2" style="text-decoration: none;">Переход ко 2 заданию.</a>
</body>
</html>