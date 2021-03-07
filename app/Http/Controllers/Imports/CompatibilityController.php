<?php

namespace App\Http\Controllers\Imports;

class CompatibilityController
{
    private $recipient = [
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
        ],
    ];

    //No. of Days for safe donate
    private $safeDonate = [
        'whole' => '90',
        'platelets' => '30',
        'plasma' => '10',
        'rbc' => '14',
        'wbc' => '14',
    ];

    public function recipient($bloodComponent = null, $bloodGroup = null)
    {
        return $this->recipient[$bloodComponent][$bloodGroup];
    }

    public function safeDonate($bloodComponent = null)
    {
        $date = date_create();
        date_add($date,date_interval_create_from_date_string($this->safeDonate[$bloodComponent] . "days"));
        return date_format($date,"Y-m-d");
    }
}
