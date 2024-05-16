<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\FacultyStaff;
use App\Models\MajorClass;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'phone' => fake()->phoneNumber,
                    'image' => 'img/yoo_seung_ho.jpg',
                    'email_verified_at' => now(),
                    'password' => bcrypt('admin123'),
                    'remember_token' => Str::random(10),
                    'role_id' => Role::find(1)->id,
                    'created_at' => now(),
                ],
                [
                    'name' => 'Staf Fakultas 1',
                    'email' => 'staffakultas1@gmail.com',
                    'phone' => fake()->phoneNumber,
                    'image' => null,
                    'email_verified_at' => now(),
                    'password' => bcrypt('12345678'),
                    'remember_token' => Str::random(10),
                    'role_id' => Role::find(2)->id,
                    'created_at' => now(),
                ],
                [
                    'name' => 'Staf Fakultas 2',
                    'email' => 'staffakultas2@gmail.com',
                    'phone' => fake()->phoneNumber,
                    'image' => null,
                    'email_verified_at' => now(),
                    'password' => bcrypt('12345678'),
                    'remember_token' => Str::random(10),
                    'role_id' => Role::find(2)->id,
                    'created_at' => now(),
                ],
                [
                    'name' => 'Dosen 1',
                    'email' => 'dosen1@gmail.com',
                    'phone' => fake()->phoneNumber,
                    'image' => 'img/ashley_graham_re4.jpg',
                    'email_verified_at' => now(),
                    'password' => bcrypt('12345678'),
                    'remember_token' => Str::random(10),
                    'role_id' => Role::find(3)->id,
                    'created_at' => now(),
                ],
                [
                    'name' => 'Dosen 2',
                    'email' => 'dosen2@gmail.com',
                    'phone' => fake()->phoneNumber,
                    'image' => 'img/chloe_dbh.jpg',
                    'email_verified_at' => now(),
                    'password' => bcrypt('12345678'),
                    'remember_token' => Str::random(10),
                    'role_id' => Role::find(3)->id,
                    'created_at' => now(),
                ],
                [
                    'name' => 'Go Youn Jung',
                    'email' => 'student1@gmail.com',
                    'phone' => fake()->phoneNumber,
                    'image' => 'img/goyounjung.jpg',
                    'email_verified_at' => now(),
                    'password' => bcrypt('12345678'),
                    'remember_token' => Str::random(10),
                    'role_id' => Role::find(4)->id,
                    'created_at' => now(),
                ]
            ]
        );

        User::factory(4)->create();

        // Untuk memastikan bahwa yg user idnya 2 dan 3 itu memiliki faculty id yang diinginkan
        FacultyStaff::create(["user_id" => 2, "faculty_id" => 1]);
        FacultyStaff::create(["user_id" => 3, "faculty_id" => 3]);

        $facultyIds = Faculty::all()->pluck('id')->toArray();
        $classIds = MajorClass::all()->pluck('id')->toArray();

        User::all()->each(function ($user) use ($classIds, $facultyIds) {
            if ($user->role_id === 2 && $user->id > 3) {
                $user->facultyStaff()->create(["faculty_id" => $facultyIds[array_rand($facultyIds)]]);
            } else if ($user->role_id === 3) {
                $user->lecturer()->create(["address" => fake()->address]);
            } else if ($user->role_id === 4) {
                $classId = $user->id === 6 ? 53 : $classIds[array_rand($classIds)];
                $user->student()->create(["class_id" => $classId]);
            }
        });
    }
}
