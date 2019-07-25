<?php

use App\Drinks\Drink;

require '../bootloader.php';
//
$nav = [
    'left' => [
        ['url' => '/', 'title' => 'Home']
    ]
];
//
//$db = new Core\FileDB(DB_FILE);
//$db->createTable('test_table');
//$db->insertRow('test_table', ['name' => 'Zebenkstis', 'balls' => true]);
//$db->insertRow('test_table', ['name' => 'Cytis Ritinas', 'balls' => false]);
//$db->updateRow('test_table', 1, ['name' => 'Rytis Citins', 'balls' => false]);
//
//$db->rowInsertIfNotExists('test_table', 4, ['name' => 'Bubilius Kybys', 'balls' => true]);
//
////var_dump('All database data:', $db->getData());
//
//$rows_with_balls = $db->getRowsWhere('test_table', ['balls' => true]);
////var_dump('Rows with balls:', $rows_with_balls);
//
//$drink = new App\Drinks\Drink();
//$drink->setName('mano neimas');
//$drink->setAmount(2);
//$drink->setAbarot(39.5);
//$drink->setImage('/img');
//$drink->setData([
//    'name' => 'Moscovskaja',
//    'amount_ml' => 3,
//    'abarot' => 40,
//    'askdf' => 'sdf',
//    'image' => 'IMGLINK'
//]);

//var_dump('Drink:', $drink);



$drink_finland = new App\Drinks\Drink([
    //'id' => 0,
    'name' => 'Finlandia Vodke',
    'amount_ml' => 750,
    'abarot' => 40,
    'image' => 'https://cdn.diffords.com/contrib/bws/2017/10/59db863511455.jpg'
]);
$drink_absent = new App\Drinks\Drink([
    //'id' => 0,
    'name' => 'Absent',
    'amount_ml' => 500,
    'abarot' => 70,
    'image' => 'https://cdn1.wine-searcher.net/images/labels/47/12/10924712.jpg'
]);
$drink_corona = new App\Drinks\Drink([
    //'id' => 0,
    'name' => 'Corona',
    'amount_ml' => 350,
    'abarot' => 4.5,
    'image' => 'https://products2.imgix.drizly.com/ci-corona-extra-2b48031ca2c738b1.jpeg?auto=format%2Ccompress&fm=jpeg&q=20'
]);
$drink_heineken = new App\Drinks\Drink([
    //'id' => 0,
    'name' => 'Heineken',
    'amount_ml' => 350,
    'abarot' => 4.5,
    'image' => 'https://products1.imgix.drizly.com/ci-heineken-lager-6ea7dedfaaced647.jpeg?auto=format%2Ccompress&fm=jpeg&q=20'
]);


//////
//$fileDB = new Core\FileDB(DB_FILE);
//$fileDB->load();
//$fileDB->createTable('drinks');
////
//$fileDB->insertRow('drinks', $drink->getData());
//$var  = $fileDB->getRowsWhere('drinks', ['abarot' => 4.7]);


$modelDrinks = new App\Drinks\Model();

$modelDrinks->insert($drink_absent);
$modelDrinks->insert($drink_corona);
$modelDrinks->insert($drink_heineken);
$modelDrinks->insert($drink_finland);

$drinks = $modelDrinks->get();
var_dump($drinks);
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

<div>
    <?php foreach ($drinks as $key => $drink): ?>
    <h1><?php print $drink->getName(); ?></h1>
    <h2><?php print $drink->getAmount(); ?></h2>
    <h3><?php print $drink->getAbarot(); ?></h3>
        <img src="<?php print $drink->getImage(); ?>" alt="foto">

    <?php endforeach; ?>
</div>
</body>
</html>
