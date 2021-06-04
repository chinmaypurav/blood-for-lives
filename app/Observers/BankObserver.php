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
        // $bank->inventories()->createMany([
        //     ['blood_group' => 'A+', 'blood_component' => 'whole'],
        //     ['blood_group' => 'A-', 'blood_component' => 'whole'],
        //     ['blood_group' => 'B+', 'blood_component' => 'whole'],
        // ]);
        // Inventory::create([]);
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