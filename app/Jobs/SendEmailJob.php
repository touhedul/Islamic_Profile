<?php

namespace App\Jobs;

use App\Mail\CheckEmail;
use App\Notifications\EmailVarification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->handle();
        // Mail::to('astro@gmail.com')->send(new CheckEmail());
        //$this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //dd("sldf");
        Mail::to('astro@gmail.com')->send(new CheckEmail());
        //$this->user->notify(new EmailVarification($this->user))->delay(now()->addSecond(5));;
    }
}
