<?php

namespace App\DataFixtures;

use App\Entity\Calendar;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class IdVaultFixtures extends Fixture
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
            $this->params->get('app_domain') != 'id-vault.com' && strpos($this->params->get('app_domain'), 'checking.nu') == false
        ) {
            return false;
        }

        $calendar = new Calendar();
        $calendar->setName('calendar for jan willem');
        $calendar->setResource($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'people', 'id'=>'499aedcd-5bfe-4718-a785-7d0a1764eb0b']));
        $calendar->setTimeZone('CET');
        $manager->persist($calendar);
        $manager->flush();

        $calendar = new Calendar();
        $calendar->setName('calendar for gino kok');
        $calendar->setResource($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'people', 'id'=>'543d52ea-86dc-429b-bb96-2a9e7b90ada3']));
        $calendar->setTimeZone('CET');
        $manager->persist($calendar);
        $manager->flush();

        $calendar = new Calendar();
        $calendar->setName('calendar for ruben van der linde');
        $calendar->setResource($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'people', 'id'=>'ce49a652-4b0b-4aa7-98a7-ff4a0cc9e33d']));
        $calendar->setTimeZone('CET');
        $manager->persist($calendar);
        $manager->flush();

        $calendar = new Calendar();
        $calendar->setName('calendar for matthias oliveiro');
        $calendar->setResource($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'people', 'id'=>'8b97830b-b119-4b58-afcc-f4fe37a1abf8']));
        $calendar->setTimeZone('CET');
        $manager->persist($calendar);
        $manager->flush();

        $calendar = new Calendar();
        $calendar->setName('calendar for marleen romijn');
        $calendar->setResource($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'people', 'id'=>'d1ad5cec-5cb1-4d0a-ba44-b5363fb7f2f7']));
        $calendar->setTimeZone('CET');
        $manager->persist($calendar);
        $manager->flush();

        $calendar = new Calendar();
        $calendar->setName('calendar for barry brands');
        $calendar->setResource($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'people', 'id'=>'1f0bc496-aee3-42f5-8b36-29b119944918']));
        $calendar->setTimeZone('CET');
        $manager->persist($calendar);
        $manager->flush();

        $calendar = new Calendar();
        $calendar->setName('calendar for robert zondervan');
        $calendar->setResource($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'people', 'id'=>'0f8883ca-9990-4279-9392-50275398adcf']));
        $calendar->setTimeZone('CET');
        $manager->persist($calendar);
        $manager->flush();

        $calendar = new Calendar();
        $calendar->setName('calendar for wilco louwerse');
        $calendar->setResource($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'people', 'id'=>'b2d913f1-9949-4a91-8f6c-e130fc8b243f']));
        $calendar->setTimeZone('CET');
        $manager->persist($calendar);
        $manager->flush();

        $calendar = new Calendar();
        $calendar->setName('calendar for yorick groeneveld');
        $calendar->setResource($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'people', 'id'=>'5e619ed6-3c44-45af-928b-660a3f75be6b']));
        $calendar->setTimeZone('CET');
        $manager->persist($calendar);
        $manager->flush();
    }
}
