<?php

namespace Muzich\Code;

use function cli\line;
use function cli\prompt;

function name(): string
{
    line('Welcome to the Brain Games');
    $name = prompt('May I have your name?');
    line('Hello, %s!', $name);
    return $name;
}

function even($name)
{
    $count_correct = 3;
    $tries = 0;

    line('Answer "yes" if the number is even, otherwise answer "no".');

    for ($i = 1; $i <= $count_correct; $i++) {
        $random = rand(1, 20);
        line('Question: %s', $random);
        $answer = prompt('Your answer');

        if ($random % 2 === 0 && $answer == "yes") {
            line('Correct!');
            $tries++;
        } elseif ($random % 2 !== 0 && $answer == "no") {
            line('Correct!');
            $tries++;
        } else {
            break;
        }
    }

    if ($tries == $count_correct) {
        $line = "Congratulations, {$name}!";
    } else {
        $line = "'yes' is wrong answer ;(. Correct answer was 'no'." . PHP_EOL;
        $line .= "Let's try again, {$name}!";
    }

    line($line);
}