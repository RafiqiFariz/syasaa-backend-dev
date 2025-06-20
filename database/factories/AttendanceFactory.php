<?php

namespace Database\Factories;

use App\Models\CourseClass;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => User::where('role_id', 4)->inRandomOrder()->first()->student->id,
            'course_class_id' => CourseClass::inRandomOrder()->first()->id,
            'student_image' => 'img/dhita.png',
            'lecturer_image' => 'https://xsgames.co/randomusers/avatar.php?g=female',
            'is_present' => $this->faker->numberBetween(0, 1),
            'created_at' => $this->faker->dateTimeBetween('-1 days'),
        ];
    }
}
