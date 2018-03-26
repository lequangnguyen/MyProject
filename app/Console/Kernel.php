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
        // Commands\Inspire::class,
        Commands\WriteActionLogsToCSV::class,
        Commands\ScanReport::class,
        Commands\ReportHCM::class,
        Commands\UserFollow::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('scan-report')
                 ->everyMinute()->withoutOverlapping();
        // $schedule->command('write-action-logs:csv 2')
        //          ->everyFiveMinutes()->withoutOverlapping();
    }
}
