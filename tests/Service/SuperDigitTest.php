<?php

namespace App\Tests\Service;

use App\Service\SuperDigit;
use PHPUnit\Framework\TestCase;

class SuperDigitTest extends TestCase
{
    public function testNoInteraction(): void
    {
        $superDigit = new SuperDigit();

        $numbers = [1=>1, 2=>2, 45=>9, 21=>3, 100=>1];
        foreach ($numbers as $number => $result) {
            $actual = $superDigit->sum($number);
            $this->assertEquals(
                $result,
                $actual,
                "'{$number}' given. Expected '{$result}' but got '{$actual}'"
            );
        }
    }

    public function testOneInteraction(): void
    {
        $superDigit = new SuperDigit();

        $numbers = [55=>1, 67=>4, 75=>3, 84=>3, 99=>9, 258=>6];
        foreach ($numbers as $number => $result) {
            $actual = $superDigit->sum($number);
            $this->assertEquals(
                $result,
                $actual,
                "'{$number}' given. Expected '{$result}' but got '{$actual}'"
            );
        }
    }

    public function TestTwoInteractions(): void
    {
        $actual = (new SuperDigit())->sum(999989999989998999);
        $this->assertEquals(
            6,
            $actual,
            "'999989999989998999' given. Expected '6' but got '{$actual}'"
        );
    }

    public function testNegativeNumber(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('Number must be equal or greater than zero');
        $this->expectExceptionCode(100);

        (new SuperDigit())->sum(-1);
    }

    public function testZero(): void
    {
        $actual = (new SuperDigit())->sum(0);
        $this->assertEquals(
            0,
            $actual,
            "'0' given. Expected '0' but got '{$actual}'"
        );
    }
}