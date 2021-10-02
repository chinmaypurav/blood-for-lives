<?php

namespace App\Listeners\Bank;

use App\Events\Bank\BloodProcessed;
use App\Events\Bank\BloodRejected;
use App\Models\Inventory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BloodProcessListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handleBloodProcessed(BloodProcessed $event)
    {
        $inventory = new Inventory();
        $inventory->bank_id = $event->donation->bank_id;
        $inventory->blood_group = $event->donation->donor()->value('blood_group');
        $inventory->blood_component = $event->donation->blood_component;
        $inventory->save();
    }

    public function handleBloodRejected(BloodRejected $event)
    {
        # code...
    }

    public function subscribe($events)
    {
        return [
            BloodProcessed::class => 'handleBloodProcessed',
            BloodRejected::class => 'handleBloodRejected',
        ];
    }
}
