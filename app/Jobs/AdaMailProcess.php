<?php

namespace App\Jobs;

use App\Mail\AdaMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class AdaMailProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $donors;
    private $groups;
    private $component;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($donors, $groups, $component)
    {
        $this->donors = $donors;
        $this->groups = $groups;
        $this->component = $component;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->donors as $donor) {
            $recipients[] = $donor->user->email;
        }
        Mail::to($recipients)->send(new AdaMail($this->groups, $this->component));

    }
}
