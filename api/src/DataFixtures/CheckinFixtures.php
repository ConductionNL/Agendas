<?php

namespace App\DataFixtures;

use App\Entity\Calendar;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class CheckinFixtures extends Fixture
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
            $this->params->get('app_domain') != 'zuid-drecht.nl' && strpos($this->params->get('app_domain'), 'zuid-drecht.nl') == false &&
            $this->params->get('app_domain') != 'checking.nu' && strpos($this->params->get('app_domain'), 'checking.nu') == false
        ) {
            return false;
        }

        $id = Uuid::fromString('ae0cd3a3-c5e7-4797-94e6-d97a3de94f48');
        $calendar = new Calendar();
        $calendar->setName('champagne room');
        $calendar->setDescription('calender voor de champagne room');
        $calendar->setOrganization($this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'organizations', 'id'=>'62bff497-cb91-443e-9da9-21a0b38cd536']));
        $calendar->setResource($this->commonGroundService->cleanUrl(['component'=>'lc', 'type'=>'accommodations', 'id'=>'9000ffac-662d-4daf-9d26-79757a221a5a']));
        $calendar->setTimeZone('CET');
        $manager->persist($calendar);
        $calendar->setId($id);
        $manager->persist($calendar);
        $manager->flush();
        $calendar = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);
    }
}
