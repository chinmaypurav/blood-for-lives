<?php

namespace App\Services;

class SeederService
{
    public function bloodGroup()
    {
        return array_rand([
            ''
        ])
    }
}