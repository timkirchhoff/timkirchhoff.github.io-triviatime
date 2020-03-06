<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class TriviaController extends Controller
{
    /**
     * Show daily trivia question
     *
     * @return void
     */
    public function index() 
    {
        $question = Question::getQuestion();
        $answers = Question::getAnswers($question);
        return view('home')
            ->with('question', $question)
            ->with('answers', $answers)
            ->with('score', session('score', 0))
            ->with('highScore', session('highScore', 0));
    }

    /**
     * Check the submitted answer
     *
     * @param Request $request
     * 
     * @return void
     */
    public function checkAnswer(Request $request)
    {   
        if ($request->answer === $request->correctAnswer) {
            addPoint();
            session()->flash('success', 'Correct! Keep the streak alive!');
            return redirect()->back();
        } else {
            if (checkHighScore()) {
                session()->flash('alert', 'Wrong answer, but.. NEW HIGH SCORE!!');
            } else {
                session()->flash('alert', 'Whoops, thats the wrong answer... Better luck next time!');
            }
            resetScore();
            return redirect()->back();
        }
    }
}
