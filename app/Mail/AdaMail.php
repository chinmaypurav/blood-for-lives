<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $groups;
    public $component;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($groups, $component)
    {
        $this->groups = $groups;
        $this->component = $component;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.ada')
                    ->subject('Blood Donor Required');
    }
}
