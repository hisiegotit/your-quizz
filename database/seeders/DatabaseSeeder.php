<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Answer;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Question;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123123123'),
            'visible_password' => '123123123',
            'occupation' => 'Developer',
            'address' => 'Dhaka, Bangladesh',
            'phone' => '01700000000',
            'email_verified_at' => NOW(),
            'is_admin' => 1,
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('123123123'),
            'visible_password' => '123123123',
            'occupation' => 'Student',
            'address' => 'Seoul, South Korea',
            'phone' => '01700000001',
            'email_verified_at' => NOW(),
            'is_admin' => 0,
        ]);

        // Create Quiz
        Quiz::create([
            'name' => 'Laravel-1',
            'description' => 'This is a Laravel quiz',
            'minutes' => 10,
            'created_at' => NOW(),
        ]);

        Quiz::create([
            'name' => 'Laravel-2',
            'description' => 'This is a Laravel quiz',
            'minutes' => 5,
            'created_at' => NOW(),
        ]);

        // Add question to Laravel-1
        Question::create([
            'question' => 'What is Laravel?',
            'quiz_id' => 1,
        ]);

        // Add answer to question 'What is Laravel?'
        Answer::create([
            'answer' => 'PHP Framework',
            'question_id' => 1,
            'is_correct' => 1,
        ]);

        Answer::create([
            'answer' => 'Python Framework',
            'question_id' => 1,
            'is_correct' => 0,
        ]);

        Answer::create([
            'answer' => 'Java Framework',
            'question_id' => 1,
            'is_correct' => 0,
        ]);

        Answer::create([
            'answer' => 'C++ Framework',
            'question_id' => 1,
            'is_correct' => 0,
        ]);

        // Add question to Laravel-1
        Question::create([
            'question' => 'What is Laravel?',
            'quiz_id' => 2,
        ]);

        // Add answer to question 'What is Laravel?'
        Answer::create([
            'answer' => 'PHP Framework',
            'question_id' => 2,
            'is_correct' => 1,
        ]);

        Answer::create([
            'answer' => 'Python Framework',
            'question_id' => 2,
            'is_correct' => 0,
        ]);

        Answer::create([
            'answer' => 'Java Framework',
            'question_id' => 2,
            'is_correct' => 0,
        ]);

        Answer::create([
            'answer' => 'C++ Framework',
            'question_id' => 2,
            'is_correct' => 0,
        ]);
    }
}
