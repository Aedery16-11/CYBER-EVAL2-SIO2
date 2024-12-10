<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\LateFeeCalculator;
use Symfony\Bridge\Twig\TokenParser\DumpTokenParser;

class LateFeeCalculatorTest extends TestCase
{ //Le livre est retourné avec 3 jours de retard (frais = 1,50 €).
    public function testCalculateLateFee(): void
    {
        $calculator = new LateFeeCalculator();
        $dueDate = new \DateTime('2024-01-01');
        $returnDate = new \DateTime('2024-01-04');

//        dump($returnDate->diff($dueDate)->d); cela fait 3 jours de différence
        $this->assertEquals(1.5, $calculator->calculateLateFee($dueDate, $returnDate)); //0.5 * 3 = 1.5
    }

    public function testBookReturnedBeforeDueDate()
    { //Le livre est retourné avant la date d’échéance (frais = 0 €).
        $calculator = new LateFeeCalculator();
        $dueDate = new \DateTime('2024-01-04');
        $returnDate = new \DateTime('2024-01-01');

        //la date de retour est inférieure à la date demandée donc retourne 0
        $this->assertEquals(0, $calculator->calculateLateFee($dueDate, $returnDate));
    }

    public function testBookReturnedAtDueDate()
    { //Le livre est retourné le jour même (frais = 0 €).
        $calculator = new LateFeeCalculator();
        $dueDate = new \DateTime('2024-01-01');
        $returnDate = new \DateTime('2024-01-01');

//        dump( "Retourné : " . $returnDate->getTimestamp());
//        dump("Date demandée : " . $dueDate->getTimestamp());

        //la date de retour est égale à la date demandée donc retourne 0
        $this->assertEquals(0, $calculator->calculateLateFee($dueDate, $returnDate));

    }





}