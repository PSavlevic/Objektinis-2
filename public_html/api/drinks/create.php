<?php
require '../../../bootloader.php';

$form = [
    'fields' => [
        'name' => [
            'type' => 'text',
            'extra' => [
                'validators' => [
                    'validate_not_empty',
                ]
            ],
        ],
        'amount_ml' => [
            'type' => 'number',
            'extra' => [
                'validators' => [
                    'validate_not_empty',
                ]
            ],
        ],
        'abarot' => [
            'type' => 'number',
            'extra' => [
                'validators' => [
                    'validate_not_empty'
                ]
            ],
        ],
        'image' => [
            'type' => 'text',
            'extra' => [
                'validators' => [
                    'validate_not_empty'
                ]
            ],
        ],
    ],
    'callbacks' => [
        'success' => 'form_success',
        'fail' => 'form_fail'
    ],
];

$filtered_input = get_form_input($form);
validate_form($filtered_input, $form);

function form_success($filtered_input, &$form) {
    $newDrink = new App\Drinks\Drink($filtered_input);
    $modelDrink = new App\Drinks\Model();
    $modelDrink->insert($newDrink);

    $response = [
        'status' => 'success',
        'data' => $newDrink->getData(),
        'error' => []
    ];
    print json_encode($response);
}

function form_fail($filtered_input, &$form) {
    $errors = [];
    foreach ($form['fields'] as $field_id => $field) {
        if (isset($field['error'])) {
            $errors[$field_id] = $field['error'];
        }
    }

    $response = [
        'status' => 'fail',
        'data' => [],
        'errors' => $errors
    ];
    print json_encode($response);
}