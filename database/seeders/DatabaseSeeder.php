<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            PermissionRoleSeeder::class,
            FacultySeeder::class,
            CourseSeeder::class,
            MajorSeeder::class,
            ClassSeeder::class,
            UserSeeder::class,
            CourseClassSeeder::class,
            AttendanceSeeder::class,
        ]);
    }
}
