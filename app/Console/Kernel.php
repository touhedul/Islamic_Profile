<?php

namespace App\Console;

use App\Helpers\UserHelper;
use App\Models\User\Salat;
use App\Models\User\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Auth;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
//for every user make the salat not done automatically
            $users = User::all('id');
            foreach ($users as $user) {
                $userSalat = UserHelper::getUserById($user->id);
                if ($userSalat->fajr == "") {
                    $userSalat->fajr = "nd";
                }
                if ($userSalat->zuhr == "") {
                    $userSalat->zuhr = "nd";
                }
                if ($userSalat->asr == "") {
                    $userSalat->asr = "nd";
                }
                if ($userSalat->maghrib == "") {
                    $userSalat->maghrib = "nd";
                }
                if ($userSalat->isha == "") {
                    $userSalat->isha = "nd";
                }
                if ($userSalat->witr == "") {
                    $userSalat->witr = "nd";
                }
                 $userSalat->save();
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
