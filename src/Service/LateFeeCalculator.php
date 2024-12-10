<?php

namespace App\Service;

class LateFeeCalculator
{

    public function calculateLateFee(\DateTime $dueDate, \DateTime $returnDate) : float
    {
        if ($returnDate->getTimestamp() < $dueDate->getTimestamp() || $returnDate->getTimestamp() == $dueDate->getTimestamp())
        {
            return 0;
        }
        $fee = 0.5;
        return $fee * $returnDate->diff($dueDate)->d;
    }
}