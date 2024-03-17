<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faculty::insert([
            [
                'name' => 'Faculty of Business',
            ],
            [
                'name' => 'Faculty of Engineering',
            ],
            [
                'name' => 'Faculty of Computer Science',
            ],
            [
                'name' => 'Faculty of Humanities',
            ],
        ]);
    }
}
