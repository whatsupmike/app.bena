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
        'navbar' => 'Trips',
        'create' => [
            'header' => 'Add trip',
            'labels' => [
                'odometer_before' => 'Odometer before the trip',
                'odometer_after' => 'Odometer after the trip',
                'trip_distance' => 'Trip distance',
                'car_select' => 'Car',
                'trip_notes' => 'Trip notes',
                'trip_passengers' => 'Passengers'
            ],
            'buttons' => [
                'submit' => 'Save'
            ]
        ],
        'edit' => [
            'header' => 'Edit trip',
            'labels' => [
                'odometer_before' => 'Odometer before the trip',
                'odometer_after' => 'Odometer after the trip',
                'trip_distance' => 'Trip distance',
                'car_select' => 'Car',
            ],
            'buttons' => [
                'submit' => 'Update'
            ]
        ],
        'index' => [
            'header' => 'Trips index',
            'add_button' => 'Add trip',
            'table' => [
                'no' => 'No.',
                'car_name' => 'Car name',
                'distance' => 'Distance',
                'odometer_after' => 'Odometer after',
                'actions' => 'Actions'
            ]
        ],
        'js' => [
            'error' => [
                'no-negative-trip' => "Trip can't be negative!"]
        ],
        'messages' => [
            'success' => 'Trip added successfully!',
            'no-full-fueling' => 'There is no full refueling for this car!'
        ]


    ];
