<?php

declare(strict_types=1);

/**
 * Создание массива
 *
 * @var array<int, array{
 * id:int,
 * date: string,
 * amount: float,
 * description: string,
 * merchant: string
 * }> $transactions
 * 
 * 
 */

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

/**
 * 
 * Сортировка массива по убыванию
 * 
 */
usort($transactions, function ($a, $b) {
    return $b["amount"] <=> $a["amount"];
});

/**
 * 
 * Добавление новой транзакции
 * 
 * @param int $id - id transaction
 * @param string $date - date transaction
 * @param float $amount - amount transaction
 * @param string $description - description transaction
 * @param string $merchant - place where something was bought
 * @return void
 */
function addTransaction(int $id, string $date, float $amount, string $description, string $merchant): void
{
    global $transactions;
    $transactions[] = [
        "id" => $id,
        "date" => $date,
        "amount" => $amount,
        "description" => $description,
        "merchant" => $merchant
    ];
}

addTransaction(3, "2009-06-20", 2000.90, "test", "test");
addTransaction(4, "2021-06-20", 2000.90, "test1", "test2");

/**
 * 
 * Поиск транзакции по описанию
 * 
 * @param string $description - string of description
 * @param array $transaction - array where find transaction
 * @return int|string
 */
function findTransactionByDescription(string $descriptionPart, array $transactions)
{
    $key = array_search($descriptionPart, array_column($transactions, 'description'));

    return $transactions[$key]['id'];
}

/**
 * 
 * Подсчет всего по amount
 * 
 * @param array $transaction - array where count all amount
 * @return float
 */
function calculateTotalAmount(array $transactions): float
{
    $sum = 0.0;

    foreach ($transactions as $transactions) {
        $sum += $transactions["amount"];
    }

    // array_sum($transactions, array_column($transations, 'amount'))
    return $sum;
}

/**
 * 
 * Поиск транзакции по айди
 * 
 * @param int $id - id a transaction
 * @param array $transaction - transaction where find by id something
 * @return array|string
 */

function findTransactionById(int $id, array $transactions)
{
    foreach ($transactions as $transaction) {
        if ($transaction["id"] === $id) {
            return $transaction['name'];
        }
    }

    return "Не существует";
}

/**
 * Вычисляет количество дней с момента транзакции.
 *
 * @param array $transaction 
 * @return int
 */
function daysSinceTransaction(array $transactions)
{
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
            <?php foreach ($transactions as $transaction) : ?>
                <tr>
                    <td><?= $transaction["id"] ?></td>
                    <td><?= $transaction["date"] ?></td>
                    <td><?= $transaction["amount"] ?></td>
                    <td><?= $transaction["description"] ?></td>
                    <td><?= $transaction["merchant"] ?></td>
                    <td><?= daysSinceTransaction($transaction) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo "Total sum amounts:" . calculateTotalAmount($transactions) ?>;
    <br>
    <p>Транзакция по описанию имеет айди:</p>
    <?php echo findTransactionByDescription("test", $transactions) ?>
    <p>Транзация по айди</p>
    <?php echo findTransactionById(9, $transactions) ?>
    <br>
    <a href="/part_2/" style="text-decoration: none;">Переход ко 2 заданию.</a>
</body>

</html>