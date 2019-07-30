<?php

use App\Users\User;
use App\Users\Model;
use Core\FileDB;


require '../bootloader.php';

$nav = [
    'left' => [
        ['url' => '/index.php', 'title' => 'Home'],
        ['url' => '/register.php', 'title' => 'Register'],
        ['url' => '/login.php', 'title' => 'Login'],
        ['url' => '/logout.php', 'title' => 'Logout']
    ]
];


$form = [
    'attr' => [
        //'action' => '', Nebūtina, jeigu action yra ''
        'method' => 'POST',
    ],
    'fields' => [
        'email' => [
            'label' => 'Email',
            'type' => 'email',
            'extra' => [
                'validators' => [
                    'validate_not_empty',
                    //validate float
                ]
            ],
        ],
        'password' => [
            'label' => 'Password',
            'type' => 'password',
            'extra' => [
                'validators' => [
                    'validate_not_empty'
                ]
            ],
        ],
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Login',
            'extra' => [
                'attr' => [
                    'class' => 'red-btn'
                ]
            ]
        ],
//        'delete' => [
//            'title' => 'LogOut',
//            'extra' => [
//                'attr' => [
//                    'class' => 'blue-btn'
//                ]
//            ]
//        ],
    ],

    'callbacks' => [
        'success' => 'form_success',
        'fail' => 'form_fail'
    ],
    'validators' => [
        'validate_login'
    ]
];

function form_success($filtered_input, &$form) {
    print 'Sveikinu, tu prisiloginai!';
    $_SESSION = $filtered_input;
    var_dump($_SESSION);
}

function form_fail($filtered_input, &$form) {
    print 'Neprisiloginai...';
}

$filtered_input = get_form_input($form);

switch (get_form_action()) {
    case 'submit':
        validate_form($filtered_input, $form);
        break;
    case 'delete':
        foreach ($modelUsers->get() as $drink) {
            $modelUsers->deleteAll($drink);
        }
}

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
<h1>Login forma:</h1>
<div class="content">
    <?php require ROOT . '/core/templates/form/form.tpl.php'; ?>
</div>
</body>
</html>
