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
        'navbar' => 'Analiza',
        'create' => [
            'header' => 'Dodaj tankowanie',
            'labels' => [
                'fuel_quantity' => 'Ilość paliwa',
                'fuel_price' => 'Cena paliwa',
                'fuel_value' => 'Wartość paliwa',
                'is_full' => 'Tankowanie do pełna',
                'car_select' => 'Samochód',
                'fuel_notes' => 'Notatki',
            ],
            'buttons' => [
                'submit' => 'Zapisz'
            ]
        ],
        'messages' => [
            'success'   => 'Poprawnie rozliczono ostatnie tankowania!',
            'void'      => 'Nie ma co rozliczać!',
        ],
        'index' => [
            'header' => 'Analiza',
            'settlement_button' => 'Rozlicz tankowania',
            'table' => [
                'no' => 'Nr.',
                'passenger_name' => 'Pasażer',
                'to_pay' => 'Do zapłacenia',
                'actions' => 'Rozliczone'
            ]
        ]


    ];
