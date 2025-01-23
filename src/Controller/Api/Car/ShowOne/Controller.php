<?php

namespace App\Controller\Api\Car\ShowOne;

use App\Application\Constraint\ConstraintErrorListConverter;
use App\Application\Response\ResponseJsonFactory;
use App\Controller\Api\Car\Output\OutputService;
use App\Controller\Api\Car\ShowOne\Dto\Input;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Controller extends AbstractController
{
    public function __construct(
        private readonly CarRepository                $carRepository,
        private readonly ResponseJsonFactory          $responseJsonFactory,
        private readonly ValidatorInterface           $validator,
        private readonly ConstraintErrorListConverter $errorListConverter,
        private readonly OutputService                $outputService,
    ) {}

    public function __invoke(Request $request): Response
    {
        $input     = new Input($request);
        $errorList = $this->validator->validate($input);

        if (!empty($errors = $this->errorListConverter->convert($errorList))) {
            return $this->responseJsonFactory->createFailureResponse($errors);
        }

        $car = $this->carRepository->findOneBy(['id' => $input->getId()]);
        if(is_null($car)) {
            return $this->responseJsonFactory->createFailureResponse(['Не удалось получить данные о машине.']);
        }

        return $this->responseJsonFactory->createSuccessResponse($this->outputService->getData($car));
    }
}