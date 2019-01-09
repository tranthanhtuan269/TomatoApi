<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'answerOne', 'answerTwo', 'answerThree', 'answerFour', 'trueAnswer'
    ];
}
