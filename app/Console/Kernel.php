<?php

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
        'App\Console\Commands\Alarm',
        'App\Console\Commands\Daily',
        'App\Console\Commands\Monthly'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        /*$schedule->command('command:Alarm')
            ->twiceDaily(2, 15);
        $schedule->command('command:Daily')
            ->twiceDaily(1, 16);
        $schedule->command('command:Monthly')
            ->twiceDaily(2, 15);
        /*$schedule->command('command:Alarm')
                  ->everyMinute();
        $schedule->command('command:Daily')
                  ->everyMinute();
        $schedule->command('command:Monthly')
                  ->everyMinute();*/

        $schedule->command('command:Alarm')
                 ->cron('1 2,14 * * *');
        $schedule->command('command:Daily')
                 ->cron('30 1,13 * * *');
        $schedule->command('command:Monthly')
                 ->cron('0 1 1 * *');

            /*$schedule->command('command:Alarm')
                 ->dailyAt(16:25);
            $schedule->command('command:Daily')
                 ->dailyAt(16:23);
            $schedule->command('command:Monthly')
                 ->cron('0 1 1 * *');)*/
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
