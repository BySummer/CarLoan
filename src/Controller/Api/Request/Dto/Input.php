<?php

namespace App\Controller\Api\Request\Dto;

use App\Application\Request\Dto\RequestInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use App\Infrastructure\Symfony\Validator\Constraints as AppAssert;

#[Assert\GroupSequence(['Input', 'g1', 'g2', 'g3'])]
class Input implements RequestInterface
{
    #[Assert\Type(type: 'numeric', groups: ['g1'])]
    #[Assert\NotBlank(groups: ['g2'])]
    #[AppAssert\EntityExist(
        entity: 'App\Entity\Car',
        property: 'id',
        message: 'Машина с указанным ID не найдена',
        groups: ['g3']
    )]
    private ?string $carId;

    #[Assert\Type(type: 'numeric', groups: ['g1'])]
    #[Assert\NotBlank(groups: ['g2'])]
    #[AppAssert\EntityExist(
        entity: 'App\Entity\LoanProgram',
        property: 'id',
        message: 'Кредитная программа с указанным ID не найдена',
        groups: ['g3']
    )]
    private ?string $programId;

    #[Assert\Type(type: 'numeric', groups: ['g1'])]
    #[Assert\NotNull(groups: ['g2'])]
    #[Assert\Positive(groups: ['g2'])]
    #[Assert\Range(max: 999999999, groups: ['g3'])]
    private ?string $initialPayment;

    #[Assert\Type(type: 'numeric', groups: ['g1'])]
    #[Assert\NotNull(groups: ['g2'])]
    #[Assert\Positive(groups: ['g2'])]
    private ?string $loanTerm;

    public function __construct(Request $request)
    {
        $this->carId          = $request->getPayload()->get('carId');
        $this->programId      = $request->getPayload()->get('programId');
        $this->initialPayment = $request->getPayload()->get('initialPayment');
        $this->loanTerm       = $request->getPayload()->get('loanTerm');
    }

    public function getCarId(): int
    {
        return $this->carId;
    }

    public function getLoanProgramId(): int
    {
        return $this->programId;
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