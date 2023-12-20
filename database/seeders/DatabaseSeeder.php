<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            [
                'name' => 'Бедрин Семен Олегович',
                'email' => 'bedrin@example.com',
                'login' => 'bedrin',
                'roleName' => 'STUDENT',
                'created_at' => now(),
                'image' => 'photos/a3.jpg',
                'password' => '$2y$12$imkz9a2rkqzfHIfnFeJjnes.aHKvYV1GOUoY4Z/XPHNAXguXFCOVO' //user
            ],
            [
                'name' => 'Иванов Иван Иванович',
                'email' => 'admin@example.com',
                'login' => 'admin',
                'roleName' => 'ADMIN',
                'created_at' => now(),
                'image' => 'photos/a1.jpg',
                'password' => '$2y$12$af/zIyHR.jLYcHbfuFpzf.58KywB7kadDrcVDJoCrsYTv/hgt39fC' //admin
            ]
        ]);

        DB::table('language_groups')->insert([
            [
                'name' => 'Английский'
            ],
            [
                'name' => 'Французский'
            ],
            [
                'name' => 'Немецкий'
            ],
            [
                'name' => 'Китайский'
            ]
        ]);


        DB::table('courses')->insert([
            [
                'title' => 'Интенсивный курс английского языка',
                'description' => 'Цель: комплексное развитие и совершенствование таких видов речевой деятельности, как говорение и аудирование, развитие языковой и коммуникативной компетенции, преодоление языкового барьера и совершенствование навыков общения на английском языке, в том числе с носителем языка.',
                'limit' => 15,
                'startAt' => date('2023-10-02 15:30:00.000'),
                'created_at' => now(),
                'image' => 'photos/images (1).jpg',
                'languageGroupId' => 1
            ],
            [
                'title' => 'Китайский язык для начинающих',
                'description' => 'Цель: формирование произношения, изучение разговорных, обиходных выражений, овладение основными принципами построения различных моделей предложений, знакомство с основами китайской культуры.',
                'limit' => 10,
                'startAt' => date('2023-12-25 18:00:00.000'),
                'created_at' => now(),
                'image' => 'photos/images (2).jpg',
                'languageGroupId' => 4
            ],
            [
                'title' => 'English for Special Purposes',
                'description' => 'Цель: развитие всех видов речевой деятельности (чтение, говорение, аудирование, письмо, основы устного и письменного перевода), формирование деловой и коммуникативной компетенции на темах, связанных с современным бизнесом.',
                'limit' => 12,
                'startAt' => date('2024-01-15 12:00:00.000'),
                'created_at' => now(),
                'image' => 'photos/images (3).jpg',
                'languageGroupId' => 1
            ]
        ]);

        DB::table('courses_members')->insert([
            [
                'courseId' => 1,
                'userId' => 1
            ],
            [
                'courseId' => 2,
                'userId' => 1
            ],
            [
                'courseId' => 3,
                'userId' => 2
            ]
        ]);
    }
}