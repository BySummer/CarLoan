<?php

namespace App\Controller\Api\Request;

use App\Application\Constraint\ConstraintErrorListConverter;
use App\Application\Request\RequestManager;
use App\Application\Response\ResponseJsonFactory;
use App\Controller\Api\Request\Dto\Input;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;

class Controller extends AbstractController
{
    public function __construct(
        private readonly ResponseJsonFactory          $responseJsonFactory,
        private readonly ValidatorInterface           $validator,
        private readonly ConstraintErrorListConverter $errorListConverter,
        private readonly RequestManager               $requestManager
    ) {}

    public function __invoke(Request $request): Response
    {
        $input     = new Input($request);
        $errorList = $this->validator->validate($input);

        if (!empty($errors = $this->errorListConverter->convert($errorList))) {
            return $this->responseJsonFactory->createFailureResponse($errors);
        }

        try {
            $this->requestManager->create($input);
        } catch (Throwable $e) {
            $this->responseJsonFactory->createFailureResponse([$e->getMessage()]);
        }

        return $this->responseJsonFactory->createSuccessResponse();
    }
}