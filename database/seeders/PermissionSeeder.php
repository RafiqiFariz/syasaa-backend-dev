<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // User Management
            ['name' => 'user_access'],
            ['name' => 'user_create'],
            ['name' => 'user_update'],
            ['name' => 'user_delete'],
            ['name' => 'user_restore'],
            ['name' => 'user_edit'],
            ['name' => 'user_show'],

            // Faculty Management
            ['name' => 'faculty_access'],
            ['name' => 'faculty_create'],
            ['name' => 'faculty_update'],
            ['name' => 'faculty_delete'],
            ['name' => 'faculty_edit'],

            // Major Management
            ['name' => 'major_access'],
            ['name' => 'major_create'],
            ['name' => 'major_update'],
            ['name' => 'major_delete'],
            ['name' => 'major_edit'],

            // Classes Management
            ['name' => 'class_access'],
            ['name' => 'class_create'],
            ['name' => 'class_update'],
            ['name' => 'class_delete'],
            ['name' => 'class_edit'],

            // Course Management
            ['name' => 'course_access'],
            ['name' => 'course_create'],
            ['name' => 'course_update'],
            ['name' => 'course_delete'],
            ['name' => 'course_edit'],
            ['name' => 'course_show'],

            // Attendance Management
            ['name' => 'attendance_access'],
            ['name' => 'attendance_create'],
            ['name' => 'attendance_update'],
            ['name' => 'attendance_delete'],
            ['name' => 'attendance_edit'],

            // Role Management
            ['name' => 'role_access'],
            ['name' => 'role_create'],
            ['name' => 'role_update'],
            ['name' => 'role_delete'],
            ['name' => 'role_edit'],

            // Permission Management
            ['name' => 'permission_access'],
            ['name' => 'permission_create'],
            ['name' => 'permission_update'],
            ['name' => 'permission_delete'],
            ['name' => 'permission_edit'],

            // Permission Role Management
            ['name' => 'permission_role_access'],
            ['name' => 'permission_role_create'],
            ['name' => 'permission_role_update'],
            ['name' => 'permission_role_delete'],
            ['name' => 'permission_role_edit'],

            // Report Management
            ['name' => 'report_create'],
        ];

        Permission::insert($permissions);
    }
}
