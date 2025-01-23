<?php

namespace App\Controller\Api\Car\Show;

use Symfony\Component\HttpFoundation\Response;
use App\Application\Response\ResponseJsonFactory;
use App\Controller\Api\Car\Output\OutputService;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Controller extends AbstractController
{
    public function __construct(
        private readonly CarRepository       $carRepository,
        private readonly ResponseJsonFactory $responseJsonFactory,
        private readonly OutputService       $outputService,
    ) {}

    public function __invoke(): Response
    {
        $cars = [];
        foreach ($this->carRepository->findAll() as $car) {
            $cars[] = $this->outputService->getData($car);
        }
        return $this->responseJsonFactory->createSuccessResponse($cars);
    }
}