<?php

namespace App\DataFixtures;

use App\Entity\Calendar;
use App\Entity\Event;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class WestFrieslandFixtures extends Fixture
{
    private $params;
    /**
     * @var CommonGroundService
     */
    private $commonGroundService;

    public function __construct(ParameterBagInterface $params, CommonGroundService $commonGroundService)
    {
        $this->params = $params;
        $this->commonGroundService = $commonGroundService;
    }

    public function load(ObjectManager $manager)
    {
        if (
            !$this->params->get('app_build_all_fixtures') &&
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
        $StreekwegInHoogkarspel->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7033eeb4-5c77-4d88-9f40-303b538f176f']));
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
        $AlgemeneBegraafplaatsRustoord->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7033eeb4-5c77-4d88-9f40-303b538f176f']));
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
        $WesterkerkwegInVenhuizen->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7033eeb4-5c77-4d88-9f40-303b538f176f']));
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
        $SchoollaanInHem->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7033eeb4-5c77-4d88-9f40-303b538f176f']));
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
        $MolenweiInHoogkarspel->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7033eeb4-5c77-4d88-9f40-303b538f176f']));
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
        $RaadhuispleinInHoogkarspel->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7033eeb4-5c77-4d88-9f40-303b538f176f']));
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
        $BegraafplaatsInOosterleek->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7033eeb4-5c77-4d88-9f40-303b538f176f']));
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
        $DorpswegInSchellinkhout->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7033eeb4-5c77-4d88-9f40-303b538f176f']));
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
        $KerkbuurtInWijdenes->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7033eeb4-5c77-4d88-9f40-303b538f176f']));
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
        $GemeentelijkeBegraafplaats->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'7033eeb4-5c77-4d88-9f40-303b538f176f']));
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
        $Zuiderveld->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
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
        $Berkhouterweg->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
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
        $Keern->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
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
        $Zwaag->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'d736013f-ad6d-4885-b816-ce72ac3e1384']));
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
        $AbbekerkNieuw->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $AbbekerkOud->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $BenningbroekNieuw->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $BenningbroekOud->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $Lambertschaag->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $MidwoudNieuw->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $MidwoudOud->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $OostwoudNieuw->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $OostwoudOud->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $OpperdoesNieuw->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $OpperdoesOud->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $SijbekarspelOud->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $TwiskNieuw->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $TwiskOud->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $MedemblikCompagniesingel->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $Nibbixwoud->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $Wognum->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $MedemblikZorgvliet->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $AndijkWesterbegraafplaats->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $AndijkOosterbegraafplaats->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $WognumKreekland->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $KleineZomerdijk->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'429e66ef-4411-4ddb-8b83-c637b37e88b5']));
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
        $Avenhorn->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'f050292c-973d-46ab-97ae-9d8830a59d15']));
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
        $Berkhout->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'f050292c-973d-46ab-97ae-9d8830a59d15']));
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
        $Oudendijk->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'f050292c-973d-46ab-97ae-9d8830a59d15']));
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
        $Grosthuizen->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'f050292c-973d-46ab-97ae-9d8830a59d15']));
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
        $Ursem->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'f050292c-973d-46ab-97ae-9d8830a59d15']));
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
        $Hensbroek->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'f050292c-973d-46ab-97ae-9d8830a59d15']));
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
        $Obdam->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'f050292c-973d-46ab-97ae-9d8830a59d15']));
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
        $Aartswoud->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'16fd1092-c4d3-4011-8998-0e15e13239cf']));
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
        $Spanbroek->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'16fd1092-c4d3-4011-8998-0e15e13239cf']));
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
        $Opmeer->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'16fd1092-c4d3-4011-8998-0e15e13239cf']));
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
        $Hoogwoud->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'16fd1092-c4d3-4011-8998-0e15e13239cf']));
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
        $DeWeere->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'16fd1092-c4d3-4011-8998-0e15e13239cf']));
        $DeWeere->setDescription('Calendar voor begraafplaats De Weere in gemeente Opmeer');
        $DeWeere->setTimeZone('CET');
        $manager->persist($DeWeere);
        $DeWeere->setId($id);
        $manager->persist($DeWeere);
        $manager->flush();
        $DeWeere = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        $manager->flush();

        // Calendar Sauwerd
        $id = Uuid::fromString('945b97e4-8add-4783-8989-f88a793d8229');
        $sauwerd = new Calendar();
        $sauwerd->setName('Calendar Sauwerd');
        $sauwerd->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'79ad319b-1ff6-4e21-919b-4ea002b5f233']));
        $sauwerd->setDescription('Calendar voor begraafplaats Sauwerd in gemeente Hogeland');
        $sauwerd->setTimeZone('CET');
        $manager->persist($sauwerd);
        $sauwerd->setId($id);
        $manager->persist($sauwerd);
        $manager->flush();
        $sauwerd = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        $manager->flush();

        // Calendar Adorp
        $id = Uuid::fromString('5f1abeb9-3d73-484e-839c-d84eed30d448');
        $adorp = new Calendar();
        $adorp->setName('Calendar Sauwerd');
        $adorp->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'79ad319b-1ff6-4e21-919b-4ea002b5f233']));
        $adorp->setDescription('Calendar voor begraafplaats Adorp in gemeente Hogeland');
        $adorp->setTimeZone('CET');
        $manager->persist($adorp);
        $adorp->setId($id);
        $manager->persist($adorp);
        $manager->flush();
        $adorp = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        $manager->flush();

        // Calendar Winsum
        $id = Uuid::fromString('97d49f03-0f95-4db8-b727-a1a77926bbd2');
        $winsum = new Calendar();
        $winsum->setName('Calendar Winsum');
        $winsum->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'79ad319b-1ff6-4e21-919b-4ea002b5f233']));
        $winsum->setDescription('Calendar voor begraafplaats Winsum in gemeente Hogeland');
        $winsum->setTimeZone('CET');
        $manager->persist($winsum);
        $winsum->setId($id);
        $manager->persist($winsum);
        $manager->flush();
        $winsum = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        $manager->flush();

        // Calendar Baflo
        $id = Uuid::fromString('325b1400-3269-4226-af82-2a64bfefd338');
        $baflo = new Calendar();
        $baflo->setName('Calendar Baflo');
        $baflo->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'79ad319b-1ff6-4e21-919b-4ea002b5f233']));
        $baflo->setDescription('Calendar voor begraafplaats Baflo in gemeente Hogeland');
        $baflo->setTimeZone('CET');
        $manager->persist($baflo);
        $baflo->setId($id);
        $manager->persist($baflo);
        $manager->flush();
        $baflo = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        $manager->flush();

        // Calendar Sauwerd-oud
        $id = Uuid::fromString('984e9dcc-9dbc-49d5-8249-6633b87aacd6');
        $sauwerdOud = new Calendar();
        $sauwerdOud->setName('Calendar Sauwerd-oud');
        $sauwerdOud->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'79ad319b-1ff6-4e21-919b-4ea002b5f233']));
        $sauwerdOud->setDescription('Calendar voor begraafplaats Sauwerd-oud in gemeente Hogeland');
        $sauwerdOud->setTimeZone('CET');
        $manager->persist($sauwerdOud);
        $sauwerdOud->setId($id);
        $manager->persist($sauwerdOud);
        $manager->flush();
        $sauwerdOud = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        $manager->flush();

        // Calendar Bedum
        $id = Uuid::fromString('73e47b60-3987-41b5-84dd-9e3eb82d2803');
        $bedum = new Calendar();
        $bedum->setName('Calendar Bedum');
        $bedum->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'79ad319b-1ff6-4e21-919b-4ea002b5f233']));
        $bedum->setDescription('Calendar voor begraafplaats Bedum in gemeente Hogeland');
        $bedum->setTimeZone('CET');
        $manager->persist($bedum);
        $bedum->setId($id);
        $manager->persist($bedum);
        $manager->flush();
        $bedum = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        $manager->flush();

        // Calendar Noordwolde
        $id = Uuid::fromString('b8c87efe-c328-471f-b57d-d593e159fbf3');
        $noordwolde = new Calendar();
        $noordwolde->setName('Calendar Noordwolde');
        $noordwolde->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'79ad319b-1ff6-4e21-919b-4ea002b5f233']));
        $noordwolde->setDescription('Calendar voor begraafplaats Noordwolde in gemeente Hogeland');
        $noordwolde->setTimeZone('CET');
        $manager->persist($noordwolde);
        $noordwolde->setId($id);
        $manager->persist($noordwolde);
        $manager->flush();
        $noordwolde = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        $manager->flush();

        // Calendar Onderdendam
        $id = Uuid::fromString('2a196c44-d5ce-4da0-aafb-1850151316d4');
        $onderdendam = new Calendar();
        $onderdendam->setName('Calendar Onderdendam');
        $onderdendam->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'79ad319b-1ff6-4e21-919b-4ea002b5f233']));
        $onderdendam->setDescription('Calendar voor begraafplaats Onderdendam in gemeente Hogeland');
        $onderdendam->setTimeZone('CET');
        $manager->persist($onderdendam);
        $onderdendam->setId($id);
        $manager->persist($onderdendam);
        $manager->flush();
        $onderdendam = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        $manager->flush();

        // Calendar Westerdijkshorn
        $id = Uuid::fromString('baf2b782-47f8-44c9-af38-efa599a4b5de');
        $westerdijkshorn = new Calendar();
        $westerdijkshorn->setName('Calendar Westerdijkshorn');
        $westerdijkshorn->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'79ad319b-1ff6-4e21-919b-4ea002b5f233']));
        $westerdijkshorn->setDescription('Calendar voor begraafplaats Westerdijkshorn in gemeente Hogeland');
        $westerdijkshorn->setTimeZone('CET');
        $manager->persist($westerdijkshorn);
        $westerdijkshorn->setId($id);
        $manager->persist($westerdijkshorn);
        $manager->flush();
        $westerdijkshorn = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        $manager->flush();

        // Calendar Zuidwolde
        $id = Uuid::fromString('694e33a7-418c-4bbe-aa5c-03b8b44169d0');
        $zuidwolde = new Calendar();
        $zuidwolde->setName('Calendar Zuidwolde');
        $zuidwolde->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'79ad319b-1ff6-4e21-919b-4ea002b5f233']));
        $zuidwolde->setDescription('Calendar voor begraafplaats Zuidwolde in gemeente Hogeland');
        $zuidwolde->setTimeZone('CET');
        $manager->persist($zuidwolde);
        $zuidwolde->setId($id);
        $manager->persist($zuidwolde);
        $manager->flush();
        $zuidwolde = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        $manager->flush();

        // Calendar J.A.J.H. Nienhuis
        $id = Uuid::fromString('4ba7ea93-8fe2-4520-8fcd-a221c4b201ee');
        $nienhuis = new Calendar();
        $nienhuis->setName('Calendar J.A.J.H. Nienhuis');
        $nienhuis->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'79ad319b-1ff6-4e21-919b-4ea002b5f233']));
        $nienhuis->setDescription('Calendar voor begraafplaats J.A.J.H. Nienhuis in gemeente Hogeland');
        $nienhuis->setTimeZone('CET');
        $manager->persist($nienhuis);
        $nienhuis->setId($id);
        $manager->persist($nienhuis);
        $manager->flush();
        $nienhuis = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        $manager->flush();
    }
}
