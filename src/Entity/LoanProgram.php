<?php

namespace App\Entity;

use App\Repository\LoanProgramRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoanProgramRepository::class)]
class LoanProgram
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $interestRate = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $minInitialPayment = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $maxLoanTerm = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getInterestRate(): ?string
    {
        return $this->interestRate;
    }

    public function setInterestRate(string $interestRate): static
    {
        $this->interestRate = $interestRate;

        return $this;
    }

    public function getMinInitialPayment(): ?string
    {
        return $this->minInitialPayment;
    }

    public function setMinInitialPayment(string $minInitialPayment): static
    {
        $this->minInitialPayment = $minInitialPayment;

        return $this;
    }

    public function getMaxLoanTerm(): ?int
    {
        return $this->maxLoanTerm;
    }

    public function setMaxLoanTerm(int $maxLoanTerm): static
    {
        $this->maxLoanTerm = $maxLoanTerm;

        return $this;
    }
}
