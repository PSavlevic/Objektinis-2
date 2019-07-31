<?php

use App\Drinks\Drink;
use App\Drinks\Model;
use App\Users\User;


require '../bootloader.php';

$nav = [
    'left' => [
        ['url' => '/index.php', 'title' => 'Home'],
        ['url' => '/register.php', 'title' => 'Register'],
        ['url' => '/login.php', 'title' => 'Login'],
        ['url' => '/logout.php', 'title' => 'Logout']
    ]
];

//$whiskey = new \App\Drinks\StrongDrink();
//$whiskey->setAmount(700);
//$whiskey->drink();
//var_dump($whiskey->getAmount());

$beer = new \App\Drinks\LightDrink();
$whiskey = new \App\Drinks\StrongDrink();

//var_dump($beer->getImage());


//abstract class Car
//{
//    protected $manufacturer;
//    protected $model;
//    protected $year;
//
//    abstract protected function drive();
//
//    public function __construct($manufacturer, $model, $year)
//    {
//        $this->manufacturer = $manufacturer;
//        $this->model = $model;
//        $this->year = $year;
//    }
//}
//
//abstract class Honda extends Car
//{
//    public function __construct($model, $year)
//    {
//        parent::__construct('Honda', $model, $year);
//    }
//
//}
//
//class HondaCivic extends Honda
//{
//    public function __construct($year)
//    {
//        parent::__construct('Civic', $year);
//    }
//
//    public function drive()
//    {
//        print 'Honda Civic juda';
//    }
//}
//
//$honda = new HondaCivic(2000);
//$honda->drive();
//
//
//die();


//
//$db = new Core\FileDB(DB_FILE);
//$modelDrinks = new \App\Drinks\Model($db);
//
//$testasApp = \App\App::$db->getData();
//var_dump($testasApp);
//
//$form = [
//    'attr' => [
//        //'action' => '', Nebūtina, jeigu action yra ''
//        'method' => 'POST',
//    ],
//    'fields' => [
//        'name' => [
//            'label' => 'Gerimo pavadinimas',
//            'type' => 'text',
//            'extra' => [
//                'validators' => [
//                    'validate_not_empty',
//                ]
//            ],
//        ],
//        'amount_ml' => [
//            'label' => 'Amount(ml)',
//            'type' => 'text',
//            'extra' => [
//                'validators' => [
//                    'validate_not_empty',
//                    //validate float
//                ]
//            ],
//        ],
//        'abarot' => [
//            'label' => 'Abarotai(%)',
//            'type' => 'text',
//            'extra' => [
//                'validators' => [
//                    'validate_not_empty'
//                ]
//            ],
//        ],
//        'image' => [
//            'label' => 'Image link',
//            'type' => 'text',
//            'extra' => [
//                'validators' => [
//                    'validate_not_empty',
//                ]
//            ],
//        ],
//    ],
//    'buttons' => [
//        'submit' => [
//            'title' => 'Prideti gerima',
//            'extra' => [
//                'attr' => [
//                    'class' => 'red-btn'
//                ]
//            ]
//        ],
//        'delete' => [
//            'title' => 'Isgerti viska',
//            'extra' => [
//                'attr' => [
//                    'class' => 'blue-btn'
//                ]
//            ]
//        ],
//    ],
//
//    'callbacks' => [
//        'success' => 'form_success',
//        'fail' => 'form_fail'
//    ],
//    'validators' => [
//        'validate_login'
//    ]
//];
//
//
//$filtered_input = get_form_input($form);
////if (!empty($filtered_input)) {
////    validate_form($filtered_input, $form, $modelDrinks);
////}
//function form_success($filtered_input, &$form, $modelDrinks) {
//    $modelDrinks->insert(new App\Drinks\Drink($filtered_input));
//}
//function form_fail() {
//    print 'fail';
//}
//switch (get_form_action()) {
//    case 'submit':
//        validate_form($filtered_input, $form, $modelDrinks);
//        break;
//    case 'delete':
//        foreach ($modelDrinks->get() as $drink) {
//            $modelDrinks->delete($drink);
//        }
//}
//
//var_dump($modelDrinks->get());

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


//$drink_finland = new App\Drinks\Drink([
//    //'id' => 0,
//    'name' => 'Finlandia Vodke',
//    'amount_ml' => 750,
//    'abarot' => 40,
//    'image' => 'https://cdn.diffords.com/contrib/bws/2017/10/59db863511455.jpg'
//]);
//$drink_absent = new App\Drinks\Drink([
//    //'id' => 0,
//    'name' => 'Absent',
//    'amount_ml' => 500,
//    'abarot' => 70,
//    'image' => 'https://cdn1.wine-searcher.net/images/labels/47/12/10924712.jpg'
//]);
//$drink_corona = new App\Drinks\Drink([
//    //'id' => 0,
//    'name' => 'Corona',
//    'amount_ml' => 350,
//    'abarot' => 4.5,
//    'image' => 'https://products2.imgix.drizly.com/ci-corona-extra-2b48031ca2c738b1.jpeg?auto=format%2Ccompress&fm=jpeg&q=20'
//]);
//$drink_heineken = new App\Drinks\Drink([
//    //'id' => 0,
//    'name' => 'Heineken',
//    'amount_ml' => 350,
//    'abarot' => 4.5,
//    'image' => 'https://products1.imgix.drizly.com/ci-heineken-lager-6ea7dedfaaced647.jpeg?auto=format%2Ccompress&fm=jpeg&q=20'
//]);


//////
//$fileDB = new Core\FileDB(DB_FILE);
//$fileDB->load();
//$fileDB->createTable('drinks');
////
//$fileDB->insertRow('drinks', $drink->getData());
//$var  = $fileDB->getRowsWhere('drinks', ['abarot' => 4.7]);


//$modelDrinks->insert($drink_absent);
//$modelDrinks->insert($drink_corona);
//$modelDrinks->insert($drink_heineken);
//$modelDrinks->insert($drink_finland);

//$filtered_input = get_form_input($form);
//validate_form($filtered_input, $form);
//
//$drinks = $modelDrinks->get();
//var_dump($drinks);
//
//var_dump($filtered_input);
//$drink = new App\Drinks\Drink([
//$filtered_input;
//]);


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

<h1>Welcome to the best site</h1>
<h2>Pavel ir Co.</h2>


<!--<div>-->
<!--    --><?php //foreach ($drinks as $key => $drink): ?>
<!--        <h1>--><?php //print $drink->getName(); ?><!--</h1>-->
<!--        <h2>--><?php //print $drink->getAmount(); ?><!--</h2>-->
<!--        <h3>--><?php //print $drink->getAbarot(); ?><!--</h3>-->
<!--        <img src="--><?php //print $drink->getImage(); ?><!--" alt="foto">-->
<!--    --><?php //endforeach; ?>
<!--</div>-->
</body>
</html>
