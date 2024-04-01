<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Lecturer;
use App\Models\Major;
use App\Models\MajorClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lecturerIds = Lecturer::all()->pluck('id')->toArray();
        $courses = Course::all();

        MajorClass::where('major_id', Major::firstWhere('name', 'Informatics')->id)
            ->each(function ($majorClass) use ($courses, $lecturerIds) {
                $classDuration = fake()->numberBetween(1, 4) * 50;

                [$startTime, $endTime] = $this->generateClassTimes('07:00:00', $classDuration);

                foreach ($courses as $course) {
                    CourseClass::create([
                        'course_id' => $course->id,
                        'class_id' => $majorClass->id,
                        'lecturer_id' => fake()->randomElement($lecturerIds),
                        'day' => fake()->randomElement(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']),
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                    ]);
                }
            });
    }

    // Fungsi untuk menghasilkan waktu mulai dan waktu selesai dengan aturan 1 SKS = 50 menit
    private function generateClassTimes($startTimeRange, $classDuration): array
    {
        $startTime = fake()->time($startTimeRange);
        $endTime = date('H:i:s', strtotime($startTime) + ($classDuration * 60));

        return [$startTime, $endTime];
    }
}
