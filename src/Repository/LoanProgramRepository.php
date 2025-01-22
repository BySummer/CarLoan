<?php

namespace App\Repository;

use App\Entity\LoanProgram;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LoanProgram>
 */
class LoanProgramRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LoanProgram::class);
    }

    public function getByInitialPaymentAndLoanTerm(float $initialPayment, int $loanTerm): ?LoanProgram
    {
        return $this->createQueryBuilder('lp')
                    ->where('lp.minInitialPayment <= :initialPayment')
                    ->andWhere('lp.maxLoanTerm >= :loanTerm')
                    ->setParameter('initialPayment', $initialPayment)
                    ->setParameter('loanTerm', $loanTerm)
                    ->setMaxResults(1)
                    ->getQuery()
                    ->getOneOrNullResult();
    }

    public function getByRandom(): ?LoanProgram
    {
        $total = $this->createQueryBuilder('lp')
                      ->select('COUNT(lp.id)')
                      ->getQuery()
                      ->getSingleScalarResult();

        $randomIndex = rand(0, $total - 1);

        return $this->createQueryBuilder('lp')
                    ->setFirstResult($randomIndex)
                    ->setMaxResults(1)
                    ->getQuery()
                    ->getOneOrNullResult();
    }
}
