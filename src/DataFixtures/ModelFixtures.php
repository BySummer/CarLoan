<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Model;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ModelFixtures extends Fixture implements DependentFixtureInterface
{
    public const REFERENCE_SUPRA  = 'model-supra';
    public const REFERENCE_WRX    = 'model-wrx';
    public const REFERENCE_CAMARO = 'model-camaro';

    public function load(ObjectManager $manager): void
    {
        $toyota    = $this->getReference(BrandFixtures::REFERENCE_TOYOTA, Brand::class);
        $subaru    = $this->getReference(BrandFixtures::REFERENCE_SUBARU, Brand::class);
        $chevrolet = $this->getReference(BrandFixtures::REFERENCE_CHEVROLET, Brand::class);

        $supra = (new Model())
            ->setName('Supra')
            ->setBrand($toyota);
        $manager->persist($supra);

        $wrx = (new Model())
            ->setName('WRX STI')
            ->setBrand($subaru);
        $manager->persist($wrx);

        $camaro = (new Model())
            ->setName('Camaro')
            ->setBrand($chevrolet);
        $manager->persist($camaro);

        $manager->flush();

        $this->addReference(self::REFERENCE_SUPRA, $supra);
        $this->addReference(self::REFERENCE_WRX, $wrx);
        $this->addReference(self::REFERENCE_CAMARO, $camaro);
    }

    public function getDependencies(): array
    {
        return [
            BrandFixtures::class,
        ];
    }
}