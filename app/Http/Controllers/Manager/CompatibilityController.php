<?php

namespace App\Http\Controllers\Manager;

class CompatibilityController
{
    private static $recipient = [
        'whole' => [
            'A+' => ['A+', 'AB+'],
            'A-' => ['A-', 'AB-'],
            'B+' => ['B+', 'AB+'],
            'B-' => ['B-', 'AB-'],
            'AB+' => ['AB+'],
            'AB-' => ['AB-'],
            'O+' => ['A+', 'B+', 'AB+', 'O+'],
            'O-' => ['O-'],
        ],
        'platelets' => [
            'A+' => ['A+', 'AB+'],
            'A-' => ['A-', 'AB-'],
            'B+' => ['B+', 'AB+'],
            'B-' => ['B-', 'AB-'],
            'AB+' => ['AB+'],
            'AB-' => ['AB-'],
            'O+' => ['A+', 'B+', 'AB+', 'O+'],
            'O-' => ['O-'],
        ],
        'plasma' => [
            'A+' => ['A+', 'AB+'],
            'A-' => ['A-', 'AB-'],
            'B+' => ['B+', 'AB+'],
            'B-' => ['B-', 'AB-'],
            'AB+' => ['AB+'],
            'AB-' => ['AB-'],
            'O+' => ['A+', 'B+', 'AB+', 'O+'],
            'O-' => ['O-'],
        ]
    ];

    //No. of Days for safe donate
    private static $safeDonate = [
        'whole' => '90',
        'platelets' => '30',
        'plasma' => '10',
    ];

    public static function recipient($bloodComponent = null, $bloodGroup = null)
    {
        return self::$recipient[$bloodComponent][$bloodGroup];
    }

    public static function safeDonate($bloodComponent = null, $bloodGroup = null)
    {
        return self::$recipient[$bloodComponent][$bloodGroup];
    }
}
