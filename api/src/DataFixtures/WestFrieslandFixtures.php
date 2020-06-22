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
        // Calendar Streekweg in Hoogkarspel
        $id = Uuid::fromString('ab69a95d-f46c-4b3f-9027-9f25fd9bbb5f');
        $StreekwegInHoogkarspel = new Calendar();
        $StreekwegInHoogkarspel->setName('Calendar Streekweg in Hoogkarspel');
        $StreekwegInHoogkarspel->setDescription('Calendar voor begraafplaats Streekweg in Hoogkarspel in gemeente SED');
        $StreekwegInHoogkarspel->setTimeZone('CET');
        $manager->persist($StreekwegInHoogkarspel);
        $StreekwegInHoogkarspel->setId($id);
        $manager->persist($StreekwegInHoogkarspel);
        $manager->flush();
        $StreekwegInHoogkarspel = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Algemene Begraafplaats "Rustoord"
        $id = Uuid::fromString('f4fa187b-c807-4e20-afda-dff758d68cae');
        $AlgemeneBegraafplaatsRustoord = new Calendar();
        $AlgemeneBegraafplaatsRustoord->setName('Calendar Algemene Begraafplaats "Rustoord"');
        $AlgemeneBegraafplaatsRustoord->setDescription('Calendar voor begraafplaats Algemene Begraafplaats "Rustoord" in gemeente SED');
        $AlgemeneBegraafplaatsRustoord->setTimeZone('CET');
        $manager->persist($AlgemeneBegraafplaatsRustoord);
        $AlgemeneBegraafplaatsRustoord->setId($id);
        $manager->persist($AlgemeneBegraafplaatsRustoord);
        $manager->flush();
        $AlgemeneBegraafplaatsRustoord = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Westerkerkweg in Venhuizen
        $id = Uuid::fromString('ed397496-1faf-48b1-890c-f9afb74645d4');
        $WesterkerkwegInVenhuizen = new Calendar();
        $WesterkerkwegInVenhuizen->setName('Calendar Westerkerkweg in Venhuizen');
        $WesterkerkwegInVenhuizen->setDescription('Calendar voor begraafplaats Westerkerkweg in Venhuizen in gemeente SED');
        $WesterkerkwegInVenhuizen->setTimeZone('CET');
        $manager->persist($WesterkerkwegInVenhuizen);
        $WesterkerkwegInVenhuizen->setId($id);
        $manager->persist($WesterkerkwegInVenhuizen);
        $manager->flush();
        $WesterkerkwegInVenhuizen = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Schoollaan in Hem
        $id = Uuid::fromString('4eb1880d-96cb-4f50-8499-e55c61816974');
        $SchoollaanInHem = new Calendar();
        $SchoollaanInHem->setName('Calendar Schoollaan in Hem');
        $SchoollaanInHem->setDescription('Calendar voor begraafplaats Schoollaan in Hem in gemeente SED');
        $SchoollaanInHem->setTimeZone('CET');
        $manager->persist($SchoollaanInHem);
        $SchoollaanInHem->setId($id);
        $manager->persist($SchoollaanInHem);
        $manager->flush();
        $SchoollaanInHem = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Molenwei in Hoogkarspel
        $id = Uuid::fromString('da41a5ff-43fe-4256-83c1-e064e7b3c4a6');
        $MolenweiInHoogkarspel = new Calendar();
        $MolenweiInHoogkarspel->setName('Calendar Molenwei in Hoogkarspel');
        $MolenweiInHoogkarspel->setDescription('Calendar voor begraafplaats Molenwei in Hoogkarspel in gemeente SED');
        $MolenweiInHoogkarspel->setTimeZone('CET');
        $manager->persist($MolenweiInHoogkarspel);
        $MolenweiInHoogkarspel->setId($id);
        $manager->persist($MolenweiInHoogkarspel);
        $manager->flush();
        $MolenweiInHoogkarspel = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Raadhuisplein in Hoogkarspel
        $id = Uuid::fromString('e16fd87d-3484-45fe-ad7c-d894ce454e35');
        $RaadhuispleinInHoogkarspel = new Calendar();
        $RaadhuispleinInHoogkarspel->setName('Calendar Raadhuisplein in Hoogkarspel');
        $RaadhuispleinInHoogkarspel->setDescription('Calendar voor begraafplaats Raadhuisplein in Hoogkarspel in gemeente SED');
        $RaadhuispleinInHoogkarspel->setTimeZone('CET');
        $manager->persist($RaadhuispleinInHoogkarspel);
        $RaadhuispleinInHoogkarspel->setId($id);
        $manager->persist($RaadhuispleinInHoogkarspel);
        $manager->flush();
        $RaadhuispleinInHoogkarspel = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Begraafplaats in Oosterleek
        $id = Uuid::fromString('3712f885-1d43-4e19-8b40-e39e885d66ac');
        $BegraafplaatsInOosterleek = new Calendar();
        $BegraafplaatsInOosterleek->setName('Calendar Begraafplaats in Oosterleek');
        $BegraafplaatsInOosterleek->setDescription('Calendar voor begraafplaats Begraafplaats in Oosterleek in gemeente SED');
        $BegraafplaatsInOosterleek->setTimeZone('CET');
        $manager->persist($BegraafplaatsInOosterleek);
        $BegraafplaatsInOosterleek->setId($id);
        $manager->persist($BegraafplaatsInOosterleek);
        $manager->flush();
        $BegraafplaatsInOosterleek = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Dorpsweg in Schellinkhout
        $id = Uuid::fromString('417cb133-161d-4799-93b5-bc7ac3a4f51b');
        $DorpswegInSchellinkhout = new Calendar();
        $DorpswegInSchellinkhout->setName('Calendar Dorpsweg in Schellinkhout');
        $DorpswegInSchellinkhout->setDescription('Calendar voor begraafplaats Dorpsweg in Schellinkhout in gemeente SED');
        $DorpswegInSchellinkhout->setTimeZone('CET');
        $manager->persist($DorpswegInSchellinkhout);
        $DorpswegInSchellinkhout->setId($id);
        $manager->persist($DorpswegInSchellinkhout);
        $manager->flush();
        $DorpswegInSchellinkhout = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Kerkbuurt in Wijdenes
        $id = Uuid::fromString('d0f3ed79-acd9-4eaa-8b84-88b6fc150a47');
        $KerkbuurtInWijdenes = new Calendar();
        $KerkbuurtInWijdenes->setName('Calendar Kerkbuurt in Wijdenes');
        $KerkbuurtInWijdenes->setDescription('Calendar voor begraafplaats Kerkbuurt in Wijdenes in gemeente SED');
        $KerkbuurtInWijdenes->setTimeZone('CET');
        $manager->persist($KerkbuurtInWijdenes);
        $KerkbuurtInWijdenes->setId($id);
        $manager->persist($KerkbuurtInWijdenes);
        $manager->flush();
        $KerkbuurtInWijdenes = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Gemeentelijke begraafplaats
        $id = Uuid::fromString('7ae61cae-fa4f-4efd-aa85-8767602c7680');
        $GemeentelijkeBegraafplaats = new Calendar();
        $GemeentelijkeBegraafplaats->setName('Calendar Gemeentelijke begraafplaats');
        $GemeentelijkeBegraafplaats->setDescription('Calendar voor begraafplaats Gemeentelijke begraafplaats in gemeente SED');
        $GemeentelijkeBegraafplaats->setTimeZone('CET');
        $manager->persist($GemeentelijkeBegraafplaats);
        $GemeentelijkeBegraafplaats->setId($id);
        $manager->persist($GemeentelijkeBegraafplaats);
        $manager->flush();
        $GemeentelijkeBegraafplaats = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

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
        // Calendar Avenhorn
        $id = Uuid::fromString('837f45f7-6419-4175-888e-f7b4c56cfede');
        $Avenhorn = new Calendar();
        $Avenhorn->setName('Calendar Avenhorn');
        $Avenhorn->setDescription('Calendar voor begraafplaats Avenhorn in gemeente Koggenland');
        $Avenhorn->setTimeZone('CET');
        $manager->persist($Avenhorn);
        $Avenhorn->setId($id);
        $manager->persist($Avenhorn);
        $manager->flush();
        $Avenhorn = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Berkhout
        $id = Uuid::fromString('7efbbbce-7bd0-4b02-896a-23957c841f32');
        $Berkhout = new Calendar();
        $Berkhout->setName('Calendar Berkhout');
        $Berkhout->setDescription('Calendar voor begraafplaats Berkhout in gemeente Koggenland');
        $Berkhout->setTimeZone('CET');
        $manager->persist($Berkhout);
        $Berkhout->setId($id);
        $manager->persist($Berkhout);
        $manager->flush();
        $Berkhout = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Oudendijk
        $id = Uuid::fromString('87d6ca22-1982-4b7e-bf9a-6c2b8542e6ee');
        $Oudendijk = new Calendar();
        $Oudendijk->setName('Calendar Oudendijk');
        $Oudendijk->setDescription('Calendar voor begraafplaats Oudendijk in gemeente Koggenland');
        $Oudendijk->setTimeZone('CET');
        $manager->persist($Oudendijk);
        $Oudendijk->setId($id);
        $manager->persist($Oudendijk);
        $manager->flush();
        $Oudendijk = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Grosthuizen
        $id = Uuid::fromString('362d9c05-7b31-47e8-ae98-e5e1e8a45d1f');
        $Grosthuizen = new Calendar();
        $Grosthuizen->setName('Calendar Grosthuizen');
        $Grosthuizen->setDescription('Calendar voor begraafplaats Grosthuizen in gemeente Koggenland');
        $Grosthuizen->setTimeZone('CET');
        $manager->persist($Grosthuizen);
        $Grosthuizen->setId($id);
        $manager->persist($Grosthuizen);
        $manager->flush();
        $Grosthuizen = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Ursem
        $id = Uuid::fromString('abb520b0-73da-4604-b72c-b26cecda556c');
        $Ursem = new Calendar();
        $Ursem->setName('Calendar Ursem');
        $Ursem->setDescription('Calendar voor begraafplaats Ursem in gemeente Koggenland');
        $Ursem->setTimeZone('CET');
        $manager->persist($Ursem);
        $Ursem->setId($id);
        $manager->persist($Ursem);
        $manager->flush();
        $Ursem = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Hensbroek
        $id = Uuid::fromString('3f40dc8f-2b63-429d-b677-a006e2863f66');
        $Hensbroek = new Calendar();
        $Hensbroek->setName('Calendar Hensbroek');
        $Hensbroek->setDescription('Calendar voor begraafplaats Hensbroek in gemeente Koggenland');
        $Hensbroek->setTimeZone('CET');
        $manager->persist($Hensbroek);
        $Hensbroek->setId($id);
        $manager->persist($Hensbroek);
        $manager->flush();
        $Hensbroek = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Obdam
        $id = Uuid::fromString('c09c8b68-7721-4276-a92b-15f45c25a8d8');
        $Obdam = new Calendar();
        $Obdam->setName('Calendar Obdam');
        $Obdam->setDescription('Calendar voor begraafplaats Obdam in gemeente Koggenland');
        $Obdam->setTimeZone('CET');
        $manager->persist($Obdam);
        $Obdam->setId($id);
        $manager->persist($Obdam);
        $manager->flush();
        $Obdam = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        //Gemeente Opmeer:
        // Calendar Aartswoud
        $id = Uuid::fromString('a03f8321-a02f-497e-993c-00677aee2566');
        $Aartswoud = new Calendar();
        $Aartswoud->setName('Calendar Aartswoud');
        $Aartswoud->setDescription('Calendar voor begraafplaats Aartswoud in gemeente Opmeer');
        $Aartswoud->setTimeZone('CET');
        $manager->persist($Aartswoud);
        $Aartswoud->setId($id);
        $manager->persist($Aartswoud);
        $manager->flush();
        $Aartswoud = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Spanbroek
        $id = Uuid::fromString('9066d1c3-01fc-41b6-b7da-799be71390cd');
        $Spanbroek = new Calendar();
        $Spanbroek->setName('Calendar Spanbroek');
        $Spanbroek->setDescription('Calendar voor begraafplaats Spanbroek in gemeente Opmeer');
        $Spanbroek->setTimeZone('CET');
        $manager->persist($Spanbroek);
        $Spanbroek->setId($id);
        $manager->persist($Spanbroek);
        $manager->flush();
        $Spanbroek = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Opmeer
        $id = Uuid::fromString('e56fdbad-b97a-46fc-85f3-232ff8721055');
        $Opmeer = new Calendar();
        $Opmeer->setName('Calendar Opmeer');
        $Opmeer->setDescription('Calendar voor begraafplaats Opmeer in gemeente Opmeer');
        $Opmeer->setTimeZone('CET');
        $manager->persist($Opmeer);
        $Opmeer->setId($id);
        $manager->persist($Opmeer);
        $manager->flush();
        $Opmeer = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar Hoogwoud
        $id = Uuid::fromString('53c8905a-b77f-449b-8bb1-9b77f4c05ace');
        $Hoogwoud = new Calendar();
        $Hoogwoud->setName('Calendar Hoogwoud');
        $Hoogwoud->setDescription('Calendar voor begraafplaats Hoogwoud in gemeente Opmeer');
        $Hoogwoud->setTimeZone('CET');
        $manager->persist($Hoogwoud);
        $Hoogwoud->setId($id);
        $manager->persist($Hoogwoud);
        $manager->flush();
        $Hoogwoud = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Calendar De Weere
        $id = Uuid::fromString('2e9e5014-73d7-483b-b21f-1c3f51250ce4');
        $DeWeere = new Calendar();
        $DeWeere->setName('Calendar De Weere');
        $DeWeere->setDescription('Calendar voor begraafplaats De Weere in gemeente Opmeer');
        $DeWeere->setTimeZone('CET');
        $manager->persist($DeWeere);
        $DeWeere->setId($id);
        $manager->persist($DeWeere);
        $manager->flush();
        $DeWeere = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        // Events voor Calendar Wognum (Kreekland)
        // TestEvent 1
        $id = Uuid::fromString('1e7e181c-6f9c-4937-8f9b-2ea35e4e7d75');
        $TestEvent1 = new Event();
        $TestEvent1->setName('10:00-12:00, 2020-06-22');
        $TestEvent1->setDescription('Event 10:00-12:00, 2020-06-22 voor calendar Wognum (Kreekland)');
        $TestEvent1->setStartDate(new \DateTime('2020-06-22T10:00:00+00:00'));
        $TestEvent1->setEndDate(new \DateTime('2020-06-22T12:00:00+00:00'));
        $TestEvent1->setCalendar($WognumKreekland);
        $manager->persist($TestEvent1);
        $TestEvent1->setId($id);
        $manager->persist($TestEvent1);
        $manager->flush();
        $TestEvent1 = $manager->getRepository('App:Event')->findOneBy(['id'=> $id]);

        // TestEvent 2
        $id = Uuid::fromString('262ee715-3d82-4c15-a2a8-5da2627ccb92');
        $TestEvent2 = new Event();
        $TestEvent2->setName('14:30-16:30, 2020-06-22');
        $TestEvent2->setDescription('Event 14:30-16:30, 2020-06-22 voor calendar Wognum (Kreekland)');
        $TestEvent2->setStartDate(new \DateTime('2020-06-22T14:30:00+00:00'));
        $TestEvent2->setEndDate(new \DateTime('2020-06-22T16:30:00+00:00'));
        $TestEvent2->setCalendar($WognumKreekland);
        $manager->persist($TestEvent2);
        $TestEvent2->setId($id);
        $manager->persist($TestEvent2);
        $manager->flush();
        $TestEvent2 = $manager->getRepository('App:Event')->findOneBy(['id'=> $id]);

        // TestEvent 3
        $id = Uuid::fromString('29bcef2e-0f0b-487a-a7bb-09ee2114c630');
        $TestEvent3 = new Event();
        $TestEvent3->setName('14:30-16:30, 2020-06-25');
        $TestEvent3->setDescription('Event 14:30-16:30, 2020-06-25 voor calendar Wognum (Kreekland)');
        $TestEvent3->setStartDate(new \DateTime('2020-06-25T14:30:00+00:00'));
        $TestEvent3->setEndDate(new \DateTime('2020-06-25T16:30:00+00:00'));
        $TestEvent3->setCalendar($WognumKreekland);
        $manager->persist($TestEvent3);
        $TestEvent3->setId($id);
        $manager->persist($TestEvent3);
        $manager->flush();
        $TestEvent3 = $manager->getRepository('App:Event')->findOneBy(['id'=> $id]);

        // TestEvent 4
        $id = Uuid::fromString('d105897c-6dee-41b3-9424-c5fe538c967f');
        $TestEvent4 = new Event();
        $TestEvent4->setName('20:00-22:00, 2020-06-30');
        $TestEvent4->setDescription('Event 20:00-22:00, 2020-06-30 voor calendar Wognum (Kreekland)');
        $TestEvent4->setStartDate(new \DateTime('2020-06-30T20:00:00+00:00'));
        $TestEvent4->setEndDate(new \DateTime('2020-06-30T22:00:00+00:00'));
        $TestEvent4->setCalendar($WognumKreekland);
        $manager->persist($TestEvent4);
        $TestEvent4->setId($id);
        $manager->persist($TestEvent4);
        $manager->flush();
        $TestEvent4 = $manager->getRepository('App:Event')->findOneBy(['id'=> $id]);

        // TestEvent 5
        $id = Uuid::fromString('4b2957d6-2a9a-4d0c-bbd1-80733d9c21c5');
        $TestEvent5 = new Event();
        $TestEvent5->setName('11:00-13:00, 2020-07-03');
        $TestEvent5->setDescription('Event 11:00-13:00, 2020-07-03 voor calendar Wognum (Kreekland)');
        $TestEvent5->setStartDate(new \DateTime('2020-07-03T11:00:00+00:00'));
        $TestEvent5->setEndDate(new \DateTime('2020-07-03T13:00:00+00:00'));
        $TestEvent5->setCalendar($WognumKreekland);
        $manager->persist($TestEvent5);
        $TestEvent5->setId($id);
        $manager->persist($TestEvent5);
        $manager->flush();
        $TestEvent5 = $manager->getRepository('App:Event')->findOneBy(['id'=> $id]);

        // TestEvent 6
        $id = Uuid::fromString('9c7b8b48-2b62-49b9-86d1-056c2128d873');
        $TestEvent6 = new Event();
        $TestEvent6->setName('20:00-22:00, 2020-07-03');
        $TestEvent6->setDescription('Event 20:00-22:00, 2020-07-03 voor calendar Wognum (Kreekland)');
        $TestEvent6->setStartDate(new \DateTime('2020-07-03T20:00:00+00:00'));
        $TestEvent6->setEndDate(new \DateTime('2020-07-03T22:00:00+00:00'));
        $TestEvent6->setCalendar($WognumKreekland);
        $manager->persist($TestEvent6);
        $TestEvent6->setId($id);
        $manager->persist($TestEvent6);
        $manager->flush();
        $TestEvent6 = $manager->getRepository('App:Event')->findOneBy(['id'=> $id]);

        $manager->flush();

        // TestEvent 7
        $id = Uuid::fromString('8abfbd9a-6e9d-4c7d-986a-2bf5ad66f7f8');
        $TestEvent7 = new Event();
        $TestEvent7->setName('15:00-17:00, 2020-07-08');
        $TestEvent7->setDescription('Event 15:00-17:00, 2020-07-08 voor calendar Wognum (Kreekland)');
        $TestEvent7->setStartDate(new \DateTime('2020-07-08T15:00:00+00:00'));
        $TestEvent7->setEndDate(new \DateTime('2020-07-08T17:00:00+00:00'));
        $TestEvent7->setCalendar($WognumKreekland);
        $manager->persist($TestEvent7);
        $TestEvent7->setId($id);
        $manager->persist($TestEvent7);
        $manager->flush();
        $TestEvent7 = $manager->getRepository('App:Event')->findOneBy(['id'=> $id]);

        // TestEvent 8
        $id = Uuid::fromString('6499cbee-8ba1-4edd-9454-d1da38f47230');
        $TestEvent8 = new Event();
        $TestEvent8->setName('20:00-22:00, 2020-07-08');
        $TestEvent8->setDescription('Event 20:00-22:00, 2020-07-08 voor calendar Wognum (Kreekland)');
        $TestEvent8->setStartDate(new \DateTime('2020-07-08T20:00:00+00:00'));
        $TestEvent8->setEndDate(new \DateTime('2020-07-08T22:00:00+00:00'));
        $TestEvent8->setCalendar($WognumKreekland);
        $manager->persist($TestEvent8);
        $TestEvent8->setId($id);
        $manager->persist($TestEvent8);
        $manager->flush();
        $TestEvent8 = $manager->getRepository('App:Event')->findOneBy(['id'=> $id]);

        // TestEvent 9
        $id = Uuid::fromString('1eabf64a-da1c-4e2e-a68e-127bd22a7205');
        $TestEvent9 = new Event();
        $TestEvent9->setName('18:00-20:00, 2020-07-11');
        $TestEvent9->setDescription('Event 18:00-20:00, 2020-07-11 voor calendar Wognum (Kreekland)');
        $TestEvent9->setStartDate(new \DateTime('2020-07-11T18:00:00+00:00'));
        $TestEvent9->setEndDate(new \DateTime('2020-07-11T20:00:00+00:00'));
        $TestEvent9->setCalendar($WognumKreekland);
        $manager->persist($TestEvent9);
        $TestEvent9->setId($id);
        $manager->persist($TestEvent9);
        $manager->flush();
        $TestEvent9 = $manager->getRepository('App:Event')->findOneBy(['id'=> $id]);

        // TestEvent 10
        $id = Uuid::fromString('ce8cc6a2-5914-4955-92d7-f48be036e55b');
        $TestEvent10 = new Event();
        $TestEvent10->setName('20:00-22:00, 2020-07-14');
        $TestEvent10->setDescription('Event 20:00-22:00, 2020-07-14 voor calendar Wognum (Kreekland)');
        $TestEvent10->setStartDate(new \DateTime('2020-07-14T20:00:00+00:00'));
        $TestEvent10->setEndDate(new \DateTime('2020-07-14T22:00:00+00:00'));
        $TestEvent10->setCalendar($WognumKreekland);
        $manager->persist($TestEvent10);
        $TestEvent10->setId($id);
        $manager->persist($TestEvent10);
        $manager->flush();
        $TestEvent10 = $manager->getRepository('App:Event')->findOneBy(['id'=> $id]);

        // TestEvent 11
        $id = Uuid::fromString('7fa0925e-3fd7-47e5-996e-bd097768a56c');
        $TestEvent11 = new Event();
        $TestEvent11->setName('15:00-17:00, 2020-07-17');
        $TestEvent11->setDescription('Event 15:00-17:00, 2020-07-17 voor calendar Wognum (Kreekland)');
        $TestEvent11->setStartDate(new \DateTime('2020-07-17T15:00:00+00:00'));
        $TestEvent11->setEndDate(new \DateTime('2020-07-17T17:00:00+00:00'));
        $TestEvent11->setCalendar($WognumKreekland);
        $manager->persist($TestEvent11);
        $TestEvent11->setId($id);
        $manager->persist($TestEvent11);
        $manager->flush();
        $TestEvent11 = $manager->getRepository('App:Event')->findOneBy(['id'=> $id]);

        // TestEvent 12
        $id = Uuid::fromString('0131c5c6-3585-45e8-8726-46ea5d39aab1');
        $TestEvent12 = new Event();
        $TestEvent12->setName('11:00-13:00, 2020-07-23');
        $TestEvent12->setDescription('Event 11:00-13:00, 2020-07-23 voor calendar Wognum (Kreekland)');
        $TestEvent12->setStartDate(new \DateTime('2020-07-23T11:00:00+00:00'));
        $TestEvent12->setEndDate(new \DateTime('2020-07-23T13:00:00+00:00'));
        $TestEvent12->setCalendar($WognumKreekland);
        $manager->persist($TestEvent12);
        $TestEvent12->setId($id);
        $manager->persist($TestEvent12);
        $manager->flush();
        $TestEvent12 = $manager->getRepository('App:Event')->findOneBy(['id'=> $id]);

        // TestEvent 13
        $id = Uuid::fromString('ae623e0e-ba0e-48d6-9979-251f45b72c82');
        $TestEvent13 = new Event();
        $TestEvent13->setName('11:00-13:00, 2020-07-27');
        $TestEvent13->setDescription('Event 11:00-13:00, 2020-07-27 voor calendar Wognum (Kreekland)');
        $TestEvent13->setStartDate(new \DateTime('2020-07-27T11:00:00+00:00'));
        $TestEvent13->setEndDate(new \DateTime('2020-07-27T13:00:00+00:00'));
        $TestEvent13->setCalendar($WognumKreekland);
        $manager->persist($TestEvent13);
        $TestEvent13->setId($id);
        $manager->persist($TestEvent13);
        $manager->flush();
        $TestEvent13 = $manager->getRepository('App:Event')->findOneBy(['id'=> $id]);

        // TestEvent 14
        $id = Uuid::fromString('2f359508-fea9-45de-a02e-599df8b59d8b');
        $TestEvent14 = new Event();
        $TestEvent14->setName('20:00-22:00, 2020-07-30');
        $TestEvent14->setDescription('Event 20:00-22:00, 2020-07-30 voor calendar Wognum (Kreekland)');
        $TestEvent14->setStartDate(new \DateTime('2020-07-30T20:00:00+00:00'));
        $TestEvent14->setEndDate(new \DateTime('2020-07-30T22:00:00+00:00'));
        $TestEvent14->setCalendar($WognumKreekland);
        $manager->persist($TestEvent14);
        $TestEvent14->setId($id);
        $manager->persist($TestEvent14);
        $manager->flush();
        $TestEvent14 = $manager->getRepository('App:Event')->findOneBy(['id'=> $id]);

        $manager->flush();
    }
}
