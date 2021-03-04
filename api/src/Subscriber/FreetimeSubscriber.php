<?php

namespace App\Subscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Calendar;
use App\Entity\Schedule;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\Date;

class FreetimeSubscriber implements EventSubscriberInterface
{
    private $params;
    private $em;
    private $serializer;
    private $client;
    private $commonGroundService;

    public function __construct(
        ParameterBagInterface $params,
        EntityManagerInterface $em,
        SerializerInterface $serializer,
        CommonGroundService $commonGroundService
    )
    {
        $this->params = $params;
        $this->em = $em;
        $this->serializer = $serializer;
        $this->client = new Client();
        $this->commonGroundService = $commonGroundService;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => ['calendar', EventPriorities::PRE_DESERIALIZE],
        ];
    }

    public function calendar(RequestEvent $event)
    {
        $method = $event->getRequest()->getMethod();
        $route = $event->getRequest()->attributes->get('_route');

        $post = json_decode($event->getRequest()->getContent(), true);

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
                $contentType = 'application/json';
                $renderType = 'json';
        }

        if ($method != 'POST' || ($route != 'api_calendars_post_freeorbusy_collection' || $post == null)) {
            return;
        }

        $needed = [
            'calendarId',
            'type'
        ];

        if (isset($post['type']) && $post['type'] != 'FREE' && $post['type'] != 'BUSY') {
            throw new BadRequestHttpException('Given type is not FREE or BUSY');
        }
        if (isset($post['startDate']) && $this->validateDate($post['startDate']) != true || isset($post['endDate']) && $this->validateDate($post['endDate']) != true) {
            throw new BadRequestHttpException('Given dates are not recognized as PHP DateTime objects');
        }
        foreach ($needed as $requirement) {
            if (!array_key_exists($requirement, $post) || $post[$requirement] == null) {
                throw new BadRequestHttpException(sprintf('Compulsory property "%s" is not defined', $requirement));
            }
        }

        if (isset($post['person'])) {
            $calendar = $this->em->getRepository(Calendar::class)->findBy(
                ['person' => $post['person']]);
            if (!isset($calendar)) {
                throw new BadRequestHttpException('Given person has no calendar');
            }
        } else {
            $calendar = $this->em->getRepository(Calendar::class)->find($post['calendarId']);
        }

        $calendar = $this->em->getRepository(Calendar::class)->find($post['calendarId']);
        $freebusies = $calendar->getFreebusies();


        $timeBlocks = [];
        foreach ($freebusies as $freebusy) {
            if ($post['type'] == 'FREE' && $freebusy->getFreebusy() == 'FREE') {

                // Add freebusy period as timeblock to the array
                if (isset($post['startDate'])) {
                    if (strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s')) >= strtotime($post['startDate'])) {

                        // If enddate of freebusy is later than the given enddate, set the timeblock enddate to that of the given enddate
                        if ($freebusy->getEndDate() > $post['endDate']) {
                            $timeBlocks[] = ['startDate' => $freebusy->getStartDate(), 'endDate' => $post['endDate']];
                        } else {
                            $timeBlocks[] = ['startDate' => $freebusy->getStartDate(), 'endDate' => $freebusy->getEndDate()];
                        }

                        // Check for schedule and make more timeBlocks
                        if ($freebusy->getSchedule() != null) {
                            $schedule = $freebusy->getSchedule();
                            $monthFreebusyStartDate = (int)date("m", strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s')));
                            $weekFreebusyStartDate = (int)$freebusy->getStartDate()->format("W");
                            $dayFreebusyStartDate = $this->dayOfWeekToNumber(date('l', strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));


                            if ($schedule->getDaysPerWeek() != null) {
                                foreach ($schedule->getDaysPerWeek() as $day) {
                                    if ($day > $dayFreebusyStartDate) {
                                        $daysToIncrement = $day - $dayFreebusyStartDate;
                                        $newTimeBlockStartDate = date('Y-m-d H:i:s', strtotime("+" . $daysToIncrement . " day", strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));
                                        $newTimeBlockEndDate = date('Y-m-d H:i:s', strtotime($newTimeBlockStartDate) + (strtotime($freebusy->getEndDate()->format('Y-m-d H:i:s')) - strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));

                                        // Check if newTimeBlockStartDate is in the monthsPerYear of this Schedule if defined
                                        if ($schedule->getMonthsPerYear() != null) {
                                            $monthNewTimeBlockStartDate = (int)date("m", strtotime($newTimeBlockStartDate));
                                            if (in_array($monthNewTimeBlockStartDate, $schedule->getMonthsPerYear())) {

                                                // Check if newTimeBlockStartDate is in the weeksPerYear of this Schedule if defined
                                                if ($schedule->getWeeksPerYear() != null) {
                                                    $weekNewTimeBlockStartDate = (int)date("w", strtotime($newTimeBlockStartDate));
                                                    if (in_array($weekNewTimeBlockStartDate, $schedule->getWeeksPerYear())) {
                                                        $timeBlocks[] = ['startDate' => $newTimeBlockStartDate, 'endDate' => $newTimeBlockEndDate];
                                                    }
                                                } else {
                                                    $timeBlocks[] = ['startDate' => $newTimeBlockStartDate, 'endDate' => $newTimeBlockEndDate];
                                                }
                                            }
                                        } elseif ($schedule->getWeeksPerYear() != null) {
                                            $weekNewTimeBlockStartDate = (int)date("w", strtotime($newTimeBlockStartDate));
                                            if (in_array($weekNewTimeBlockStartDate, $schedule->getWeeksPerYear())) {
                                                $timeBlocks[] = ['startDate' => $newTimeBlockStartDate, 'endDate' => $newTimeBlockEndDate];
                                            }
                                        }
                                    }
                                }
                            } // else get all freebusies/schedule timesBlocks
                        }
                    }
                }
            } elseif ($post['type'] == 'BUSY' && $freebusy->getFreebusy() == 'BUSY') {

            }
        }


        $responseData = $timeBlocks;

        $json = $this->serializer->serialize(
            $responseData,
            $renderType,
            ['enable_max_depth' => true]
        );

        // Creating a response
        $response = new Response(
            $json,
            Response::HTTP_CREATED,
            ['content-type' => $contentType]
        );
        $event->setResponse($response);

        return $calendar;
    }

    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    function dayOfWeekToNumber($day)
    {
        switch ($day) {
            case 'Monday':
                $day = 1;
                break;
            case 'Tuesday':
                $day = 2;
                break;
            case 'Wednesday':
                $day = 3;
                break;
            case 'Thursday':
                $day = 4;
                break;
            case 'Friday':
                $day = 5;
                break;
            case 'Saturday':
                $day = 6;
                break;
            case 'Sunday':
                $day = 7;
                break;
        }
        return $day;
    }
}
