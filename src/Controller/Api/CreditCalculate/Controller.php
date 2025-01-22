<?php

namespace App\Controller\Api\CreditCalculate;

use App\Application\Constraint\ConstraintErrorListConverter;
use App\Application\Response\ResponseJsonFactory;
use App\Controller\Api\CreditCalculate\Dto\Input;
use App\Controller\Api\CreditCalculate\Output\OutputService;
use App\Repository\LoanProgramRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Controller
{
    public function __construct(
        private readonly ValidatorInterface           $validator,
        private readonly ConstraintErrorListConverter $errorListConverter,
        private readonly ResponseJsonFactory          $responseJsonFactory,
        private readonly LoanProgramRepository        $loanProgramRepository,
        private readonly OutputService                $outputService
    ) {}

    public function __invoke(Request $request): Response
    {
        $input     = new Input($request);
        $errorList = $this->validator->validate($input);

        if (!empty($errors = $this->errorListConverter->convert($errorList))) {
            return $this->responseJsonFactory->createFailureResponse($errors);
        }

        $loanProgram = $this->loanProgramRepository->getByInitialPaymentAndLoanTerm(
            $input->getInitialPayment(),
            $input->getLoanTerm()
        );

        if (is_null($loanProgram)) {
            $loanProgram = $this->loanProgramRepository->getByRandom();
        }

        if (is_null($loanProgram)) {
            return $this->responseJsonFactory->createFailureResponse(['Не удалось подобрать кредитную программу.']);
        }

        return $this->responseJsonFactory->createSuccessResponse([$this->outputService->getData($input, $loanProgram)]);
    }
}