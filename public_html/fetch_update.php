<?php

use App\Drinks\Drink;
use App\Drinks\Model;
use Core\View;

require '../bootloader.php';

if ($_SESSION) {
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


$update_form = [
    'attr' => [
        //'action' => '', Nebūtina, jeigu action yra ''
        'id' => 'update-form',
        'method' => 'POST',
    ],
    'fields' => [
        'name' => [
            'label' => 'Pavadinimo keitimas',
            'type' => 'text',
            'extra' => [
                'validators' => [
                    'validate_not_empty',
                ]
            ],
        ],
        'amount_ml' => [
            'label' => 'Amount(ml) keitimas',
            'type' => 'text',
            'extra' => [
                'validators' => [
                    'validate_not_empty',
                ]
            ],
        ],
        'abarot' => [
            'label' => 'Abarotu keitimas',
            'type' => 'text',
            'extra' => [
                'validators' => [
                    'validate_not_empty'
                ]
            ],
        ],
        'image' => [
            'label' => 'Image linko keitimas',
            'type' => 'text',
            'extra' => [
                'validators' => [
                    'validate_not_empty',
                ]
            ],
        ],
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Update',
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
        'validate_login'
    ]
];


$modelDrinks = new App\Drinks\Model();
$drinks = $modelDrinks->get();

$newUpdateObject = new Core\View($update_form);
$newNavRegisterObject = new Core\View($nav);

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>title</title>
    <link rel="stylesheet" href="media/css/normalize.css">
    <link rel="stylesheet" href="media/css/milligram.min.css">
    <link rel="stylesheet" href="media/css/style.css">
</head>
<body>

<?php print $newNavRegisterObject->render(ROOT . '/app/templates/navigation.tpl.php'); ?>

<div class="content">
    <h1 class="vakaro-meniu">Vakaro MENIU</h1>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <?php print $newUpdateObject->render(ROOT . '/core/templates/form/form.tpl.php'); ?>
        </div>
    </div>
    <div class="gerimai">
        <?php foreach ($drinks as $drink): ?>
            <div class="gerimas">
                <?php if ($_SESSION): ?>
                    <button class="update-btn" data-id="<?php print $drink->getId(); ?>">Update</button>
                <?php endif; ?>
                <h1><?php print $drink->getName(); ?></h1>
                <h2><?php print $drink->getAmount(); ?>ml</h2>
                <h3><?php print $drink->getAbarot(); ?>%</h3>
                <img src="<?php print $drink->getImage(); ?>">
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.querySelectorAll(".update-btn");
    btn.forEach(function (selected) {
        selected.onclick = function () {
            modal.style.display = "block";
        }
    });

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];


    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    const buttonUpdate = document.querySelectorAll(".update-btn");
    const updateUrl = "api/drinks/update.php";
    buttonUpdate.forEach(function (selectedButton) {
        //                       console.log(selectedButton.getAttribute("data-id"));
        selectedButton.addEventListener("click", e => {
            e.preventDefault();
            const drinkId = e.target.getAttribute('data-id');
//                        Dar vienas fetchas, kad gauti duomenis is DB ir juos atvaizduoti
//                        kaip value inputuose pries ivedant naujus value i inputus
            let formValueData = new FormData();
            formValueData.append('id', drinkId);
            fetch("api/drinks/get_by_id.php", {
                method: "POST",
                body: formValueData
            })
                .then(response => response.json())
                .then(obj => {
                    if (obj.status == 'success') {
                        showUpdateForm(obj.data);
                    } else {
                        console.log("nepavyko");
                    }
                    console.log(obj);
                })
                .catch(e => console.log(e.message));
//                        dar vienas eventlisteneris pop up formai
        })
    });


    function showUpdateForm(data) {
        let updateForm = document.querySelector("#update-form");
        updateForm.name.value = data.name;
        updateForm.amount_ml.value = data.amount_ml;
        updateForm.abarot.value = data.abarot;
        updateForm.image.value = data.image;
//                                        document.querySelector("#update-form input[name='name']").value = obj.data.name;
                    updateForm.addEventListener('submit', function updateOnClick(e) {
                        e.preventDefault();
                        this.removeEventListener('submit', updateOnClick);

                        let formData = new FormData(e.target);
                        //e.target.name.value yra userio ivesta inputo verte
                        //o e.target yra visi inputai ivesti userio
                        formData.append('id', data.id);
                        fetch(updateUrl, {
                            method: "POST",
                            body: formData
                        })
                            .then(response => response.json())
                            .then(obj => {
                                if (obj.status == 'success') {
                                    updateDrinkInList(obj.data);
                                    //padaro forma display none auksciau esantis modal kodas
                                    modal.style.display = "none";
                                } else {
                                    console.log("nepavyko");
                                }
                                console.log(obj);
                            })
                            .catch(e => console.log(e.message))
                    });
    }


    function updateDrinkInList(data) {
        //parasyti, kad ne refreshinus puslapio su javascriptu atvaizduotu ivestus userio duomenis
//                    console.log(data.name);
//                      console.log(data.id);
        const updatingDrinkDiv = document.querySelector('*[data-id="' + data.id + '"]');
        console.log(updatingDrinkDiv);
        const mainDiv = updatingDrinkDiv.parentNode;
        const drinkH1 = mainDiv.querySelector("h1");
        drinkH1.innerHTML = data.name;
        const drinkH2 = mainDiv.querySelector("h2");
        drinkH2.innerHTML = data.amount_ml + "ml";
        mainDiv.querySelector("h3").innerHTML = data.abarot+"%";
        mainDiv.querySelector("img").src = data.image;
    }
</script>
</body>
</html>