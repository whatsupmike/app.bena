<?php

    return [

        /*
        |--------------------------------------------------------------------------
        | Authentication Language Lines
        |--------------------------------------------------------------------------
        |
        | The following language lines are used during authentication for various
        | messages that we need to display to the user. You are free to modify
        | these language lines according to your application's requirements.
        |
        */
        'navbar' => 'Cars',
        'create' => [
            'header' => 'Add car',
            'labels' => [
                'car_name' => 'Car name',
                'registration_plate' => 'Registration plate',
                'odometer' => 'Odometer'
            ],
            'buttons' => [
                'submit' => 'Save'
            ]
        ],
        'edit' => [
            'header' => 'Edit car',
            'labels' => [
                'car_name' => 'Car name',
                'registration_plate' => 'Registration plate',
            ],
            'buttons' => [
                'submit' => 'Update'
            ]
        ],
        'index' => [
            'header' => 'Cars index',
            'add_button' => 'Create car',
            'table' => [
                'no' => 'No.',
                'car_name' => 'Car name',
                'registration_plate' => 'Registration plate',
                'actions' => 'Actions'
            ]
        ]

    ];
