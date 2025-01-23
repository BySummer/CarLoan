<?php

namespace App\Application\Request;

use App\Application\Request\Dto\RequestInterface;
use App\Application\Request\Exception\RequestManagerException;
use App\Entity\Car;
use App\Entity\LoanProgram;
use App\Entity\Request;
use App\Repository\CarRepository;
use App\Repository\LoanProgramRepository;
use Doctrine\ORM\EntityManagerInterface;
use Throwable;

class RequestManager
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly CarRepository          $carRepository,
        private readonly LoanProgramRepository  $loanProgramRepository
    ) {}

    /**
     * @throws RequestManagerException
     */
    public function create(RequestInterface $requestDto): Request
    {
        $request = new Request();
        $request->setCar($this->getCarFromDto($requestDto));
        $request->setLoanProgram($this->getLoanProgramFromDto($requestDto));
        $request->setInitialPayment($requestDto->getInitialPayment());
        $request->setLoanTerm($requestDto->getLoanTerm());

        try {
            $this->entityManager->persist($request);
            $this->entityManager->flush();
        } catch (Throwable $e) {
            throw new RequestManagerException('Не удалось создать заявку', 0, $e);
        }

        return $request;
    }

    /**
     * @throws RequestManagerException
     */
    private function getCarFromDto(RequestInterface $requestDto): Car
    {
        $car = $this->carRepository->findOneBy(['id' => $requestDto->getCarId()]);
        if(is_null($car)) {
            throw new RequestManagerException('Не удалось получить информацию о машине');
        }
        return $car;
    }

    /**
     * @throws RequestManagerException
     */
    private function getLoanProgramFromDto(RequestInterface $requestDto): LoanProgram
    {
        $loanProgram = $this->loanProgramRepository->findOneBy(['id' => $requestDto->getLoanProgramId()]);
        if(is_null($loanProgram)) {
            throw new RequestManagerException('Не удалось получить информацию о кредитной программе');
        }
        return $loanProgram;
    }
}