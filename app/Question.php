<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * Get daily trivia question
     *
     * @return void
     */
    public static function getQuestion()
    {
        $url = 'https://opentdb.com/api.php?amount=1';
        $trivia = json_decode(file_get_contents($url));
        if ($trivia->response_code === 0) {
            $question = $trivia->results[0];
        };
        return $question;
    }

    /**
     * Returns possible answers for a question
     *
     * @param [type] $question
     * 
     * @return void
     */
    public static function getAnswers($question)
    {
        $answers = [];
        array_push($answers, $question->correct_answer);
        foreach ($question->incorrect_answers as $answer) {
            array_push($answers, $answer);
        }
        return $answers;
    }
}
