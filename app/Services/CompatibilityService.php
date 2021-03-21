<?php

namespace App\Services;

class CompatibilityService
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
            'HH' => ['HH'],
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
            'HH' => ['HH'],
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
            'HH' => ['HH'],
        ],
        'rbc' => [
            'A+' => ['A+', 'AB+'],
            'A-' => ['A-', 'AB-'],
            'B+' => ['B+', 'AB+'],
            'B-' => ['B-', 'AB-'],
            'AB+' => ['AB+'],
            'AB-' => ['AB-'],
            'O+' => ['A+', 'B+', 'AB+', 'O+'],
            'O-' => ['O-'],
            'HH' => ['HH'],
        ],
        'wbc' => [
            'A+' => ['A+', 'AB+'],
            'A-' => ['A-', 'AB-'],
            'B+' => ['B+', 'AB+'],
            'B-' => ['B-', 'AB-'],
            'AB+' => ['AB+'],
            'AB-' => ['AB-'],
            'O+' => ['A+', 'B+', 'AB+', 'O+'],
            'O-' => ['O-'],
            'HH' => ['HH'],
        ],
    ];

    private static $safeDonateAt = [
        'whole' => 30,
        'platelets' => 30,
        'plasma' => 30,
        'wbc' => 30,
        'rbc' => 30,
    ];

    private static $expiryAt = [
        'whole' => 90,
        'platelets' => 90,
        'plasma' => 90,
        'wbc' => 90,
        'rbc' => 90,
    ];

    public static function recipient($component, $group)
    {
        return self::$recipient[$component][$group];
    }

    public static function safeDonateAt(string $component)
    {
        return today()->addDays(self::$safeDonateAt[$component]);
    }

    public static function expiryAt($component)
    {
        return today()->addDays(self::$expiryAt[$component]);
    }

}