<?php

namespace App\Controller\Api\CreditCalculate\Output;

use App\Application\Loan\CreditCalculatorService;
use App\Controller\Api\CreditCalculate\Dto\Input;
use App\Entity\LoanProgram;

class OutputService
{
    public function __construct(
        private readonly CreditCalculatorService $loanCalculatorService
    ) {}

    public function getData(Input $input, LoanProgram $loanProgram): array
    {
        $monthlyPayment = $this->loanCalculatorService->calculateMonthlyPayment(
            $input->getPrice(),
            $input->getInitialPayment(),
            $input->getLoanTerm(),
            $loanProgram->getInterestRate()
        );

        return [
            'programId'      => $loanProgram->getId(),
            'interestRate'   => $loanProgram->getInterestRate(),
            'monthlyPayment' => number_format($monthlyPayment, 2, '.', ' '),
            'title'          => $loanProgram->getName(),
        ];
    }
}