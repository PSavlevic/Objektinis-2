<?php

use App\Users\User;
use App\Users\Model;
use Core\FileDB;


require '../bootloader.php';

$nav = [
    'left' => [
        ['url' => '/index.php', 'title' => 'Home'],
        ['url' => '/register.php', 'title' => 'Register']
    ]
];


$modelUsers = new App\Users\Model();

//$testasApp = \App\App::$db->getData();
//var_dump($testasApp);


$form = [
    'attr' => [
        //'action' => '', Nebūtina, jeigu action yra ''
        'method' => 'POST',
    ],
    'fields' => [
        'name' => [
            'label' => 'Username',
            'type' => 'text',
            'extra' => [
                'validators' => [
                    'validate_not_empty',
                ]
            ],
        ],
        'email' => [
            'label' => 'Email',
            'type' => 'email',
            'extra' => [
                'validators' => [
                    'validate_not_empty',
                    'validate_mail'
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
            'title' => 'Prideti useri',
            'extra' => [
                'attr' => [
                    'class' => 'red-btn'
                ]
            ]
        ],
        'delete' => [
            'title' => 'Istrinti visus',
            'extra' => [
                'attr' => [
                    'class' => 'blue-btn'
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


$filtered_input = get_form_input($form);
//if (!empty($filtered_input)) {
//    validate_form($filtered_input, $form, $modelDrinks);
//}
function form_success($filtered_input, &$form)
{
    $vartotojas = new App\Users\User($filtered_input);
    $modelUseris = new App\Users\Model();
    $modelUseris->insert($vartotojas);
}

function form_fail()
{
    print 'fail';
}

function validate_mail ($filtered_input, &$field){
 $modelUser = new App\Users\Model();
 $users = $modelUser->get(['email' => $filtered_input]);
 if($users) {
  $field['error'] = 'toks mailas egzistuoja!';
  return false;
 }
 return true;
}

switch (get_form_action()) {
    case 'submit':
        validate_form($filtered_input, $form);
        break;
    case 'delete':
        foreach ($modelUsers->get() as $drink) {
            $modelUsers->delete($drink);
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

<div class="content">
    <?php require ROOT . '/core/templates/form/form.tpl.php'; ?>
</div>
</body>
</html>
