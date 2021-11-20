<?php

namespace App\Service;

/**
 * Class RepeatingLetter
 * @package App\Service
 */
final class RepeatingLetter
{
    /**
     * Clean the string removing any letter which is letter or number.
     * Put the word in lowercase. So, split in array and remove repetitions.
     * Then, compare number of letters from original to duplication removed.
     *
     * @param string $word
     * @return bool
     */
    public function isThereAnyRepeatingLetter(string $word): bool
    {
        $word = preg_replace('/[^a-zA-Z0-9]/m', '', strtolower($word));
        if (empty($word)) {
            return true;
        }
        $wordArr = str_split($word);

        return count($wordArr)==count(array_unique($wordArr));
    }
}


