<?php
require '../../../bootloader.php';

$drinksModel = new \App\Drinks\Model();

$conditions = [];

if ($_POST['conditions'] ?? false) {
    $conditions = json_decode($_POST['conditions']);
}

    $drinks = $drinksModel->get($conditions);
if ($drinks) {
    $drinks_array = [];
    foreach ($drinks as $drink_id => $drink) {
        $drinks_array[] = $drink->getData();
    }

    $json_arr = [
        "status" => "success",
        "data" => $drinks_array,
    ];

} else {
    $json_arr = [
        "status" => "fail",
        "data" => [],
    ];
}

print json_encode($json_arr);
