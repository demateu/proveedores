<?php

namespace App\DataFixtures;

use App\Factory\ProviderFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProveedorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Crear 50 proveedores con datos ficticios
        ProviderFactory::createMany(50);
        $manager->flush();
    }
}
