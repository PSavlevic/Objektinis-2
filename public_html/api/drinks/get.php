<?php
require '../../../bootloader.php';

$drinksModel = new \App\Drinks\Model();

$conditions = [];

if ($_POST['conditions'] ?? false) {
    $conditions = json_decode($_POST['conditions'], true);
}

$response = [
    "status" => null,
    "data" => [],
];

    $drinks = $drinksModel->get($conditions);
if ($drinks !== false) {
    foreach ($drinks as $drink_id => $drink) {
        $response['data'][] = $drink->getData();
    }
    $response['status'][] = 'success';

} else {
    $response['status'][] = 'fail';
}

print json_encode($response);
