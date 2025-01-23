<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\Model;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $supra  = $this->getReference(ModelFixtures::REFERENCE_SUPRA, Model::class);
        $wrx    = $this->getReference(ModelFixtures::REFERENCE_WRX, Model::class);
        $camaro = $this->getReference(ModelFixtures::REFERENCE_CAMARO, Model::class);

        $car1 = (new Car())
            ->setModel($supra)
            ->setPhotoFilename('supra.jpg')
            ->setPrice(1200000);
        $manager->persist($car1);

        $car2 = (new Car())
            ->setModel($wrx)
            ->setPhotoFilename('wrx.jpg')
            ->setPrice(2200000);
        $manager->persist($car2);

        $car3 = (new Car())
            ->setModel($camaro)
            ->setPhotoFilename('camaro.jpg')
            ->setPrice(1600000);
        $manager->persist($car3);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ModelFixtures::class,
        ];
    }
}
