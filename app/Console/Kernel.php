<?php

namespace App\Console;

use App\Models\Attendance;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
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
                $imagePath = 'attendances/student/' . $attendance->student_id;
                $originalStudentImage = $attendance->getRawOriginal('student_image');
                $studentImageName = basename($originalStudentImage);

                $originalLecturerImage = $attendance->getRawOriginal('lecturer_image');
                $lecturerImageName = basename($originalLecturerImage);

                Storage::disk('public')->delete([
                    $imagePath . '/' . $studentImageName,
                    $imagePath . '/' . $lecturerImageName
                ]);

                $attendance->update(['student_image' => null, 'lecturer_image' => null]);
            }
        })->daily()->sendOutputTo(storage_path("logs/laravel.log"));
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
