<?php

namespace App\Application\Loan;

class CreditCalculatorService
{
    public function calculateMonthlyPayment(
        float $loanAmount,
        float $initialPayment,
        int   $term,
        float $interestRate
    ): float {
        $loanAmount = $loanAmount - $initialPayment;

        if ($interestRate == 0) {
            return $loanAmount / $term;
        }

        $monthlyRate = $interestRate / 100 / 12;
        return ($loanAmount * $monthlyRate) / (1 - pow(1 + $monthlyRate, -$term));
    }
}