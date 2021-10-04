<?php

namespace App\Utils;

class StateUtility
{
    private $states = [
        'MH' => 'Maharashtra',
        'GJ' => 'Gujarat',
    ];

    public function getStates(): array
    {
        return $this->states;
    }
}
