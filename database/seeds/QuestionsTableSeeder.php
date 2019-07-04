<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Question::create([
            'question'      => '1 + 1',
            'answerOne'     => '1',
            'answerTwo'     => '2',
            'answerThree'   => '3',
            'answerFour'    => '4',
            'trueAnswer'    => '2',
        ]);
        App\Question::create([
            'question'      => '1 + 1',
            'answerOne'     => '1',
            'answerTwo'     => '2',
            'answerThree'   => '3',
            'answerFour'    => '4',
            'trueAnswer'    => '2',
        ]);
    }
}
