<?php
require '../../../bootloader.php';

$drinksModel = new App\Drinks\Model();
// fetch-as atsiunčia į šitą failą POST metodu duomenis (REQUEST)
// tie duomenys tai yra formData
//
// Į formData buvom įtraukę drink'o id. Vadinasi POST'e indeksu id rasim
// to drink'o id verte.
//
// Zinodami koks drinko eilutes id, galime su model'iu issitraukti
// ta drinka. Bet get funkcija atiduoda ne "iskart" ta drinka
// bet visada ideda ji i masyva. (nes funkcija pritaikyta atiduoti ir daugiau drinku
// nei viena)
// Todel pavadinam variabla ne drink, o drinks.
$drinks = $drinksModel->get(['row_id' => intval($_POST['id'])]);

if($_SESSION) {
    if(!$drinks){
        print json_encode([
            'status' => 'fail',
            'errors' => [
                'Drink doesn`t exist'
            ]
        ]);
    } else {
        // Kadangi tokiu id drink'as visada bus tik vienas
        // mes galim drasiai teigti, kad jis bus pirmasis elementas masyve
        $drinksModel->delete($drinks[0]);
        print json_encode([
            'status' => 'success',
            'errors' => []
        ]);
    }
} else {
    print json_encode([
        'status' => 'fail',
        'errors' => [
            'You not logged in'
        ]
    ]);
}