<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_types')->insert([
            [
                'name' => 'MCQ with Single Answer',
                'answer_type' => 1,
            ],
            [
                'name' => 'MCQ with Multiple Answer',
                'answer_type' => 2
            ]
        ]);
    }
}
