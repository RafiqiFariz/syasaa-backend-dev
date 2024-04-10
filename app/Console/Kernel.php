<?php

namespace App\Console;

use App\Models\Attendance;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Storage;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $oldAttendances = Attendance::where('created_at', '<', now()->subDay())->get();

            foreach ($oldAttendances as $attendance) {
                $attendance->update(['student_image' => null, 'lecturer_image' => null]);
                $imagePath = 'attendances/student-' . $attendance->student_id;
                Storage::delete([
                    $imagePath . '/' . $attendance->student_image,
                    $imagePath . '/' . $attendance->lecturer_image
                ]);
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
