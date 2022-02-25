<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(file_get_contents(database_path('/files/test_variants.sql')));
        DB::unprepared(file_get_contents(database_path('/files/test_questions.sql')));
        DB::unprepared(file_get_contents(database_path('/files/test_answers.sql')));
        DB::unprepared(file_get_contents(database_path('/files/test_results.sql')));
        DB::unprepared(file_get_contents(database_path('/files/test_answer_result.sql')));


//        TestVariant::factory(5)
//            ->create()
//            ->each(function ($variant) {
//                TestQuestion::factory(3)
//                    ->create(['variant_id' => $variant->id])
//                    ->each(function ($question) {
//                        TestAnswers::factory(2)
//                            ->create(['question_id' => $question->id]);
//                    });
//                TestResult::factory(8)
//                    ->create();
//            });
//
//        TestResult::all()
//            ->each(
//                fn($result) =>
//                    $result->answers()->attach([rand(1, 30), rand(1, 30), rand(1, 30)])
//            );
    }
}
