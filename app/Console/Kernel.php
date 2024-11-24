<?php
/**
 * Theqqa - Classified Ads Web Application
 * Copyright (c) BedigitCom. All Rights Reserved
 *
 * Website: http://www.
 *
 * Theqqa
 */

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\AdsCleaner::class,
        \App\Console\Commands\AdsPaidCleaner::class,
    //    \App\Console\Commands\CentralCalls::class,


    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
         $schedule->command('ads:clean')->everyFiveMinutes();
         $schedule->command('adsPaid:clean')->everyFiveMinutes();
     //   $schedule->command('central:get')->everyFiveMinutes();




        // BackupManager
        // $schedule->command('backup:clean')->daily()->at('04:00');
        // $schedule->command('backup:run')->daily()->at('05:00');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
