<?php

use App\Drinks\Drink;
use Core\View;

require '../bootloader.php';

if($_SESSION) {
    $nav = [
        'left' => [
            ['url' => '/index.php', 'title' => 'Home'],
            ['url' => '/fetch_create.php', 'title' => 'Create Drink'],
            ['url' => '/drinks.php', 'title' => 'Drinks.php'],
            ['url' => '/fetch_update.php', 'title' => 'Update(edit)'],
            ['url' => '/fetch.php', 'title' => ' Find drink'],
            ['url' => '/logout.php', 'title' => 'Logout']
        ]
    ];
} else {
    $nav = [
        'left' => [
            ['url' => '/index.php', 'title' => 'Home'],
            ['url' => '/fetch_create.php', 'title' => 'Create Drink'],
            ['url' => '/drinks.php', 'title' => 'Drinks.php'],
            ['url' => '/fetch.php', 'title' => ' Find drink'],
            ['url' => '/register.php', 'title' => 'Register'],
            ['url' => '/login.php', 'title' => 'Login'],
        ]
    ];
}

function insert_drinks()
{
    $drinksModel = new App\Drinks\Model();

    $drink_finland = new App\Drinks\Drink([
        //'id' => 0,
        'name' => 'Finlandia',
        'amount_ml' => 7500,
        'abarot' => 40,
        'image' => 'https://cdn.diffords.com/contrib/bws/2017/10/59db863511455.jpg'
    ]);
    $drink_absent = new App\Drinks\Drink([
        //'id' => 0,
        'name' => 'Absent',
        'amount_ml' => 5000,
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
        'amount_ml' => 3800,
        'abarot' => 4,
        'image' => 'https://products3.imgix.drizly.com/ci-angry-orchard-green-apple-cider-48a085b2c6221f9e.jpeg?auto=format%2Ccompress&dpr=2&fm=jpeg&h=240&q=20'
    ]);
    $drinksModel->insert($drink_absent);
    $drinksModel->insert($drink_finland);
    $drinksModel->insert($drink_beer);
    $drinksModel->insert($drink_cider);
}

//insert_drinks();

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

$newRegisterObject = new Core\View($form);
$newNavRegisterObject = new Core\View($nav);

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
<?php print $newNavRegisterObject->render(ROOT . '/app/templates/navigation.tpl.php'); ?>

<div class="content">
    <h1 class="vakaro-meniu">Vakaro MENIU</h1>

    <?php print $newRegisterObject->render(ROOT . '/core/templates/form/form.tpl.php'); ?>

    <div class="gerimai">
        <?php foreach ($drinks as $drink): ?>
            <div class="gerimas">
                <?php if($_SESSION): ?>
                <span class="delete-btn" data-id="<?php print $drink->getId(); ?>">Delete</span>
                <?php endif; ?>
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
    // Funkcija registruojanti form'os submit'o listenerį
    function addListener() {
        // Paselect'inam form'ą, kurios ID yra drinks-form
        document.getElementById("drinks-form")
        // uždedam jai event'o listenerį, kuris suveiks ją submitinus
            .addEventListener("submit", e => {
                // default'inė event'o f-ija, kuri užkerta (preventina)
                // puslapio perkrovimą submit'inus formą
                e.preventDefault();
                // Sukuriam default'ini objektą FormData
                // Tai yra "tuščia dėžė", kurią nusiųsime
                // duomenis POST metodu. Į ją append'inam duomenis
                let formData = new FormData();
                // Paduodame paspausto mygtuko duomenis
                formData.append('action', 'submit');
                // Kadangi tik po paspaudimo žinome, kokį gėrimą pasirinko
                // useris, appendiname select'o su name "gerimas" value:
                formData.append('gerimas', e.target.gerimas.value); // itraukiam gerimas:gerimo_id
                // Fetch'as paima duomenis iš tam tikro URL'o
                fetch("./drinks.php", {
                    // Prieš gaunant duomenis, mes galime juos išsiųsti
                    // tam tikru metodu. Šiuo atveju naudojame POST
                    method: "POST",
                    // Tai yra duomenys, kuriuos nusiunčiame į drinks.php
                    // Naudojame formData dėl to, kad PHP tinkamai atpažintų
                    // duomenis ir juos sudėtų į $_POST masyvą
                    body: formData
                })
                // Gavus atsaką iš drinks.php, iškviečiama ši funkcija
                    .then(response => {
                        // Norėdami gauti tekstą (HTML) iš atsako,
                        // naudojame šį kodą
                        response.text().then(text => {
                            console.log("done");
                            // Kadangi atsako tekstas yra visas puslapio HTML
                            // mes esamą HTML'ą perrašome su gautu (text)
                            document.querySelector("html").innerHTML = text;
                            // Kadangi perrašius HTML'ą nusimuša visi event'ų
                            // listeneriai, reikia iš naujo užregistruoti
                            addListener();
                        });
                    })
                    .catch(e => {
                        // Nes eik nx
                        console.log(e);
                    });
            });
    }
    // Pirmo užkrovimo metu, registruojame listenerį formai
    addListener();

    const delUrl = "/api/drinks/delete.php";
    const deleteButtons = document.querySelectorAll(".delete-btn");
    deleteButtons.forEach(function (button) {
        button.addEventListener("click", e => {
            e.preventDefault();
            const drinkId = e.target.getAttribute('data-id');
            let formData = new FormData();
            formData.append('id', drinkId);
            fetch(delUrl, {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.status == 'success') {
                        e.target.parentNode.remove();
                    } else {
                        console.log("nepavyko")
                    }
                })
                .catch(e => console.log(e.message));
        })
    });
</script>
</body>
</html>