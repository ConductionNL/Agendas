<?php

namespace App\Subscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Calendar;
use App\Entity\Event;
use App\Entity\Freebusy;
use App\Entity\Journal;
use App\Entity\Schedule;
use App\Entity\Todo;
use App\Entity\User;
use App\Service\CalendarService;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Conduction\CommonGroundBundle\Service\NLXLogService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;

class ResourceSubscriber implements EventSubscriberInterface
{
    private ParameterBagInterface $params;
    private EntityManagerInterface $em;
    private SerializerInterface $serializer;
    private NLXLogService $nlxLogService;
    private CommonGroundService $commonGroundService;

    public function __construct(ParameterBagInterface $params, EntityManagerInterface $em, SerializerInterface $serializer, NLXLogService $nlxLogService, CommonGroundService $commonGroundService)
    {
        $this->params = $params;
        $this->em = $em;
        $this->serializer = $serializer;
        $this->nlxLogService = $nlxLogService;
        $this->commonGroundService = $commonGroundService;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['Resource', EventPriorities::PRE_VALIDATE],
        ];
    }

    public function Resource(ViewEvent $event)
    {
        $method = $event->getRequest()->getMethod();
        $route = $event->getRequest()->attributes->get('_route');
        $result = $event->getControllerResult();

        // Only do somthing if we are on te log route and the entity is logable
        if ($method != 'POST') {
            return;
        }

        if ($result instanceof Schedule
            || $result instanceof Event
            || $result instanceof Freebusy
            || $result instanceof Journal
            || $result instanceof Todo) {


            if ($result->getCalendar() == null && $result->getResource() != null) {
                if ($calendar = $this->em->getRepository(Calendar::class)->findOneBy(['resource' => $result->getResource()])) {

                    $result->setCalendar($calendar);
                } else {

                    $calendar = new Calendar();
                    $calendar->setName('calendar for'. $result->getName());
                    $calendar->setDescription('calendar for'. $result->getName());
                    $calendar->setTimeZone('CET');
                    $calendar->setResource($result->getResource());

                    $result->setCalendar($calendar);
                }
            }

        }

        return $result;
    }
}
