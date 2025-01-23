<?php

namespace App\DataFixtures;

use App\Entity\LoanProgram;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LoanProgramFixtures extends Fixture
{
    public const REFERENCE_ALFA_ENERGY   = 'loan-program-alfa-energy';
    public const REFERENCE_VTB_TURBO     = 'loan-program-vtb-turbo';
    public const REFERENCE_TBANK_EXPRESS = 'loan-program-tbank-express';

    public function load(ObjectManager $manager): void
    {
        $alfaEnergy = (new LoanProgram())
            ->setName('Alfa Energy')
            ->setInterestRate(12.30)
            ->setMinInitialPayment(200000)
            ->setMaxLoanTerm(60);
        $manager->persist($alfaEnergy);

        $vtbTurbo = (new LoanProgram())
            ->setName('VTB Turbo')
            ->setInterestRate(17)
            ->setMinInitialPayment(15000)
            ->setMaxLoanTerm(36);
        $manager->persist($vtbTurbo);

        $tbankExpress = (new LoanProgram())
            ->setName('TBANK Express')
            ->setInterestRate(16.20)
            ->setMinInitialPayment(10000)
            ->setMaxLoanTerm(36);
        $manager->persist($tbankExpress);

        $manager->flush();

        $this->addReference(self::REFERENCE_ALFA_ENERGY, $alfaEnergy);
        $this->addReference(self::REFERENCE_VTB_TURBO, $vtbTurbo);
        $this->addReference(self::REFERENCE_TBANK_EXPRESS, $tbankExpress);
    }
}