<?php

namespace App\Service;

/**
 * Class MyString
 * @package App\Service
 */
final class MyString
{
    /**
     * Gets the biggest string and cut from the max number of the shortest string generating the rest.
     * So, merge letter by letter one front another than join the rest.
     *
     * @param string $strOne
     * @param string $strTwo
     * @return string
     */
    public function merge(string $strOne, string $strTwo): string
    {
        if (empty($strOne) && !empty($strTwo)) {
            return $strTwo;
        } elseif (empty($strTwo) && !empty($strOne)) {
            return $strOne;
        } elseif (empty($strOne) && empty($strTwo)) {
            return '';
        }

        $strOneLen = strlen($strOne);
        $strTwoLen = strlen($strTwo);

        if ($strOneLen != $strTwoLen) {
            if ($strOneLen > $strTwoLen) {
                $rest = substr($strOne, $strTwoLen);
                $strOne = substr($strOne, 0, $strTwoLen);
            } else {
                $rest = substr($strTwo, $strOneLen);
                $strTwo = substr($strTwo, 0, $strOneLen);
            }
        } else {
            $rest = '';
        }

        $finalString = '';
        for ($i=0; $i<strlen($strOne); $i++) {
            $finalString .= $strOne[$i] . $strTwo[$i];
        }

        return $finalString . $rest;
    }
}
