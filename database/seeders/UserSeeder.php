<?php

namespace Database\Seeders;

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
                    'email_verified_at' => now(),
                    'password' => bcrypt('admin123'),
                    'remember_token' => Str::random(10),
                    'role_id' => Role::find(1)->id,
                    'created_at' => now(),
                ],
                [
                    'name' => 'Staf Fakultas 1',
                    'email' => 'staffakultas1@gmail.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('12345678'),
                    'remember_token' => Str::random(10),
                    'role_id' => Role::find(2)->id,
                    'created_at' => now(),
                ],
                [
                    'name' => 'Staf Fakultas 2',
                    'email' => 'staffakultas2@gmail.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('12345678'),
                    'remember_token' => Str::random(10),
                    'role_id' => Role::find(2)->id,
                    'created_at' => now(),
                ],
                [
                    'name' => 'Dosen 1',
                    'email' => 'dosen1@gmail.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('12345678'),
                    'remember_token' => Str::random(10),
                    'role_id' => Role::find(3)->id,
                    'created_at' => now(),
                ],
                [
                    'name' => 'Dosen 2',
                    'email' => 'dosen2@gmail.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('12345678'),
                    'remember_token' => Str::random(10),
                    'role_id' => Role::find(3)->id,
                    'created_at' => now(),
                ],
                [
                    'name' => 'Dhita',
                    'email' => 'dhita@gmail.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('12345678'),
                    'remember_token' => Str::random(10),
                    'role_id' => Role::find(4)->id,
                    'created_at' => now(),
                ]
            ]
        );

        User::factory(4)->create();
    }
}
