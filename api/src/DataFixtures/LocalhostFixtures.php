<?php

namespace App\DataFixtures;

use App\Entity\Calendar;
use App\Entity\Freebusy;
use App\Entity\Schedule;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class LocalhostFixtures extends Fixture
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
            $this->params->get('app_domain') != 'localhost' && strpos($this->params->get('app_domain'), 'localhost') == false
        ) {
            return false;
        }

        $id = Uuid::fromString('ad7ac04d-42f9-4430-8d28-491f68ad4548');
        $calendar = new Calendar();
        $calendar->setName('Test calendar');
        $calendar->setDescription('Test calendar');
        $calendar->setTimeZone('CET');
        $manager->persist($calendar);
        $calendar->setId($id);
        $manager->persist($calendar);
        $manager->flush();
        $calendar = $manager->getRepository('App:Calendar')->findOneBy(['id'=> $id]);

        $fb = new Freebusy();
        $fb->setDescription('Test freebusy');
        $fb->setStartDate(new \DateTime('3-3-2021 09:30:00'));
        $fb->setEndDate(new \DateTime('14-3-2021 15:30:00'));
        $fb->setFreebusy('FREE');
        $fb->setCalendar($calendar);
        $manager->persist($fb);
        $manager->flush();

        $schedule = new Schedule();
        $schedule->setName('Schedule for test free/busy');
//        $schedule->setDaysPerWeek([1,2,3,4,5]);
//        $schedule->setWeeksPerYear([1,2,3,4,5,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,40,41,42,43,44]);
        $schedule->setMonthsPerYear([1,2,3,4,10,11,12]);
        $schedule->setRepeatTill(new \DateTime('1-1-2022'));
        $schedule->addFreebusy($fb);
        $manager->persist($fb);
        $manager->flush();

    }
}
