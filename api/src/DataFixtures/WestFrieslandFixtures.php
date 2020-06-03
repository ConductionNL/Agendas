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

        //Gemeente SED:
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


        //Gemeente Hoorn:
        // Calendar Zuiderveld
        $id = Uuid::fromString('9678886f-bfcc-41d4-a42b-4ae47769c23d');
        $Zuiderveld = new Calendar();
        $Zuiderveld->setName('Calendar Zuiderveld');
        $Zuiderveld->setDescription('Calendar voor begraafplaats Zuiderveld in gemeente Hoorn');
        $Zuiderveld->setTimeZone('CET');
        $manager->persist($Zuiderveld);
        $Zuiderveld->setId($id);
        $manager->persist($Zuiderveld);
        $manager->flush();
        $Zuiderveld = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Berkhouterweg
        $id = Uuid::fromString('9c96f5f1-0c9a-4432-905f-8991635c3ca7');
        $Berkhouterweg = new Calendar();
        $Berkhouterweg->setName('Calendar Berkhouterweg');
        $Berkhouterweg->setDescription('Calendar voor begraafplaats Berkhouterweg in gemeente Hoorn');
        $Berkhouterweg->setTimeZone('CET');
        $manager->persist($Berkhouterweg);
        $Berkhouterweg->setId($id);
        $manager->persist($Berkhouterweg);
        $manager->flush();
        $Berkhouterweg = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Keern
        $id = Uuid::fromString('aed16b93-5912-42df-88cc-b0def3beaa39');
        $Keern = new Calendar();
        $Keern->setName('Calendar Keern');
        $Keern->setDescription('Calendar voor begraafplaats Keern in gemeente Hoorn');
        $Keern->setTimeZone('CET');
        $manager->persist($Keern);
        $Keern->setId($id);
        $manager->persist($Keern);
        $manager->flush();
        $Keern = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Zwaag
        $id = Uuid::fromString('3b020f07-4ea4-4161-a677-f8458f4796ed');
        $Zwaag = new Calendar();
        $Zwaag->setName('Calendar Zwaag');
        $Zwaag->setDescription('Calendar voor begraafplaats Zwaag in gemeente Hoorn');
        $Zwaag->setTimeZone('CET');
        $manager->persist($Zwaag);
        $Zwaag->setId($id);
        $manager->persist($Zwaag);
        $manager->flush();
        $Zwaag = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);


        // Gemeente Medemblik:
        // Calendar Abbekerk (nieuw)
        $id = Uuid::fromString('fbf46af1-7c86-4de7-8b13-c7dd6471e96d');
        $AbbekerkNieuw = new Calendar();
        $AbbekerkNieuw->setName('Calendar Abbekerk (nieuw)');
        $AbbekerkNieuw->setDescription('Calendar voor begraafplaats Abbekerk (nieuw) in gemeente Medemblik');
        $AbbekerkNieuw->setTimeZone('CET');
        $manager->persist($AbbekerkNieuw);
        $AbbekerkNieuw->setId($id);
        $manager->persist($AbbekerkNieuw);
        $manager->flush();
        $AbbekerkNieuw = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Abbekerk (oud)
        $id = Uuid::fromString('6af6f8fe-8824-46ad-8af6-fe7f152e9a8c');
        $AbbekerkOud = new Calendar();
        $AbbekerkOud->setName('Calendar Abbekerk (oud)');
        $AbbekerkOud->setDescription('Calendar voor begraafplaats Abbekerk (oud) in gemeente Medemblik');
        $AbbekerkOud->setTimeZone('CET');
        $manager->persist($AbbekerkOud);
        $AbbekerkOud->setId($id);
        $manager->persist($AbbekerkOud);
        $manager->flush();
        $AbbekerkOud = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Benningbroek (nieuw)
        $id = Uuid::fromString('e37eac05-b6ee-4fc3-b8b7-f7eadd0f9e6d');
        $BenningbroekNieuw = new Calendar();
        $BenningbroekNieuw->setName('Calendar Benningbroek (nieuw)');
        $BenningbroekNieuw->setDescription('Calendar voor begraafplaats Benningbroek (nieuw) in gemeente Medemblik');
        $BenningbroekNieuw->setTimeZone('CET');
        $manager->persist($BenningbroekNieuw);
        $BenningbroekNieuw->setId($id);
        $manager->persist($BenningbroekNieuw);
        $manager->flush();
        $BenningbroekNieuw = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Benningbroek (oud)
        $id = Uuid::fromString('eaf45602-511a-4193-9c03-6ece1187fc63');
        $BenningbroekOud = new Calendar();
        $BenningbroekOud->setName('Calendar Benningbroek (oud)');
        $BenningbroekOud->setDescription('Calendar voor begraafplaats Benningbroek (oud) in gemeente Medemblik');
        $BenningbroekOud->setTimeZone('CET');
        $manager->persist($BenningbroekOud);
        $BenningbroekOud->setId($id);
        $manager->persist($BenningbroekOud);
        $manager->flush();
        $BenningbroekOud = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Lambertschaag
        $id = Uuid::fromString('06cea75a-847a-404c-b12c-950241bdfa7b');
        $Lambertschaag = new Calendar();
        $Lambertschaag->setName('Calendar Lambertschaag');
        $Lambertschaag->setDescription('Calendar voor begraafplaats Lambertschaag in gemeente Medemblik');
        $Lambertschaag->setTimeZone('CET');
        $manager->persist($Lambertschaag);
        $Lambertschaag->setId($id);
        $manager->persist($Lambertschaag);
        $manager->flush();
        $Lambertschaag = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Midwoud (nieuw)
        $id = Uuid::fromString('517eb46e-529a-453d-b79d-45520d9a591a');
        $MidwoudNieuw = new Calendar();
        $MidwoudNieuw->setName('Calendar Midwoud (nieuw)');
        $MidwoudNieuw->setDescription('Calendar voor begraafplaats Midwoud (nieuw) in gemeente Medemblik');
        $MidwoudNieuw->setTimeZone('CET');
        $manager->persist($MidwoudNieuw);
        $MidwoudNieuw->setId($id);
        $manager->persist($MidwoudNieuw);
        $manager->flush();
        $MidwoudNieuw = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Midwoud (oud)
        $id = Uuid::fromString('1b162bb2-650a-4644-a611-c34e3abccee6');
        $MidwoudOud = new Calendar();
        $MidwoudOud->setName('Calendar Midwoud (oud)');
        $MidwoudOud->setDescription('Calendar voor begraafplaats Midwoud (oud) in gemeente Medemblik');
        $MidwoudOud->setTimeZone('CET');
        $manager->persist($MidwoudOud);
        $MidwoudOud->setId($id);
        $manager->persist($MidwoudOud);
        $manager->flush();
        $MidwoudOud = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Oostwoud (nieuw)
        $id = Uuid::fromString('05141bd7-5890-41f0-aa33-f74466b9731c');
        $OostwoudNieuw = new Calendar();
        $OostwoudNieuw->setName('Calendar Oostwoud (nieuw)');
        $OostwoudNieuw->setDescription('Calendar voor begraafplaats Oostwoud (nieuw) in gemeente Medemblik');
        $OostwoudNieuw->setTimeZone('CET');
        $manager->persist($OostwoudNieuw);
        $OostwoudNieuw->setId($id);
        $manager->persist($OostwoudNieuw);
        $manager->flush();
        $OostwoudNieuw = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Oostwoud (oud)
        $id = Uuid::fromString('d4f72b32-4d10-4825-a5b5-6adf0dc14369');
        $OostwoudOud = new Calendar();
        $OostwoudOud->setName('Calendar Oostwoud (oud)');
        $OostwoudOud->setDescription('Calendar voor begraafplaats Oostwoud (oud) in gemeente Medemblik');
        $OostwoudOud->setTimeZone('CET');
        $manager->persist($OostwoudOud);
        $OostwoudOud->setId($id);
        $manager->persist($OostwoudOud);
        $manager->flush();
        $OostwoudOud = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Opperdoes (nieuw)
        $id = Uuid::fromString('39fe81c5-4f2e-49a0-8b4e-562e641b7f30');
        $OpperdoesNieuw = new Calendar();
        $OpperdoesNieuw->setName('Calendar Opperdoes (nieuw)');
        $OpperdoesNieuw->setDescription('Calendar voor begraafplaats Opperdoes (nieuw) in gemeente Medemblik');
        $OpperdoesNieuw->setTimeZone('CET');
        $manager->persist($OpperdoesNieuw);
        $OpperdoesNieuw->setId($id);
        $manager->persist($OpperdoesNieuw);
        $manager->flush();
        $OpperdoesNieuw = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Opperdoes (oud)
        $id = Uuid::fromString('1776104a-5c40-4091-8d58-6c5c676ea6d1');
        $OpperdoesOud = new Calendar();
        $OpperdoesOud->setName('Calendar Opperdoes (oud)');
        $OpperdoesOud->setDescription('Calendar voor begraafplaats Opperdoes (oud) in gemeente Medemblik');
        $OpperdoesOud->setTimeZone('CET');
        $manager->persist($OpperdoesOud);
        $OpperdoesOud->setId($id);
        $manager->persist($OpperdoesOud);
        $manager->flush();
        $OpperdoesOud = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Sijbekarspel (oud)
        $id = Uuid::fromString('7fb5c2ca-f72c-4720-92fe-d2a11a1621a9');
        $SijbekarspelOud = new Calendar();
        $SijbekarspelOud->setName('Calendar Sijbekarspel (oud)');
        $SijbekarspelOud->setDescription('Calendar voor begraafplaats Sijbekarspel (oud) in gemeente Medemblik');
        $SijbekarspelOud->setTimeZone('CET');
        $manager->persist($SijbekarspelOud);
        $SijbekarspelOud->setId($id);
        $manager->persist($SijbekarspelOud);
        $manager->flush();
        $SijbekarspelOud = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Twisk (nieuw)
        $id = Uuid::fromString('0099ecff-c8e4-4995-9b9a-3528a66ef557');
        $TwiskNieuw = new Calendar();
        $TwiskNieuw->setName('Calendar Twisk (nieuw)');
        $TwiskNieuw->setDescription('Calendar voor begraafplaats Twisk (nieuw) in gemeente Medemblik');
        $TwiskNieuw->setTimeZone('CET');
        $manager->persist($TwiskNieuw);
        $TwiskNieuw->setId($id);
        $manager->persist($TwiskNieuw);
        $manager->flush();
        $TwiskNieuw = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Twisk (oud)
        $id = Uuid::fromString('08435035-b28b-4c1f-a7e2-38b5f67f45d1');
        $TwiskOud = new Calendar();
        $TwiskOud->setName('Calendar Twisk (oud)');
        $TwiskOud->setDescription('Calendar voor begraafplaats Twisk (oud) in gemeente Medemblik');
        $TwiskOud->setTimeZone('CET');
        $manager->persist($TwiskOud);
        $TwiskOud->setId($id);
        $manager->persist($TwiskOud);
        $manager->flush();
        $TwiskOud = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Medemblik (Compagniesingel)
        $id = Uuid::fromString('eff794f8-7030-4f81-b276-1cabe17fc120');
        $MedemblikCompagniesingel = new Calendar();
        $MedemblikCompagniesingel->setName('Calendar Medemblik (Compagniesingel)');
        $MedemblikCompagniesingel->setDescription('Calendar voor begraafplaats Medemblik (Compagniesingel) in gemeente Medemblik');
        $MedemblikCompagniesingel->setTimeZone('CET');
        $manager->persist($MedemblikCompagniesingel);
        $MedemblikCompagniesingel->setId($id);
        $manager->persist($MedemblikCompagniesingel);
        $manager->flush();
        $MedemblikCompagniesingel = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Nibbixwoud
        $id = Uuid::fromString('75b84194-372f-4102-b163-b002b3071ab9');
        $Nibbixwoud = new Calendar();
        $Nibbixwoud->setName('Calendar Nibbixwoud');
        $Nibbixwoud->setDescription('Calendar voor begraafplaats Nibbixwoud in gemeente Medemblik');
        $Nibbixwoud->setTimeZone('CET');
        $manager->persist($Nibbixwoud);
        $Nibbixwoud->setId($id);
        $manager->persist($Nibbixwoud);
        $manager->flush();
        $Nibbixwoud = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Wognum
        $id = Uuid::fromString('c6f2dc3f-50ae-4629-bbef-294df4d99445');
        $Wognum = new Calendar();
        $Wognum->setName('Calendar Wognum');
        $Wognum->setDescription('Calendar voor begraafplaats Wognum in gemeente Medemblik');
        $Wognum->setTimeZone('CET');
        $manager->persist($Wognum);
        $Wognum->setId($id);
        $manager->persist($Wognum);
        $manager->flush();
        $Wognum = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Medemblik (Zorgvliet)
        $id = Uuid::fromString('a8e1eccf-ab85-40b1-931d-99f0a86afa43');
        $MedemblikZorgvliet = new Calendar();
        $MedemblikZorgvliet->setName('Calendar Medemblik (Zorgvliet)');
        $MedemblikZorgvliet->setDescription('Calendar voor begraafplaats Medemblik (Zorgvliet) in gemeente Medemblik');
        $MedemblikZorgvliet->setTimeZone('CET');
        $manager->persist($MedemblikZorgvliet);
        $MedemblikZorgvliet->setId($id);
        $manager->persist($MedemblikZorgvliet);
        $manager->flush();
        $MedemblikZorgvliet = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Andijk (Westerbegraafplaats)
        $id = Uuid::fromString('5a6fdffb-2bdf-4f42-8057-4cab4584aa78');
        $AndijkWesterbegraafplaats = new Calendar();
        $AndijkWesterbegraafplaats->setName('Calendar Andijk (Westerbegraafplaats)');
        $AndijkWesterbegraafplaats->setDescription('Calendar voor begraafplaats Andijk (Westerbegraafplaats) in gemeente Medemblik');
        $AndijkWesterbegraafplaats->setTimeZone('CET');
        $manager->persist($AndijkWesterbegraafplaats);
        $AndijkWesterbegraafplaats->setId($id);
        $manager->persist($AndijkWesterbegraafplaats);
        $manager->flush();
        $AndijkWesterbegraafplaats = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Andijk (Oosterbegraafplaats)
        $id = Uuid::fromString('2810a334-b78a-4adf-8be8-8ac115b19ab6');
        $AndijkOosterbegraafplaats = new Calendar();
        $AndijkOosterbegraafplaats->setName('Calendar Andijk (Oosterbegraafplaats)');
        $AndijkOosterbegraafplaats->setDescription('Calendar voor begraafplaats Andijk (Oosterbegraafplaats) in gemeente Medemblik');
        $AndijkOosterbegraafplaats->setTimeZone('CET');
        $manager->persist($AndijkOosterbegraafplaats);
        $AndijkOosterbegraafplaats->setId($id);
        $manager->persist($AndijkOosterbegraafplaats);
        $manager->flush();
        $AndijkOosterbegraafplaats = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

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

        // Calendar Kleine Zomerdijk
        $id = Uuid::fromString('a8d03533-f915-4459-b317-fe61c0b176ee');
        $KleineZomerdijk = new Calendar();
        $KleineZomerdijk->setName('Calendar Kleine Zomerdijk');
        $KleineZomerdijk->setDescription('Calendar voor begraafplaats Kleine Zomerdijk in gemeente Medemblik');
        $KleineZomerdijk->setTimeZone('CET');
        $manager->persist($KleineZomerdijk);
        $KleineZomerdijk->setId($id);
        $manager->persist($KleineZomerdijk);
        $manager->flush();
        $KleineZomerdijk = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);


        //Gemeente Koggenland:
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


        //Gemeente Opmeer:
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
        $id = Uuid::fromString('d105897c-6dee-41b3-9424-c5fe538c967f');
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
