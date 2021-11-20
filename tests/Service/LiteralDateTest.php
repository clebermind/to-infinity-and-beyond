<?php

namespace App\Tests\Service;

use App\Service\LiteralDate;
use PHPUnit\Framework\TestCase;

class LiteralDateTest extends TestCase
{
    public function testValidDateParameters(): void
    {
        $literalDate = new LiteralDate();

        $dates = [
            'The first Monday of October 2019'   => '2019-10-07',
            'The third Tuesday of October 2019'  => '2019-10-15',
            'The last Wednesday of October 2019' => '2019-10-30'
        ];

        foreach ($dates as $parameter => $expected) {
            $actual = $literalDate->parse($parameter);
            $this->assertEquals(
                $expected,
                $actual,
                "'{$parameter}' given. Expected '{$expected} but got '{$actual}'"
            );
        }
    }

    public function testEmptyDateParameter(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('Empty date');
        $this->expectExceptionCode(10);

        (new LiteralDate())->parse('');
    }

    public function testInvalidDateParameter(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('Invalid Format');
        $this->expectExceptionCode(100);

        (new LiteralDate())->parse('The day of October Nine 2019 here');
    }

    public function testInvalidYear(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The year is invalid or less than 1900 or greater than 2100');
        $this->expectExceptionCode(100);

        (new LiteralDate())->parse('The first Monday of October 201');
    }

    public function testInvalidMonth(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('Invalid month');
        $this->expectExceptionCode(100);

        (new LiteralDate())->parse('The first Monday of Pegasus 201');
    }

    public function testInvalidWeekDay(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('Invalid week day');
        $this->expectExceptionCode(100);

        (new LiteralDate())->parse('The first Luna of October 201');
    }

    public function testInvalidOrd(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('Invalid ord day');
        $this->expectExceptionCode(100);

        (new LiteralDate())->parse('The best Monday of October 201');
    }
}
