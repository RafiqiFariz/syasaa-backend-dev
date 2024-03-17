<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Major::insert([
            [
                'name' => 'Accounting',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Business Administration',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Management',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Actuarial Science',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Agribusiness',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Civil Engineering',
                'faculty_id' => 2,
            ],
            [
                'name' => 'Industrial Engineering',
                'faculty_id' => 2,
            ],
            [
                'name' => 'Mechanical Engineering',
                'faculty_id' => 2,
            ],
            [
                'name' => 'Electrical Engineering',
                'faculty_id' => 2,
            ],
            [
                'name' => 'Environmental Engineering',
                'faculty_id' => 2,
            ],
            [
                'name' => 'Architecture',
                'faculty_id' => 2,
            ],
            [
                'name' => 'Visual Communication Design',
                'faculty_id' => 3,
            ],
            [
                'name' => 'Informatics',
                'faculty_id' => 3,
            ],
            [
                'name' => 'Information System',
                'faculty_id' => 3,
            ],
            [
                'name' => 'Interior Design',
                'faculty_id' => 3,
            ],
            [
                'name' => 'International Relations',
                'faculty_id' => 4,
            ],
            [
                'name' => 'Communication',
                'faculty_id' => 4,
            ],
            [
                'name' => 'Law',
                'faculty_id' => 4,
            ],
            [
                'name' => 'Primary School Teacher Education (PSTE)',
                'faculty_id' => 4,
            ]
        ]);
    }
}
