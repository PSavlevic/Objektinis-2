<?php
require '../../../bootloader.php';

//dar truksta validate_form() ir filtered_input(), kad prasanitaizinti, ka ivede
//useris. Dareme analogiskai create.php
//$_SESSION ifas tikrina ar useris prisilogines ir tik tada leidzia update drinko diva su visa info
if ($_SESSION) {
    $drinksModel = new App\Drinks\Model();
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
        //idedame i data holderi naujas vertes, kurias ivede useris ir kurios atejo is javascripto is fetch_update.php
        $drink->setName($_POST['name']);
        $drink->setAmount($_POST['amount_ml']);
        $drink->setAbarot($_POST['abarot']);
        $drink->setImage($_POST['image']);
        //vertes, kurias idejome auksciau i data holderi updatinam ir duombazeje FileDB ka daro $drinksModel->update($drink) metodas
        $drinksModel->update($drink);
//        var_dump($drink->getData());
        print json_encode([
            'status' => 'success',
            'errors' => [],
            'data' => $drink->getData()
        ]);
    }
}