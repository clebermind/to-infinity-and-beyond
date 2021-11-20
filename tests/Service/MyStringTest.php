<?php

namespace App\Tests\Service;

use App\Service\MyString;
use PHPUnit\Framework\TestCase;

class MyStringTest extends TestCase
{
    public function testPositiveMerge(): void
    {
        $myString = new MyString();

        $dates = [
            [
                'value' => ['MICHAEL', 'JORDAN'],
                'result' => 'MJIOCRHDAAENL'
            ],
            [
                'value' => ['CLEBER', 'MENDES'],
                'result' => 'CMLEENBDEERS'
            ],
        ];

        foreach ($dates as $values) {
            $actual = $myString->merge($values['value'][0], $values['value'][1]);
            $this->assertEquals(
                $values['result'],
                $actual,
                $values['value'][0] . ' and ' . $values['value'][1]
                . "' given. Expected '{$values['result']} but got '{$actual}'"
            );
        }
    }

    public function testEmptyFirstValue(): void
    {
        $actual = (new MyString())->merge('', 'val');
        $this->assertEquals(
            'val',
            $actual,
            "Only 'val' given. Expected val but got '{$actual}'"
        );
    }

    public function testEmptySecondValue(): void
    {
        $actual = (new MyString())->merge('test', '');
        $this->assertEquals(
            'test',
            $actual,
            "Only 'test' given. Expected test but got '{$actual}'"
        );
    }

    public function testEmptyBothValues(): void
    {
        $this->assertEmpty(($challengeService = new MyString())->merge('', ''));
    }
}