<?php

namespace App\Utils;

use Illuminate\Support\Carbon;

class BloodUtility
{
    private $components;

    private $groups;

    public function __construct()
    {
        $this->components = config('project.blood_components');
        $this->groups = config('project.blood_groups');
    }

    public function compatible(string $group, string $component): array
    {
        $whole = [
            'A+' => ['A+', 'AB+'],
            'A-' => ['A-', 'AB-'],
            'B+' => ['B+', 'AB+'],
            'B-' => ['B-', 'AB-'],
            'AB+' => ['AB+'],
            'AB-' => ['AB-'],
            'O+' => ['A+', 'B+', 'AB+', 'O+'],
            'O-' => ['O-'],
            'HH' => ['HH'],
        ];
        $platelets = [
            'A+' => ['A+', 'AB+'],
            'A-' => ['A-', 'AB-'],
            'B+' => ['B+', 'AB+'],
            'B-' => ['B-', 'AB-'],
            'AB+' => ['AB+'],
            'AB-' => ['AB-'],
            'O+' => ['A+', 'B+', 'AB+', 'O+'],
            'O-' => ['O-'],
            'HH' => ['HH'],
        ];
        $plasma = [
            'A+' => ['A+', 'AB+'],
            'A-' => ['A-', 'AB-'],
            'B+' => ['B+', 'AB+'],
            'B-' => ['B-', 'AB-'],
            'AB+' => ['AB+'],
            'AB-' => ['AB-'],
            'O+' => ['A+', 'B+', 'AB+', 'O+'],
            'O-' => ['O-'],
            'HH' => ['HH'],
        ];
        $rbc = [
            'A+' => ['A+', 'AB+'],
            'A-' => ['A-', 'AB-'],
            'B+' => ['B+', 'AB+'],
            'B-' => ['B-', 'AB-'],
            'AB+' => ['AB+'],
            'AB-' => ['AB-'],
            'O+' => ['A+', 'B+', 'AB+', 'O+'],
            'O-' => ['O-'],
            'HH' => ['HH'],
        ];
        $wbc = [
            'A+' => ['A+', 'AB+'],
            'A-' => ['A-', 'AB-'],
            'B+' => ['B+', 'AB+'],
            'B-' => ['B-', 'AB-'],
            'AB+' => ['AB+'],
            'AB-' => ['AB-'],
            'O+' => ['A+', 'B+', 'AB+', 'O+'],
            'O-' => ['O-'],
            'HH' => ['HH'],
        ];

        $compatibilities = [
            'whole' => array_combine($this->groups, $whole),
            'platelets' => array_combine($this->groups, $platelets),
            'plasma' => array_combine($this->groups, $plasma),
            'rbc' => array_combine($this->groups, $rbc),
            'wbc' => array_combine($this->groups, $wbc),
        ];

        return $compatibilities[$component][$group];
    }

    public function dueDate(string $group, string $component, Carbon $date): Carbon
    {
        $days = ['30', '20', '30', '5'];
        $wait = array_combine($this->components, $days);
        return $date->addDays($days);
    }
}
