<?php

use Core\View;

require '../bootloader.php';
//ob_start();
//print 'testukas';
//print 'antras testukas';
//$output = ob_get_clean();
//
//var_dump($output);

$nav = [
    'left' => [
        ['url' => '/index.php', 'title' => 'Home'],
        ['url' => '/register.php', 'title' => 'Register'],
        ['url' => '/login.php', 'title' => 'Login'],
        ['url' => '/logout.php', 'title' => 'Logout'],
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

$newRegisterObject = new Core\View($form);
$newNavRegisterObject = new Core\View($nav);

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test1</title>
    <link rel="stylesheet" href="media/css/normalize.css">
    <link rel="stylesheet" href="media/css/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <script defer src="media/js/app.js"></script>
</head>
<body>
<?php require ROOT . '/app/templates/navigation.tpl.php'; ?>

<div class="content">
    <?php print $viewObject->render(ROOT . '/core/templates/form/form.tpl.php'); ?>
</div>

</body>
</html>