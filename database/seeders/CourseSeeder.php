<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            // Semester 1
            [
//                'code' => 'CIT101',
                'name' => 'Emotional Intelligence for Information Technology Practitioners',
//                'credit' => 3,
            ],
            [
//                'code' => 'CIT102',
                'name' => 'Integrative Survival Experience for Information Technology Practitioners 1',
//                'credit' => 6,
            ],
            [
//                'code' => 'CIT103',
                'name' => 'Statistics, Problem Solving, and Decision Making for Information Technology Practitioners',
//                'credit' => 3,
            ],
            [
//                'code' => 'CIT104',
                'name' => 'Digital Literacy and Communication for Information Technology Practitioners',
//                'credit' => 3,
            ],
            [
//                'code' => 'CIT105',
                'name' => 'Computing Career and Programming',
//                'credit' => 3,
            ],
            [
//                'code' => 'CIT106',
                'name' => 'Web Programming',
//                'credit' => 3,
            ],

            // Semester 2
            [
//                'code' => 'CIT107',
                'name' => 'Integrative Survival Experience for Information Technology Practitioners 2',
//                'credit' => 6,
            ],
            [
//                'code' => 'CIT108',
                'name' => 'Psychology and Design Thinking for Information Technology Practitioners',
//                'credit' => 3,
            ],
            [
//                'code' => 'CIT109',
                'name' => 'Coding and Big Data for Information Technology Practitioners',
//                'credit' => 3,
            ],
            [
//                'code' => 'FOC101',
                'name' => 'Database System',
//                'credit' => 3,
            ],
            [
//                'code' => 'FOC102',
                'name' => 'Object Oriented and Visual Progamming',
//                'credit' => 3,
            ],

            // Semester 3
            [
//                'code' => 'INA101',
                'name' => 'Statespersonship: Pancasila, Citizenship, Religion, and Indonesian Language',
//                'credit' => 9,
            ],

            // Semester 4
            [
//                'code' => 'FOC103',
                'name' => 'Computer Network',
//                'credit' => 3,
            ],
            [
//                'code' => 'CIT210',
                'name' => '3D Computer Graphics and Animation',
//                'credit' => 3,
            ],
            [
//                'code' => 'FOC104',
                'name' => 'Server-side Internet Programming',
//                'credit' => 3,
            ],
            [
//                'code' => 'CIT211',
                'name' => 'Wireless and Mobile Programming',
//                'credit' => 3,
            ],
            [
//                'code' => 'CIT212',
                'name' => 'Data Structures and Algorithms',
//                'credit' => 3,
            ],
            [
//                'code' => 'CIT213',
                'name' => 'Image Processing and Understanding',
//                'credit' => 3,
            ],

            // Semester 5
            [
//                'code' => 'CIT214',
                'name' => 'Network Security',
//                'credit' => 3,
            ],
            [
//                'code' => 'CIT215',
                'name' => 'Internet of Things',
//                'credit' => 3,
            ],
            [
//                'code' => 'CIT216',
                'name' => 'Virtual Reality and Game Development',
//                'credit' => 3,
            ],
            [
//                'code' => 'CIT217',
                'name' => 'Artificial Intelligence',
//                'credit' => 3,
            ],
            [
//                'code' => 'CIT218',
                'name' => 'Operating System Design',
//                'credit' => 3,
            ],
            [
//                'code' => 'CIT219',
                'name' => 'Software Engineering',
//                'credit' => 3,
            ],
            [
//                'code' => 'CIT231',
                'name' => 'Elective | Outside Study Program / Study Program (Discrete Mathematics) / Non-English Languages',
//                'credit' => 3,
            ],

            // Semester 6
            [
//                'code' => 'CIT232',
                'name' => 'Elective | Outside Study Program / Study Program (Robotics) / Non-English Languages',
//                'credit' => 3,
            ],
            [
//                'code' => 'CIT233',
                'name' => 'Elective | Outside Study Program / Study Program (Intelligent System Application Development) / Non-English Languages',
//                'credit' => 3,
            ],
            [
//                'code' => 'CIT234',
                'name' => 'Elective | Outside Study Program / Study Program (Computer Organization and Architecture) / Non-English Languages',
//                'credit' => 2,
            ],
            [
//                'code' => 'ICC201',
                'name' => 'Pre-Internship',
//                'credit' => 1,
            ],

            // Semester 7
            [
//                'code' => 'ICC302',
                'name' => 'Internship 1 (All)',
//                'credit' => 15,
            ],
            [
//                'code' => 'CIT335',
                'name' => 'Elective | Outside Study Program / Study Program (Pre-Final Project / Application Development Project) / Non-English Languages',
//                'credit' => 3,
            ],

            // Semester 8
            [
//                'code' => 'ICC303',
                'name' => 'Internship 2 (All)',
//                'credit' => 15,
            ],
            [
//                'code' => 'BIZACC301',
                'name' => 'Mentorship 1 (Entrepreneur)',
//                'credit' => 15,
            ],
            [
//                'code' => '10-LRPM-PO301',
                'name' => 'Scholarship 1 Student Exchange Program / Teaching ar School/ Teaching Assistant / Research Assistant)',
//                'credit' => 15,
            ],
            [
//                'code' => '',
                'name' => 'Final Project (Study Program / Outside Study Program)',
//                'credit' => 6,
            ],

            // Semester 9
            [
//                'code' => 'ICC304',
                'name' => 'Internship 3 (Professional)',
//                'credit' => 9,
            ],
            [
//                'code' => 'BIZACC302',
                'name' => 'Mentorship 2 (Entrepreneur / Social and Humanity Project / Environmental and Climate Change Project / National Reserve Program)',
//                'credit' => 9,
            ],
            [
//                'code' => '10-LRPM-PO302',
                'name' => 'Scholarship 2 (Student Exchange Program / Summer Program/ Teaching at School / Teaching Assistant / Research Assistant)',
//                'credit' => 9,
            ],
        ];

        Course::insert($courses);
    }
}
