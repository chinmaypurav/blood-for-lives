<?php

namespace App\Providers;

use App\Events\Admin\BankCreated;
use App\Listeners\Admin\BankCreatedListener;
use App\Listeners\Bank\BloodProcessListener;
use App\Models\Bank;
use App\Models\Donor;
use App\Observers\BankObserver;
use App\Observers\DonorObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        BankCreated::class => [
            BankCreatedListener::class,
        ]
    ];

    protected $subscribe = [
        BloodProcessListener::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
