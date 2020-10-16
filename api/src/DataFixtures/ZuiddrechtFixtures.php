<?php

namespace App\DataFixtures;

use App\Entity\Calendar;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ZuiddrechtFixtures extends Fixture
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
            $this->params->get('app_domain') != 'zuiddrecht.nl' && strpos($this->params->get('app_domain'), 'zuiddrecht.nl') == false &&
            $this->params->get('app_domain') != 'zuid-drecht.nl' && strpos($this->params->get('app_domain'), 'zuid-drecht.nl') == false
        ) {
            return false;
        }

        // Algemene Begraafplaats
        $id = Uuid::fromString('e46e6b3e-9b3a-4339-9d69-874d8dd6bc44');
        $calendar = new Calendar();
        $calendar->setName('Algemene Begraafplaats');
        $calendar->setDescription('Calendar voor Algemene Begraafplaats');
        $calendar->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591']));
        $calendar->setResource($this->commonGroundService->cleanUrl(['component'=>'grc', 'type'=>'cemeteries', 'id'=>'5ff4e420-f5bc-4296-b02c-bf5b42215987']));
        $calendar->setTimeZone('CET');
        $manager->persist($calendar);
        $calendar->setId($id);
        $manager->persist($calendar);
        $manager->flush();
        $calendar = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        //Nieuwe gemeentelijke begraafplaats
        $id = Uuid::fromString('7fd885e9-f274-4e55-9167-66167f70d474');
        $calendar = new Calendar();
        $calendar->setName('Nieuwe gemeentelijke begraafplaats');
        $calendar->setDescription('Calendar voor Nieuwe gemeentelijke begraafplaats');
        $calendar->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'4d1eded3-fbdf-438f-9536-8747dd8ab591']));
        $calendar->setResource($this->commonGroundService->cleanUrl(['component'=>'grc', 'type'=>'cemeteries', 'id'=>'f1d81883-4c48-4ce6-8f43-482ba0a7226e']));
        $calendar->setTimeZone('CET');
        $manager->persist($calendar);
        $calendar->setId($id);
        $manager->persist($calendar);
        $manager->flush();
        $calendar = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);
    }
}
