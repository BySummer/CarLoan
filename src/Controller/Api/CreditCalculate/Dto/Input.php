<?php

namespace App\Controller\Api\CreditCalculate\Dto;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

#[Assert\GroupSequence(['Input', 'g1', 'g2', 'g3'])]
class Input
{
    #[Assert\Type(type: 'numeric', groups: ['g1'])]
    #[Assert\NotNull(groups: ['g2'])]
    #[Assert\Positive(groups: ['g2'])]
    private ?string $price;

    #[Assert\Type(type: 'numeric', groups: ['g1'])]
    #[Assert\NotNull(groups: ['g2'])]
    #[Assert\Positive(groups: ['g2'])]
    #[Assert\Range(max: 999999999.99, groups: ['g3'])]
    #[Assert\Regex(
        pattern: '/^\d+(\.\d{1,2})?$/',
        message: 'initialPayment должен быть числом с плавающей точкой',
        groups: ['g3']
    )]
    private ?string $initialPayment;

    #[Assert\Type(type: 'numeric', groups: ['g1'])]
    #[Assert\NotNull(groups: ['g2'])]
    #[Assert\Positive(groups: ['g2'])]
    private ?string $loanTerm;

    public function __construct(Request $request)
    {
        $this->price          = $request->get('price');
        $this->initialPayment = $request->get('initialPayment');
        $this->loanTerm       = $request->get('loanTerm');
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getInitialPayment(): float
    {
        return $this->initialPayment;
    }

    public function getLoanTerm(): int
    {
        return $this->loanTerm;
    }
}