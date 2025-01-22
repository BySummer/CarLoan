<?php

namespace App\Application\Car;

use App\Entity\Car;

class CarPhotoUrlBuilder
{
    private string $baseHost;
    private string $imageUrlPath;

    public function __construct(string $baseHost, string $imageUrlPath)
    {
        $this->baseHost     = $baseHost;
        $this->imageUrlPath = $imageUrlPath;
    }

    public function getRelativeUrl(string $imageFilename): string
    {
        return $this->imageUrlPath . '/' . $imageFilename;
    }

    public function getAbsoluteUrl(Car $car): string
    {
        return 'http' . '://st.' . $this->baseHost . '/'
            . $this->getRelativeUrl($car->getPhotoFilename());
    }
}