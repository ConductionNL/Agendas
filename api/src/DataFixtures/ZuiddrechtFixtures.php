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

        //urls moeten nog naar de volgende notatie: $section1->setProperties(["{$this->commonGroundService->getComponent('vtc')['location']}/properties/8f9adb13-d5e0-40de-a08c-a2ce5a648b1e"]);

        //Gemeente SED:
        // Calendar Streekweg in Hoogkarspel
        $id = Uuid::fromString('e46e6b3e-9b3a-4339-9d69-874d8dd6bc44');
        $StreekwegInHoogkarspel = new Calendar();
        $StreekwegInHoogkarspel->setName('Algemene Begraafplaats "Rustoord"');
        $StreekwegInHoogkarspel->setDescription('Calendar voor begraafplaats Streekweg in Hoogkarspel in gemeente SED');
        $StreekwegInHoogkarspel->setTimeZone('CET');
        $manager->persist($StreekwegInHoogkarspel);
        $StreekwegInHoogkarspel->setId($id);
        $manager->persist($StreekwegInHoogkarspel);
        $manager->flush();
        $StreekwegInHoogkarspel = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Algemene Begraafplaats "Rustoord"
        $id = Uuid::fromString('7fd885e9-f274-4e55-9167-66167f70d474');
        $AlgemeneBegraafplaatsRustoord = new Calendar();
        $AlgemeneBegraafplaatsRustoord->setName('Nieuwe gemeentelijke begraafplaats');
        $AlgemeneBegraafplaatsRustoord->setDescription('Calendar voor begraafplaats Algemene Begraafplaats "Rustoord" in gemeente SED');
        $AlgemeneBegraafplaatsRustoord->setTimeZone('CET');
        $manager->persist($AlgemeneBegraafplaatsRustoord);
        $AlgemeneBegraafplaatsRustoord->setId($id);
        $manager->persist($AlgemeneBegraafplaatsRustoord);
        $manager->flush();
        $AlgemeneBegraafplaatsRustoord = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

    }
}
