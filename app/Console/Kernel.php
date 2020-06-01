<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\BirthdayNotificationCommand;
use App\Console\Commands\NonAttendanceNotificationCommand;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        BirthdayNotificationCommand::class,
        NonAttendanceNotificationCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {        
        // Laravel Telescope Data Pruning
        $schedule->command('telescope:prune')->daily();

        // Notifications
        $schedule->command('notification:birthday --force')->dailyAt('24:00');
        $schedule->command('notification:nonAttendance --force')->dailyAt('24:00');
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
