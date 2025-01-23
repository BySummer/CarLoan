<?php

namespace App\Controller\Api\Car\Output;

use App\Application\Car\CarPhotoUrlBuilder;
use App\Entity\Car;

class OutputService
{
    public function __construct(
        private readonly CarPhotoUrlBuilder $carPhotoUrlBuilder
    ) {}

    public function getData(Car $car): array
    {
        $model = $car->getModel();
        $brand = $model->getBrand();

        return [
            'id'    => $car->getId(),
            'brand' => [
                'id'   => $brand->getId(),
                'name' => $brand->getName(),
            ],
            'model' => [
                'id'   => $brand->getId(),
                'name' => $model->getName(),
            ],
            'photo' => $this->carPhotoUrlBuilder->getAbsoluteUrl($car),
            'price' => round($car->getPrice()),
        ];
    }
}