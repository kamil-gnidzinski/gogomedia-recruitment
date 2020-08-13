<?php

namespace App\DataFixtures;

use App\Entity\Generator;
use App\Entity\GeneratorData;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Process\Process;

class GeneratorDataFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 20; $i++) {
            $generator = (new Generator())
                ->setGeneratorName('Generator' . $i);
            $manager->persist($generator);
            $this->generateDataForGenerator($generator,$manager);
        }
        $manager->flush();


    }

    private function generateDataForGenerator(Generator $generator,ObjectManager $manager)
    {
          for($j = 1; $j <= 31; $j++){
              for($k = 1; $k <= 50;$k++) {
                  $h = rand(0, 23);
                  $m = rand(0, 59);
                  $s = rand(0, 59);
                  $ms = rand(1, 6000);
                  $dateString = '2020-08-' . $j . ' ' . $h . ':' . $m . ':' . $s . '.' . $ms;
                  $generatorData = new GeneratorData();
                  $generatorData->setCurrentPower(rand(1, 1000))
                      ->setGeneratorID($generator)
                      ->setMeasurementTime(new \DateTime($dateString));
                  $manager->persist($generatorData);
              }
          }


        $manager->flush();
    }
}
