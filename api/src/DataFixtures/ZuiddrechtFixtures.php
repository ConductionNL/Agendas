<?php

namespace App\DataFixtures;

use App\Entity\Calendar;
use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ZuiddrechtFixtures extends Fixture
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function load(ObjectManager $manager)
    {
        if (
            !$this->params->get('app_build_all_fixtures') &&
            $this->params->get('app_domain') != 'zuid-drecht.nl' && strpos($this->params->get('app_domain'), 'zuid-drecht.nl') == false
        ) {
            return false;
        }

        // Algemene Begraafplaats "Rustoord"
        $id = Uuid::fromString('e46e6b3e-9b3a-4339-9d69-874d8dd6bc44');
        $calendar = new Calendar();
        $calendar->setName('Algemene Begraafplaats "Rustoord"');
        $calendar->setDescription('Calendar voor begraafplaats Streekweg in Hoogkarspel in gemeente SED');
        $calendar->setTimeZone('CET');
        $manager->persist($calendar);
        $calendar->setId($id);
        $manager->persist($calendar);
        $manager->flush();
        $calendar = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Nieuwe gemeentelijke begraafplaats
        $id = Uuid::fromString('7fd885e9-f274-4e55-9167-66167f70d474');
        $calendar = new Calendar();
        $calendar->setName('Nieuwe gemeentelijke begraafplaats');
        $calendar->setDescription('Calendar voor begraafplaats Algemene Begraafplaats "Rustoord" in gemeente SED');
        $calendar->setTimeZone('CET');
        $manager->persist($calendar);
        $calendar->setId($id);
        $manager->persist($calendar);
        $manager->flush();
        $calendar = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

    }
}
