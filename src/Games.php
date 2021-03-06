<?php

namespace Muzich\Code;

use function cli\line;
use function cli\prompt;

class Games
{
    const MAX_COUNT_TRY = 3;

    public $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return void
     */
    public function even()
    {
        $tries = 0;

        line('Answer "yes" if the number is even, otherwise answer "no".');

        for ($i = 1; $i <= self::MAX_COUNT_TRY; $i++) {
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

        $this->result($tries);
    }

    /**
     * @return void
     */
    public function calc()
    {
        $tries = 0;

        $actions = ['+', '-', '*'];

        line('What is the result of the expression?');

        for ($i = 1; $i <= self::MAX_COUNT_TRY; $i++) {
            $randomAction = rand(0, 2);
            $randomX = rand(1, 20);
            $randomY = rand(1, 20);

            echo("Question: {$randomX} {$actions[$randomAction]} {$randomY}" . PHP_EOL);

            $result = $this->operations($actions[$randomAction], $randomX, $randomY);

            $answer = prompt('Your answer');

            if ($result == $answer) {
                line('Correct!');
                $tries++;
            } else {
                break;
            }
        }

        $this->result($tries, $result, $answer);
    }

    public function gcd()
    {
        $tries = 0;

        line('Find the greatest common divisor of given numbers.');

        for ($i = 1; $i <= self::MAX_COUNT_TRY; $i++) {

            $randomX = rand(1, 100);
            $randomY = rand(1, 100);

            echo("Question: {$randomX} {$randomY}" . PHP_EOL);

            $gcd = function ($n, $m) use (&$gcd) {
                return $m ? $gcd($m, $n % $m) : $n;
            };

            $result = $gcd($randomX, $randomY);

            $answer = prompt('Your answer');

            if ($result == $answer) {
                line('Correct!');
                $tries++;
            } else {
                break;
            }
        }

        $this->result($tries, $result, $answer);
    }

    protected function result(int $tries, $correct = null, $wrong = null)
    {
        $correct = $correct ?? 'no';
        $wrong = $wrong ?? "yes";

        if ($tries == self::MAX_COUNT_TRY) {
            $line = "Congratulations, {$this->name}!";
        } else {
            $line = "{$wrong} is wrong answer ;(. Correct answer was {$correct}." . PHP_EOL;
            $line .= "Let's try again, {$this->name}!";
        }

        line($line);
    }

    protected function operations($action, $x, $y): int
    {
        switch ($action) {
            case '+':
                return $x + $y;
            case '-':
                return $x - $y;
            case '*':
                return $x * $y;
        }
        return 0;
    }
}