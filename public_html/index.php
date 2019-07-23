<?php

require '../bootloader.php';

$nav = [
    'left' => [
        ['url' => '/', 'title' => 'Home']
    ]
];

$db = new FileDB(DB_FILE);
$db->createTable('test_table');
$db->insertRow('test_table', ['name' => 'Zebenkstis', 'balls' => true]);
$db->insertRow('test_table', ['name' => 'Cytis Ritinas', 'balls' => false]);
$db->updateRow('test_table', 1, ['name' => 'Rytis Citins', 'balls' => false]);

$db->rowInsertIfNotExists('test_table', 4, ['name' => 'Bubilius Kybys', 'balls' => true]);

var_dump('All database data:', $db->getData());

$rows_with_balls = $db->getRowsWhere('test_table', ['balls' => true]);
var_dump('Rows with balls:', $rows_with_balls);

$drink = new Drink;
$drink->setName('mano neimas');
$drink->setAmount(2);
$drink->setAbarot(39.5);
$drink->setImage('/img');
$drink->setData([
    'name' => 'Moscovskaja',
    'amount_ml' => 3,
    'abarot' => 40,
    'askdf' => 'sdf',
    'image' => 'IMGLINK'
]);

var_dump('Drink:', $drink);

?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>OOP</title>
        <link rel="stylesheet" href="media/css/normalize.css">
        <link rel="stylesheet" href="media/css/style.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">        
        <script defer src="media/js/app.js"></script>
    </head>
    <body>
        <?php require ROOT . '/app/templates/navigation.tpl.php'; ?>
        
        <div class="content">
            <?php require ROOT . '/core/templates/form/form.tpl.php'; ?>
        </div>
    </body>
</html>
