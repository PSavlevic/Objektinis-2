<?php

use App\Drinks\Drink;

require '../bootloader.php';

$nav = [
    'left' => [
        ['url' => '/index.php', 'title' => 'Home'],
        ['url' => '/drinks.php', 'title' => 'Drinks'],
        ['url' => '/register.php', 'title' => 'Register'],
        ['url' => '/login.php', 'title' => 'Login'],
        ['url' => '/logout.php', 'title' => 'Logout']
    ]
];

function insert_drinks()
{
    $drinksModel = new App\Drinks\Model();

    $drink_finland = new App\Drinks\Drink([
        //'id' => 0,
        'name' => 'Finlandia',
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
    $drink_beer = new App\Drinks\Drink([
        //'id' => 0,
        'name' => 'Svyturys',
        'amount_ml' => 500,
        'abarot' => 5,
        'image' => 'https://lt1.pigugroup.eu/colours/219/837/20/21983720/447ce40e9b567ecbbe8b0daa598fa6f8_large.jpg'
    ]);
    $drink_cider = new App\Drinks\Drink([
        //'id' => 0,
        'name' => 'Sidras',
        'amount_ml' => 380,
        'abarot' => 4,
        'image' => 'https://products3.imgix.drizly.com/ci-angry-orchard-green-apple-cider-48a085b2c6221f9e.jpeg?auto=format%2Ccompress&dpr=2&fm=jpeg&h=240&q=20'
    ]);
    $drinksModel->insert($drink_absent);
    $drinksModel->insert($drink_finland);
    $drinksModel->insert($drink_beer);
    $drinksModel->insert($drink_cider);
}

function get_form()
{
    return [
        'attr' => [
            //'action' => '', Neb?tina, jeigu action yra ''
            'method' => 'POST',
        ],
        'fields' => [
            'gerimas' => [
                'label' => 'Gerimas',
                'type' => 'select',
                'options' => get_options(),
            ],
        ],
        'buttons' => [
            'submit' => [
                'title' => 'Drink!',
                'extra' => [
                    'attr' => [
                        'class' => 'red-btn'
                    ]
                ]
            ],
        ],
        'callbacks' => [
            'success' => 'form_success',
            'fail' => 'form_fail'
        ],
        'validators' => [
        ]
    ];
}

function get_options()
{
    $drinksModel = new App\Drinks\Model();
    $drinks = $drinksModel->get();
    $options = [];

    foreach ($drinks as $drink_id => $drink) {

        $options[$drink->getId()] = $drink->getName();
    }
    return $options;
}

function form_success($filtered_input, &$form)
{

    $drink_id = $filtered_input['gerimas'];

    $modelDrinks = new App\Drinks\Model();
    $drinks = $modelDrinks->get(['row_id' => $drink_id]);

    /** @var \App\Drinks\Drink Description * */
    $drink = $drinks[0];
    $drink->drink();

    if ($drink->getAmount() > 0) {
        $modelDrinks->update($drink);
    } else {
        $modelDrinks->delete($drink);
        $form['fields']['gerimas']['options'] = get_options();
    }
}

function form_fail()
{
    print 'fail';
}

$form = get_form();
$filtered_input = get_form_input($form);

switch (get_form_action()) {
    case 'submit':
        validate_form($filtered_input, $form);
        break;
}

$modelDrinks = new App\Drinks\Model();
$drinks = $modelDrinks->get();


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
    <h1 class="vakaro-meniu">Vakaro MENIU</h1>
    <?php var_dump($_POST); ?>
    <?php require ROOT . '/core/templates/form/form.tpl.php'; ?>

    <div class="gerimai">
        <?php foreach ($drinks as $drink): ?>
            <div class="gerimas">
                <h1><?php print $drink->getName(); ?></h1>
                <h1><?php print $drink->getAmount(); ?>ml</h1>
                <h1><?php print $drink->getAbarot(); ?>%</h1>
                <img src="<?php print $drink->getImage(); ?>">
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    'use strict';

    document.getElementById("drinks-form").addEventListener("submit", e => {
        e.preventDefault();

        fetch("./drinks.php", {
            method: "POST",
            body: {
                gerimas: e.target.gerimas.value,
                action: "submit"
            }
        })
            .then(response => {
                response.text().then(text => {
                    console.log("done");
                    document.querySelector("html").innerHTML = text;
                    //document.getElementsByTagName('html').innerHTML = text;
                });
        })
            .catch(e => {
                console.log(e);
            })
    });
</script>
</body>
</html>