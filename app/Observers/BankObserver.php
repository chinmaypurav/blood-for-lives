<?php

namespace App\Observers;

use App\Models\Bank;

class BankObserver
{
    /**
     * Handle the Bank "created" event.
     *
     * @param  \App\Models\Bank  $bank
     * @return void
     */
    public function created(Bank $bank)
    {
        $bloodComponent = ['whole', 'rbc', 'wbc', 'platelets', 'plasma']; //Count 5
        $bloodGroup = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-', 'HH']; //Count 9
        for ($c=0; $c < count($bloodComponent); $c++) { 
            for ($g=0; $g < count($bloodGroup); $g++) { 
                $data[] = [
                    'blood_component' => $bloodComponent[$c],
                    'blood_group' => $bloodGroup[$g],
                ];
            }
        }
        $bank->inventories()->createMany($data);
    }

    /**
     * Handle the Bank "updated" event.
     *
     * @param  \App\Models\Bank  $bank
     * @return void
     */
    public function updated(Bank $bank)
    {
        //
    }

    /**
     * Handle the Bank "deleted" event.
     *
     * @param  \App\Models\Bank  $bank
     * @return void
     */
    public function deleted(Bank $bank)
    {
        //
    }

    /**
     * Handle the Bank "restored" event.
     *
     * @param  \App\Models\Bank  $bank
     * @return void
     */
    public function restored(Bank $bank)
    {
        //
    }

    /**
     * Handle the Bank "force deleted" event.
     *
     * @param  \App\Models\Bank  $bank
     * @return void
     */
    public function forceDeleted(Bank $bank)
    {
        //
    }
}
