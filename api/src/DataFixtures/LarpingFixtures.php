<?php

namespace App\DataFixtures;

use App\Entity\Calendar;
use App\Entity\Event;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class LarpingFixtures extends Fixture
{
    private ParameterBagInterface $params;
    private CommonGroundService $commonGroundService;

    public function __construct(ParameterBagInterface $params, CommonGroundService $commonGroundService)
    {
        $this->params = $params;
        $this->commonGroundService = $commonGroundService;
    }

    public function load(ObjectManager $manager)
    {
        if (
            !$this->params->get('app_build_all_fixtures') &&
            $this->params->get('app_domain') != 'larping.eu' && strpos($this->params->get('app_domain'), 'larping.') == false
        ) {
            return false;
        }

//        $event = new Event();
//        $event->setName('Moots 1');
//        $event->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'51eb5628-3b37-497b-a57f-6b039ec776e5']));
//        $event->setResource($this->commonGroundService->cleanUrl(['component'=>'pdc', 'type'=>'products', 'id'=>'893e5c2f-4c89-438c-aa62-c0bd4636e858']));
//        $event->setStartDate(new \DateTime('12-09-2020'));
//        $event->setEndDate(new \DateTime('14-09-2020'));
//        $manager->persist($event);
//        $manager->flush();

        $id = Uuid::fromString('e0b3b247-91a9-43a5-afe9-6f624876fb8b');
        $event = new Event();
        $event->setName('Voorjaars ALV');
        $event->setDescription(file_get_contents(dirname(__FILE__).'/eventDescriptions/voorjaars-alv.html.twig', 'r'));
        $event->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'e62b32b5-2d1f-4412-9eb7-225bce414d05']));
        $event->setStartDate(new \DateTime('22-03-2021'));
        $event->setEndDate(new \DateTime('22-03-2021'));
        $event->setStatus('published');
//        $event->setCategories();
        $manager->persist($event);
        $event->setId($id);
        $manager->persist($event);
        $manager->flush();
        $event = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

//        // Algemene Begraafplaats
//        $id = Uuid::fromString('e46e6b3e-9b3a-4339-9d69-874d8dd6bc44');
//        $calendar = new Calendar();
//        $calendar->setName('Algemene Begraafplaats');
//        $calendar->setDescription('Calendar voor Algemene Begraafplaats');
//        $calendar->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591']));
//        $calendar->setResource($this->commonGroundService->cleanUrl(['component'=>'grc', 'type'=>'cemeteries', 'id'=>'5ff4e420-f5bc-4296-b02c-bf5b42215987']));
//        $calendar->setTimeZone('CET');
//        $manager->persist($calendar);
//        $calendar->setId($id);
//        $manager->persist($calendar);
//        $manager->flush();
//        $calendar = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);
//
//        //Nieuwe gemeentelijke begraafplaats
//        $id = Uuid::fromString('7fd885e9-f274-4e55-9167-66167f70d474');
//        $calendar = new Calendar();
//        $calendar->setName('Nieuwe gemeentelijke begraafplaats');
//        $calendar->setDescription('Calendar voor Nieuwe gemeentelijke begraafplaats');
//        $calendar->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591']));
//        $calendar->setResource($this->commonGroundService->cleanUrl(['component'=>'grc', 'type'=>'cemeteries', 'id'=>'f1d81883-4c48-4ce6-8f43-482ba0a7226e']));
//        $calendar->setTimeZone('CET');
//        $manager->persist($calendar);
//        $calendar->setId($id);
//        $manager->persist($calendar);
//        $manager->flush();
//        $calendar = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);
    }
}
