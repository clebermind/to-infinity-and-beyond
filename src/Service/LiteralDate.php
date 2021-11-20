<?php

namespace App\Service;

/**
 * Class LiteralDate
 * @package App\Service
 */
final class LiteralDate
{
    /**
     * Find first occurrence of the weekday in the month.
     * So, get the last day of the month.
     * Then, loop finding all weekdays in this interval returning what needed.
     *
     * @param string $date
     * @return string
     */
    public function parse(string $date): string
    {
        if (empty($date)) {
            throw new \Exception('Empty date', 10);
        }
        $regex = '/^\w+\s+(\w+)\s+(\w+)\s+\bof\b\s+(\w+)\s+(\d+)$/m';
        $chooseDays = ['first'=>0, 'second'=>1, 'third'=>2, 'fourth'=>3, 'fifth'=>4, 'last'=>-1];

        if (!preg_match($regex, $date)) {
            throw new \Exception('Invalid Format', 100);
        }

        /*
         * $dateItems:
         *  0: the whole date
         *  1: ord
         *  2: weekday
         *  3: month
         *  4: year
         */
        preg_match_all($regex, $date, $dateItems, PREG_SET_ORDER);
        $dateItems = $dateItems[0];

        // validations
        if (!in_array(strtolower($dateItems[1]), array_keys($chooseDays))) {
            throw new \Exception('Invalid ord day', 100);
        } elseif (!in_array(
            strtolower($dateItems[2]),
            ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'])
        ) {
            throw new \Exception('Invalid week day', 100);
        }elseif (!in_array(
            strtolower($dateItems[3]),
            ['january', 'february', 'march', 'april', 'may', 'june', 'july',
             'august', 'september', 'october', 'november', 'december'])
        ) {
            throw new \Exception('Invalid month', 100);
        } else if (!is_numeric($dateItems[4]) || $dateItems[4] < 1900 || $dateItems[4] > 2099) {
            throw new \Exception('The year is invalid or less than 1900 or greater than 2100', 100);
        }

        $day = 1;
        $weekDayComp = strtolower(trim($dateItems[2]));
        $monthNum = date('m', strtotime($dateItems[3]));
        while (true) {
            $firstDay = mktime(0, 0, 0, (int)$monthNum, (int)$day, (int)$dateItems[4]);
            $firstDayStr = strtolower(date('l', $firstDay));


            if ($firstDayStr==$weekDayComp) {
                break;
            }

            $day++;
        }

        $lastDay = (new \DateTime(date('Y-m-t', $firstDay)))->getTimestamp();

        $increaseDay = $firstDay;
        $availableDays = [];
        while ($increaseDay < $lastDay) {
            $availableDays[] = date('Y-m-d', $increaseDay);
            $increaseDay += 7 * 86400;
        }

        $chosenDay = $chooseDays[strtolower($dateItems[1])];
        if ($chosenDay == -1) {
            return $availableDays[count($availableDays)-1];
        } elseif(isset($availableDays[$chosenDay])) {
            return $availableDays[$chosenDay];
        } else {
            throw new \Exception('Ord day not available');
        }
    }
}
