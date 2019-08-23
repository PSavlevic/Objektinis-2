<?php

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
<div class="wrapper">
    <h1>Prideti gerima</h1>
    <form id="create-form">
        <div>
            <input type="text" name="name" placeholder="Type your drink name">
        </div>
        <div>
            <input type="number" name="amount_ml" placeholder="Type amount">
        </div>
        <div>
            <input type="number" name="abarot" placeholder="How much %">
        </div>
        <div>
            <input type="text" name="image" placeholder="Type url your image">
        </div>
        <input type="submit">
    </form>
    <div id="drinks-container">
        ​
    </div>
</div>
<script>
    const endpointUrl = "api/drinks/create.php";
    const drinksDiv = document.getElementById("drinks-container");

    document.getElementById("create-form")
        .addEventListener("submit", e => {
            e.preventDefault();
            // Kad PHP traktuotų requestą kaip POST
            // ir normaliai sudėtų į _POST duomenis
            // reikia kurti FormData.
            let formData = new FormData(document.querySelector('form'));
            // Kreipiamės į savo API'jų
            fetch(endpointUrl, {
                method: "POST",
                // Tai yra POST'o duomenys. Atsiminkime brangieji
                body: formData
            })
            // Serverio atsakymas (jau JSONinis)
                .then(response => {
                    // Kadangi responsas pas mus get.php
                    // yra json encodintas, tai mes naudojam
                    // nebe .text() o .json().
                    response.json()
                        .then(obj => {
                            if (obj.status == 'success') {
                                displayDrink(obj.data);
                                // ŠITAS OBJ yra javascriptinis objektas
                                // (išdecodintas jsonas)
                                console.log(obj);
                            } else {
                                displayErrors(obj.errors);
                            }
                        });
                })
                .catch(e => console.log(e.message));
        });

    function displayErrors(errors) {
        console.log(errors);
        removeErrors();
        Object.keys(errors).forEach(function (error_id) {
            console.log(error_id, errors[error_id]);
            const field = document.querySelector('input[name="' + error_id + '"]');
            const span = document.createElement("span");
            span.className = 'field_error';
            span.append(document.createTextNode(errors[error_id]));
            field.parentNode.append(span);
            console.log(field);
        })
    }

    function removeErrors() {
        const errors = document.querySelectorAll('.field_error');
        if (errors) {
            Array.prototype.forEach.call(errors, function (node) {
                node.parentNode.removeChild(node);
            });
        }
    }

    function displayDrink(value) {
        const h2name = document.createElement("h2");
        const h2abarot = document.createElement("h2");
        const h2amount = document.createElement("h2");
        const img = document.createElement("img");
        img.src = value.image;
        h2name.innerHTML = value.name;
        h2abarot.innerHTML = value.abarot;
        h2amount.innerHTML = value.amount_ml;
        drinksDiv.innerHTML = "";
        drinksDiv.append(h2name, h2abarot, h2amount, img);
    }
</script>
</body>
</html>