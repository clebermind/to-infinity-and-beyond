<?php

namespace App\Service;

final class SuperDigit
{
    /**
     * Split number and sum then. Recursively sum it till get only one number
     *
     * @param int $number
     * @return int
     */
    public function sum(int $number): int
    {
        if ($number < 0) {
            throw new \Exception('Number must be equal or greater than zero', 100);
        }

        $number = array_reduce(str_split("{$number}"), function($carry, $item) {
            $carry += $item;
            return $carry;
        });

        if ($number > 9) {
            return $this->sum($number);
        } else {
            return $number;
        }
    }
}


