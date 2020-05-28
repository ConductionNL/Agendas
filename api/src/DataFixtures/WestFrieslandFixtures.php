<?php

namespace App\DataFixtures;

use App\Entity\Calendar;
use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class WestFrieslandFixtures extends Fixture
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function load(ObjectManager $manager)
    {
        if (
            $this->params->get('app_domain') != 'begraven.zaakonline.nl' &&
            strpos($this->params->get('app_domain'), 'begraven.zaakonline.nl') == false &&
            $this->params->get('app_domain') != 'westfriesland.commonground.nu' &&
            strpos($this->params->get('app_domain'), 'westfriesland.commonground.nu') == false
        ) {
            return false;
        }

        //urls moeten nog naar de volgende notatie: $section1->setProperties(["{$this->commonGroundService->getComponent('vtc')['location']}/properties/8f9adb13-d5e0-40de-a08c-a2ce5a648b1e"]);

        // Calendar Wognum (Kreekland)
        $id = Uuid::fromString('2885fad3-56de-47ee-a817-5d5bc007f87e');
        $WognumKreekland = new Calendar();
        $WognumKreekland->setName('Calendar Wognum (Kreekland)');
        $WognumKreekland->setDescription('Calendar voor begraafplaats Wognum (Kreekland) in gemeente Medemblik');
        $WognumKreekland->setTimeZone('CET');
        $manager->persist($WognumKreekland);
        $WognumKreekland->setId($id);
        $manager->persist($WognumKreekland);
        $manager->flush();
        $WognumKreekland = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Events voor Calendar Wognum (Kreekland)
        // TestEvent 1
        $id = Uuid::fromString('1e7e181c-6f9c-4937-8f9b-2ea35e4e7d75');
        $TestEvent1 = new Event();
        $TestEvent1->setName('10:00-12:00, 2020-06-04');
        $TestEvent1->setDescription('Event 10:00-12:00, 2020-06-04 voor calendar Wognum (Kreekland)');
        $TestEvent1->setStartDate(new \DateTime('2020-06-04T10:00:00+00:00'));
        $TestEvent1->setEndDate(new \DateTime('2020-06-04T12:00:00+00:00'));
        $TestEvent1->setCalendar($WognumKreekland);
        $manager->persist($TestEvent1);
        $TestEvent1->setId($id);
        $manager->persist($TestEvent1);
        $manager->flush();
        $TestEvent1 = $manager->getRepository('App:Event')->findOneBy(['id'=> $id]);

        // TestEvent 2
        $id = Uuid::fromString('262ee715-3d82-4c15-a2a8-5da2627ccb92');
        $TestEvent2 = new Event();
        $TestEvent2->setName('14:30-16:30, 2020-06-04');
        $TestEvent2->setDescription('Event 14:30-16:30, 2020-06-04 voor calendar Wognum (Kreekland)');
        $TestEvent2->setStartDate(new \DateTime('2020-06-04T14:30:00+00:00'));
        $TestEvent2->setEndDate(new \DateTime('2020-06-04T16:30:00+00:00'));
        $TestEvent2->setCalendar($WognumKreekland);
        $manager->persist($TestEvent2);
        $TestEvent2->setId($id);
        $manager->persist($TestEvent2);
        $manager->flush();
        $TestEvent2 = $manager->getRepository('App:Event')->findOneBy(['id'=> $id]);

        // TestEvent 3
        $id = Uuid::fromString('29bcef2e-0f0b-487a-a7bb-09ee2114c630');
        $TestEvent3 = new Event();
        $TestEvent3->setName('14:30-16:30, 2020-06-10');
        $TestEvent3->setDescription('Event 14:30-16:30, 2020-06-10 voor calendar Wognum (Kreekland)');
        $TestEvent3->setStartDate(new \DateTime('2020-06-10T14:30:00+00:00'));
        $TestEvent3->setEndDate(new \DateTime('2020-06-10T16:30:00+00:00'));
        $TestEvent3->setCalendar($WognumKreekland);
        $manager->persist($TestEvent3);
        $TestEvent3->setId($id);
        $manager->persist($TestEvent3);
        $manager->flush();
        $TestEvent3 = $manager->getRepository('App:Event')->findOneBy(['id'=> $id]);

        // TestEvent 4
        $id = Uuid::fromString('29bcef2e-0f0b-487a-a7bb-09ee2114c630');
        $TestEvent4 = new Event();
        $TestEvent4->setName('20:00-22:00, 2020-06-12');
        $TestEvent4->setDescription('Event 20:00-22:00, 2020-06-12 voor calendar Wognum (Kreekland)');
        $TestEvent4->setStartDate(new \DateTime('2020-06-12T20:00:00+00:00'));
        $TestEvent4->setEndDate(new \DateTime('2020-06-12T22:00:00+00:00'));
        $TestEvent4->setCalendar($WognumKreekland);
        $manager->persist($TestEvent4);
        $TestEvent4->setId($id);
        $manager->persist($TestEvent4);
        $manager->flush();
        $TestEvent4 = $manager->getRepository('App:Event')->findOneBy(['id'=> $id]);

        $manager->flush();
    }
}
