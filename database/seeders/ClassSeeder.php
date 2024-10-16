<?php

namespace Database\Seeders;

use App\Models\MajorClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MajorClass::insert([
            // Faculty of Business
            [
                'name' => 'ACC 1',
                'major_id' => 1,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'ACC 2',
                'major_id' => 1,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'ACC 3',
                'major_id' => 1,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'ACC 4',
                'major_id' => 1,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'ACC 5',
                'major_id' => 1,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'BA 1',
                'major_id' => 2,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'BA 2',
                'major_id' => 2,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'BA 3',
                'major_id' => 2,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'BA 4',
                'major_id' => 2,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'BA 5',
                'major_id' => 2,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'MGT 1',
                'major_id' => 3,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'MGT 2',
                'major_id' => 3,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'MGT 3',
                'major_id' => 3,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'MGT 4',
                'major_id' => 3,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'MGT 5',
                'major_id' => 3,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'ACS 1',
                'major_id' => 4,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'ACS 2',
                'major_id' => 4,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'ACS 3',
                'major_id' => 4,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'ACS 4',
                'major_id' => 4,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'ACS 5',
                'major_id' => 4,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            // Faculty of Engineering
            [
                'name' => 'CEN 1',
                'major_id' => 6,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'CEN 2',
                'major_id' => 6,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'CEN 3',
                'major_id' => 6,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'CEN 4',
                'major_id' => 6,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'CEN 5',
                'major_id' => 6,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'EEN 1',
                'major_id' => 9,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'EEN 2',
                'major_id' => 9,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'EEN 3',
                'major_id' => 9,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'EEN 4',
                'major_id' => 9,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'EEN 5',
                'major_id' => 9,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'ENV 1',
                'major_id' => 10,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'ENV 2',
                'major_id' => 10,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'ENV 3',
                'major_id' => 10,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'ENV 4',
                'major_id' => 10,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'ENV 5',
                'major_id' => 6,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IEN 1',
                'major_id' => 7,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IEN 2',
                'major_id' => 7,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IEN 3',
                'major_id' => 7,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IEN 4',
                'major_id' => 7,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IEN 5',
                'major_id' => 7,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'MEN 1',
                'major_id' => 8,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'MEN 2',
                'major_id' => 8,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'MEN 3',
                'major_id' => 8,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'MEN 4',
                'major_id' => 8,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'MEN 5',
                'major_id' => 8,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            // Faculty of Computer Science
            [
                'name' => 'VCD 1',
                'major_id' => 12,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'VCD 2',
                'major_id' => 12,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'VCD 3',
                'major_id' => 12,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'VCD 4',
                'major_id' => 12,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'VCD 5',
                'major_id' => 12,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IS 1',
                'major_id' => 13,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IS 2',
                'major_id' => 13,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IS 3',
                'major_id' => 13,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IS 4',
                'major_id' => 13,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IS 5',
                'major_id' => 13,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IT 1',
                'major_id' => 13,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IT 2',
                'major_id' => 13,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IT 3',
                'major_id' => 13,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IT 4',
                'major_id' => 13,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IT 5',
                'major_id' => 13,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            // Faculty of Humanities
            [
                'name' => 'IR 1',
                'major_id' => 16,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IR 2',
                'major_id' => 16,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IR 3',
                'major_id' => 16,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IR 4',
                'major_id' => 16,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'IR 5',
                'major_id' => 16,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'COMM 1',
                'major_id' => 17,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'COMM 2',
                'major_id' => 17,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'COMM 3',
                'major_id' => 17,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'COMM 4',
                'major_id' => 17,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'COMM 5',
                'major_id' => 17,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'LAW 1',
                'major_id' => 18,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'LAW 2',
                'major_id' => 18,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'LAW 3',
                'major_id' => 18,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'LAW 4',
                'major_id' => 18,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'LAW 5',
                'major_id' => 18,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'PSTE 1',
                'major_id' => 19,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'PSTE 2',
                'major_id' => 19,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'PSTE 3',
                'major_id' => 19,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'PSTE 4',
                'major_id' => 19,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
            [
                'name' => 'PSTE 5',
                'major_id' => 19,
                'lat' => mt_rand(-90 * 1000000, 90 * 1000000) / 1000000,
                'lng' => mt_rand(-180 * 1000000, 180 * 1000000) / 1000000
            ],
        ]);
    }
}
