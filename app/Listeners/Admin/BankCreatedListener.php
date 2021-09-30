<?php

namespace App\Listeners\Admin;

use App\Events\Admin\BankCreated;
use App\Mail\BankRegistrationMail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BankCreatedListener
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

    /**
     * Handle the event.
     *
     * @param  BankCreated  $event
     * @return void
     */
    public function handle(BankCreated $event)
    {
        $url = URL::signedRoute('bank.register', ['bank' => $event->bank->bank_code]);
        Mail::to($event->bank->email)->queue(new BankRegistrationMail($event->bank, $url));
    }
}
