<?php

namespace App\Transformers;

use App\Question;
use League\Fractal\TransformerAbstract;
use App\Transformers\UserTransformer;

class QuestionTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['users', 'usersActive', 'usersWait'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Question $question)
    {
        return [
            'id' => $question->id,
            'question' => $question->question,
            'answerOne' => $question->answerOne,
            'answerTwo' => $question->answerTwo,
            'answerThree' => $question->answerThree,
            'answerFour' => $question->answerFour,
            'trueAnswer' => $question->trueAnswer
        ];
    }
}
