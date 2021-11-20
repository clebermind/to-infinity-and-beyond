<?php

namespace App\Tests\Service;

use App\Service\RepeatingLetter;
use PHPUnit\Framework\TestCase;

class RepeatingLetterTest extends TestCase
{
    public function testPositiveRepeatingLetter(): void
    {
        $repeatingLetter = new RepeatingLetter();

        $wordList = ['documentarily','aftershock','countryside','six-year-old', 'lets_go-!!!'];
        foreach ($wordList as $word) {
            $this->assertTrue($repeatingLetter->isThereAnyRepeatingLetter($word));
        }
    }

    public function testNegativeRepeatingLetter(): void
    {
        $repeatingLetter = new RepeatingLetter();

        $wordList = ['Double-down','Euclidean','epidemic', 'just a_test-here!!!'];
        foreach ($wordList as $word) {
            $this->assertFalse($repeatingLetter->isThereAnyRepeatingLetter($word));
        }
    }

    public function testEmptyRepeatingLetter(): void
    {
        $this->assertTrue((new RepeatingLetter())->isThereAnyRepeatingLetter(''));
    }
}