<?php

//use App\Users\Model;

function validate_login($filtered_input, &$form)
{
//    var_dump('$filtered input: ', $filtered_input);
    $modelUsers = new \App\Users\Model();
    $user = $modelUsers->get([
        'email' => $filtered_input['email'],
        'password' => $filtered_input['password']
    ]);
//    var_dump('$user: ', $user);
    if (empty($user)) {
        $form['fields']['password']['error'] = 'Patikrink maila arba passworda!';
        return false;
    }
    return true;
}

function validate_fields_match($filtered_input, &$form, $validator)
{
    var_dump($filtered_input);
    $pirmas_passwordas = $filtered_input['password'];
    foreach ($validator as $value) {
        if ($filtered_input[$value] !== $pirmas_passwordas) {
            var_dump($filtered_input[$value]);
            $form['fields']['password2']['error'] = "slaptazodziai nesutampa ";
            return false;
            break;
        }
    }
    return true;
}