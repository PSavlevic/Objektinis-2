<?php
require '../../../bootloader.php';

$drinksModel = new App\Drinks\Model();
$drink = $drinksModel->get(['id' => intval($_POST['id'])]);
if (!$drink) {
    print json_encode([
        'status' => 'fail',
        'errors' => [
            'Drink doesn`t exist'
        ]
    ]);
} else {
    $drinksModel->delete($drink);
    print json_encode([
        'status' => 'success',
        'errors' => []
    ]);
}
?>