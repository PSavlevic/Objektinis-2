<?php
require '../../../bootloader.php';
//$_SESSION ifas tikrina ar useris prisilogines ir tik tada leidzia update drinko diva su visa info
if ($_SESSION) {
    $drinksModel = new App\Drinks\Model();
    //gauname areju su $drink objektais (siuo atveju viena objekta arejuje pagal paduota id
    $drinks = $drinksModel->get(['row_id' => intval($_POST['id'])]);
//    var_dump('$drinks: ', $drinks);
    //is gauto arejaus pasiimame pagal paduota id $drink objekta
    $drink = $drinks[0];
//    var_dump($drink);
//
//    Grazina is paduoto $drink objekto array su $drink klases metodu getData():
//    var_dump($drink->getData());
    if (!$drink) {
        print json_encode([
            'status' => 'fail',
            'errors' => [
                'Drink doesn`t exist'
            ]
        ]);
    } else {
        print json_encode([
            'status' => 'success',
            'errors' => [],
            'data' => $drink->getData()
        ]);
    }
}