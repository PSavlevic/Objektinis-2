<?php

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


////4uzd testavimas:
//$modelDrinks = new App\Drinks\Model();
//
//$drink = new App\Drinks\Drink([
//    'id' => 1,
//    'name' => 'Svoboda XXX',
//    'amount_ml' => 60,
//    'abarot' => 700,
//    'image' => '/media/images/svoboda2.png'
//]);
//
//$modelDrinks -> update($drink);
//
////5uzd testavimas:
//$drinks = $modelDrinks->get();
//
//foreach ($drinks as $drink) {
//    $modelDrinks->delete($drink);

//$drink = new App\Drinks\Drink([
//    //'id' => 0,
//    'name' => 'Absent',
//    'amount_ml' => 500,
//    'abarot' => 70,
//    'image' => 'https://cdn1.wine-searcher.net/images/labels/47/12/10924712.jpg'
//]);
//////
$fileDB = new Core\FileDB(DB_FILE);
$fileDB->load();
$fileDB->createTable('drinks');
////
//$fileDB->insertRow('drinks', $drink->getData());
//$var  = $fileDB->getRowsWhere('drinks', ['abarot' => 4.7]);


$modelDrinks = new App\Drinks\Model();

var_dump($modelDrinks->get());

$drinks = $modelDrinks->get(['abarot' => 4.7]);

foreach ($drinks as $drink) {
    $modelDrinks->update($drink);
    var_dump($modelDrinks);
}

$gerimuArrajus = $fileDB->getData();

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

<div class="gerimas">
    <?php foreach ($gerimuArrajus as $key => $value): ?>
        <?php foreach ($value as $v_key => $v_value): ?>
            <h1><?php print $v_value['name']; ?></h1>
            <h2><?php print $v_value['amount_ml'] . 'ml' ?></h2>
            <h2><?php print $v_value['abarot'] . '%' ?></h2>
            <img src="<?php print $v_value['image']; ?>" alt="foto">
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
</body>
</html>
