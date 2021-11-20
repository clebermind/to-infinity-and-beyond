<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service;

class ChallengeController extends AbstractController
{
    public function index(Request $request): Response
    {
        $xml = new Service\Xml(dirname(__DIR__, 2) . '/sample-reaxml.xml');

        $date = 'The first Monday of October 2019';
        $strings = ['MICHAEL', 'JORDAN'];
        $word = 'countryside';
        $digit = 258;

        return $this->render('base.html.twig', [
            'properties' => $xml->getArray(),
            'date' => $date,
            'parsedDate' => (new Service\LiteralDate())->parse($date),
            'strings' =>$strings,
            'mergedStrings' => (new Service\MyString())->merge($strings[0], $strings[1]),
            'word' => $word,
            'repeatingLetters' => (new Service\RepeatingLetter())->isThereAnyRepeatingLetter($word),
            'digit' => $digit,
            'superDigit' => (new Service\SuperDigit())->sum($digit)
        ]);
    }
}
