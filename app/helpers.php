<?php

/**
 * Decode all special characters
 *
 * @param [type] $question
 * 
 * @return void
 */
function cleanSpecialCharacters($string)
{
    $cleanString = htmlspecialchars_decode($string, ENT_QUOTES);
    $cleanDecodedString = html_entity_decode($cleanString);
    return $cleanDecodedString;
}

/**
 * Increase score by 1 for a correct answer
 *
 * @return void
 */
function addPoint()
{
    $score = session('score');
    $score++;
    session(['score' => $score]);
}

/**
 * Set score to 0 for an incorrect answer
 *
 * @return void
 */
function resetScore()
{
    session(['score' => 0]);
}

/**
 * Check for new high score
 *
 * @return void
 */
function checkHighScore()
{
    if (session('score') > session('highScore')) {
        $newHighScore = session('score');
        session(['highScore' => $newHighScore]);
        return true;
    } else {
        session('highScore');
        return false;
    }
}
