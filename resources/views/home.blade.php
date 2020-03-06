<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trivia Time!</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        <main class="container">       
            <h1>Trivia Time!</h1>
            <div class="box">
                @include('partials.flash')
                <h2 id="questionCategory">{{ $question->category }}</h2>
                <p id="question">{{ cleanSpecialCharacters($question->question) }}</p>
                <form method="POST" action="{{ route('checkAnswer') }}">
                    @csrf
                    <input type="hidden" name="correctAnswer" value="{{ $question->correct_answer }}">
                    @if ($question->type === 'boolean')
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer" id="true" value="True">
                            <label class="form-check-label" for="true">True</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer" id="false" value="False">
                            <label class="form-check-label" for="false">False</label>
                        </div>
                    @else
                        @foreach ($answers as $answer)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" id="{{ $answer }}" value="{{ $answer }}">
                                <label class="form-check-label" for="{{ $answer }}">{{ cleanSpecialCharacters($answer) }}</label>
                            </div>
                        @endforeach
                    @endif
                    <button class="btn btn-sm btn-info" type="submit">Submit Answer</button>
                </form>
                <div id="score">
                    <h2>Current Streak: {{ $score }}</h2>
                    <h2>High Score: {{ $highScore }}</h2>
                </div>
            </div>
        </main>
    </body>
</html>
