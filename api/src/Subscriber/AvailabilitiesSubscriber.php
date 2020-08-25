<?php

namespace App\Subscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Availability;
use App\Entity\Calendar;
use App\Service\CalendarService;
use Conduction\CommonGroundBundle\Service\NLXLogService;
use DateInterval;
use DateTime;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use SensioLabs\Security\Exception\HttpException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;

class AvailabilitiesSubscriber implements EventSubscriberInterface
{
    private $params;
    private $em;
    private $serializer;
    private $nlxLogService;
    private $calendarService;

    public function __construct(ParameterBagInterface $params, EntityManagerInterface $em, SerializerInterface $serializer, NLXLogService $nlxLogService)
    {
        $this->params = $params;
        $this->em = $em;
        $this->serializer = $serializer;
        $this->nlxLogService = $nlxLogService;
        $this->calendarService = new CalendarService();
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['Availability', EventPriorities::PRE_SERIALIZE],
        ];
    }

    public function Availability(ViewEvent $event)
    {
        $method = $event->getRequest()->getMethod();
        $route = $event->getRequest()->attributes->get('_route');
        $result = $event->getControllerResult();

        // Only do somthing if we are on te log route and the entity is loggable
        if ($route != 'api_availabilities_get_collection') {
            return;
        }
        $query = $event->getRequest()->query->all();

        if (!key_exists('duration', $query)) {
            throw new HttpException('Please define a duration!', 400);
        }
        if (!key_exists('startDate', $query)) {
            throw new HttpException('Please define a start date!', 400);
        }
        if (!key_exists('endDate', $query)) {
            throw new HttpException('Please define a end date!', 400);
        }
        if (!key_exists('calendar', $query)) {
            throw new HttpException('Please define a calendar!', 400);
        }

        // Lets get the rest of the data
        $contentType = $event->getRequest()->headers->get('accept');
        if (!$contentType) {
            $contentType = $event->getRequest()->headers->get('Accept');
        }
        switch ($contentType) {
            case 'application/json':
                $renderType = 'json';
                break;
            case 'application/ld+json':
                $renderType = 'jsonld';
                break;
            case 'application/hal+json':
                $renderType = 'jsonhal';
                break;
            default:
                $contentType = 'application/ld+json';
                $renderType = 'json';
        }
        $startDate = new DateTime($query['startDate']);
        $endDate = new DateTime($query['endDate']);
        $duration = new DateInterval($query['duration']);
//        var_dump($duration);
        $calendars = $this->em->getRepository('App:Calendar')->findBy(['id'=>$query['calendar']]);

        $iteratingStartDate = $startDate;
        $availabilities = [];
        while ($iteratingStartDate < $endDate) {
            $availability = new Availability();
            $availability->setStartDate(clone $iteratingStartDate);
            $iteratingEndDate = clone $iteratingStartDate;
            $iteratingEndDate->add($duration);
            $availability->setEndDate(clone $iteratingEndDate);

            $criteria = Criteria::create()
                ->andWhere(Criteria::expr()->gt('endDate', $iteratingStartDate))
                ->andWhere(Criteria::expr()->lt('startDate', $iteratingEndDate));

            $entries = [];

            foreach ($calendars as $calendar) {
                if ($calendar instanceof Calendar) {
                    $entries = array_merge($calendar->getEvents()->matching($criteria)->toArray(), $entries);
                    $entries = array_merge($calendar->getFreebusies()->matching($criteria)->toArray(), $entries);
                }
            }
            if (count($entries) > 0) {
                $availability->setAvailable(false);
            } else {
                $availability->setAvailable(true);
            }
            $this->em->persist($availability);
            $availabilities[] = $availability;
            $iteratingStartDate = $iteratingStartDate->add($duration);
        }

        if (key_exists('showUnavailable', $query) && $query['showUnavailable'] == 'true') {
            $result = $availabilities;
        } else {
            $result = [];
            foreach ($availabilities as $availability) {
                if ($availability->getAvailable()) {
                    $result[] = $availability;
                }
            }
        }

        $response = $this->serializer->serialize(
            $result,
            $renderType,
            ['enable_max_depth'=> true]
        );

        // Creating a response
        $response = new Response(
            $response,
            Response::HTTP_OK,
            ['content-type' => $contentType]
        );

        $event->setResponse($response);
    }
}
