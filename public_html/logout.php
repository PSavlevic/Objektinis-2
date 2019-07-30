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

if(!empty($_SESSION)) {
    $_SESSION = [];
}

header('Location: '.'index.php');
