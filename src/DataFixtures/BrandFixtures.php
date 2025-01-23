<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public const REFERENCE_TOYOTA    = 'brand-toyota';
    public const REFERENCE_SUBARU    = 'brand-subaru';
    public const REFERENCE_CHEVROLET = 'brand-chevrolet';

    public function load(ObjectManager $manager): void
    {
        $toyota = (new Brand())->setName('Toyota');
        $manager->persist($toyota);

        $subaru = (new Brand())->setName('Subaru');
        $manager->persist($subaru);

        $chevrolet = (new Brand())->setName('Chevrolet');
        $manager->persist($chevrolet);

        $manager->flush();

        $this->addReference(self::REFERENCE_TOYOTA, $toyota);
        $this->addReference(self::REFERENCE_SUBARU, $subaru);
        $this->addReference(self::REFERENCE_CHEVROLET, $chevrolet);
    }
}