<?php

namespace App\Observers;

use App\Models\Donor;

class DonorObserver
{
    /**
     * Handle the Donor "created" event.
     *
     * @param  \App\Models\Donor  $donor
     * @return void
     */
    public function created(Donor $donor)
    {
        // dd($donor);
    }

    /**
     * Handle the Donor "updated" event.
     *
     * @param  \App\Models\Donor  $donor
     * @return void
     */
    public function updated(Donor $donor)
    {
        //
    }

    /**
     * Handle the Donor "deleted" event.
     *
     * @param  \App\Models\Donor  $donor
     * @return void
     */
    public function deleted(Donor $donor)
    {
        //
    }

    /**
     * Handle the Donor "restored" event.
     *
     * @param  \App\Models\Donor  $donor
     * @return void
     */
    public function restored(Donor $donor)
    {
        //
    }

    /**
     * Handle the Donor "force deleted" event.
     *
     * @param  \App\Models\Donor  $donor
     * @return void
     */
    public function forceDeleted(Donor $donor)
    {
        //
    }
}
