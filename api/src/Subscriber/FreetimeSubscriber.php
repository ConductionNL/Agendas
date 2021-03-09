<?php

namespace App\Subscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Calendar;
use App\Entity\Freebusy;
use App\Entity\Schedule;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ViewEvent;
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
            KernelEvents::VIEW => ['calendar', EventPriorities::PRE_VALIDATE],
        ];
    }

    public function calendar(ViewEvent $event)
    {
        $method = $event->getRequest()->getMethod();
        $route = $event->getRequest()->attributes->get('_route');
        $result = $event->getControllerResult();

//        $post = json_decode($event->getRequest()->getContent(), true);

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

        if ($method != 'GET' || ($route != 'api_calendars_get_availability_item') || !($result instanceof Calendar)) {
            return;
        }

        $calendar = $result;
        if (!$event->getRequest()->query->has('type') || ($event->getRequest()->get('type') != 'FREE' && $event->getRequest()->get('type') != 'BUSY')) {
            throw new BadRequestHttpException('Given type is not FREE or BUSY');
        } else {
            $type = $event->getRequest()->query->get('type');
        }

        if (!$event->getRequest()->query->has('startDate')) {
            throw new BadRequestHttpException('No startDate given or invalid date');
        } else {
            $startDate = $event->getRequest()->query->get('startDate');
        }

        if (!$event->getRequest()->query->has('endDate')) {
            throw new BadRequestHttpException('No endDate given or invalid date');
        } else {
            $endDate = $event->getRequest()->query->get('endDate');
        }

        $freebusies = $calendar->getFreebusies();

        $timeBlocks = [];
        foreach ($freebusies as $freebusy) {
            if ($freebusy->getFreebusy() == $type) {

                // Add freebusy period as timeblock to the array
                if (isset($startDate)) {

                    if (strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s')) >= strtotime($startDate)) {

                        // If enddate of freebusy is later than the given enddate, set the timeblock enddate to that of the given enddate
                        if (strtotime($freebusy->getEndDate()->format('Y-m-d H:i:s')) > strtotime($endDate)) {
                            $timeBlocks[] = ['startDate' => $freebusy->getStartDate()->format('Y-m-d H:i:s'), 'endDate' => $endDate];
                        } else {
                            $timeBlocks[] = ['startDate' => $freebusy->getStartDate()->format('Y-m-d H:i:s'), 'endDate' => $freebusy->getEndDate()->format('Y-m-d H:i:s')];
                        }

                        // Check for schedule and make more timeBlocks
                        if ($freebusy->getSchedule() != null) {
                            $schedule = $freebusy->getSchedule();

                            $monthFreebusyStartDate = (int)date("m", strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s')));
                            $weekFreebusyStartDate = (int)$freebusy->getStartDate()->format("W");
                            $dayFreebusyStartDate = $this->dayOfWeekToNumber(date('l', strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));

                            if ($schedule->getDaysPerWeek() != null) {
                                $timeBlocks = array_merge($timeBlocks, $this->getTimeblocksFromDaySchedule($schedule, $freebusy, $dayFreebusyStartDate, $endDate));

                            } elseif ($schedule->getWeeksPerYear() != null) {
                                $timeBlocks = array_merge($timeBlocks, $this->getTimeblocksFromWeekSchedule($schedule, $freebusy, $weekFreebusyStartDate, $endDate));

                            } elseif ($schedule->getMonthsPerYear() != null) {
                                $timeBlocks = array_merge($timeBlocks, $this->getTimeblocksFromMonthSchedule($schedule, $freebusy, $monthFreebusyStartDate, $endDate));

                            }
                        }
                    }
                }
            }
        }

        $responseData = [
            'description' => 'All '.$type.' timeblocks for calendar '.$calendar->getName().' between '.$startDate.' and '.$endDate,
            'timeBlocks' => $timeBlocks
        ];

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

    function getTimeblocksFromDaySchedule(Schedule $schedule, Freebusy $freebusy, $dayFreebusyStartDate, $endDate)
    {
        $passedFirstWeek = false;
        $totalDaysPassed = 0;

        for ($dayOfWeekCounter = ($dayFreebusyStartDate + 1); ; $dayOfWeekCounter++) {
            $totalDaysPassed++;
            $currentDateOfIteration = date('Y-m-d H:i:s', strtotime("+" . $totalDaysPassed . " day", strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));
            $currentWeekOfIteration = (int)date('W', strtotime($currentDateOfIteration));
            $currentMonthOfIteration = (int)date("m", strtotime($currentDateOfIteration));

            // If we are past the given endDate, break the loop
            if (strtotime($currentDateOfIteration) >= strtotime($endDate)) {
                break;
            }

            // If we are past the repeatTill date of the Schedule, break the loop
            if (strtotime($currentDateOfIteration) >= strtotime($schedule->getRepeatTill()->format('Y-m-d H:i:s'))) {
                break;
            }

            // If we are not in a Month defined in the Schedules monthsPerYear, next iteration
            if ($schedule->getMonthsPerYear() != null && !in_array($currentMonthOfIteration, $schedule->getMonthsPerYear())) {
                // If the counter is Sunday (7) the next iteration needs to be Monday (1)
                if ($dayOfWeekCounter == 7) {
                    $dayOfWeekCounter = 0;

                    //  If dayOfWeekCounter is Sunday (7) passedFirstWeek is true
                    if ($passedFirstWeek !== true) {
                        $passedFirstWeek = true;
                    }
                }
                continue;
            }

            // If we are not in a Week defined in the Schedules weeksPerYear, next iteration
            if ($schedule->getWeeksPerYear() != null && !in_array($currentWeekOfIteration, $schedule->getWeeksPerYear())) {
                // If the counter is Sunday (7) the next iteration needs to be Monday (1)
                if ($dayOfWeekCounter == 7) {
                    $dayOfWeekCounter = 0;

                    //  If dayOfWeekCounter is Sunday (7) passedFirstWeek is true
                    if ($passedFirstWeek !== true) {
                        $passedFirstWeek = true;
                    }
                }
                continue;
            }

            // If the dayOfWeekCounter is in the daysPerWeek of the Schedule we continue
            if (in_array($dayOfWeekCounter, $schedule->getDaysPerWeek())) {

                // Check if it is the first week of the loop
                if ($passedFirstWeek !== true) {
                    if ($dayOfWeekCounter > $dayFreebusyStartDate) {
                        $newTimeBlockStartDate = date('Y-m-d H:i:s', strtotime("+" . $totalDaysPassed . " day", strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));
                        $newTimeBlockEndDate = date('Y-m-d H:i:s', strtotime($newTimeBlockStartDate) + (strtotime($freebusy->getEndDate()->format('Y-m-d H:i:s')) - strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));

                        $timeBlocks[] = ['startDate' => $newTimeBlockStartDate, 'endDate' => $newTimeBlockEndDate];
                    }

                    // Else just add the new timeBlocks
                } else {
                    $newTimeBlockStartDate = date('Y-m-d H:i:s', strtotime("+" . $totalDaysPassed . " day", strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));
                    $newTimeBlockEndDate = date('Y-m-d H:i:s', strtotime($newTimeBlockStartDate) + (strtotime($freebusy->getEndDate()->format('Y-m-d H:i:s')) - strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));

                    $timeBlocks[] = ['startDate' => $newTimeBlockStartDate, 'endDate' => $newTimeBlockEndDate];

                }

            }

            // If the counter is Sunday (7) the next iteration needs to be Monday (1)
            if ($dayOfWeekCounter == 7) {
                $dayOfWeekCounter = 0;

                //  If dayOfWeekCounter is Sunday (7) passedFirstWeek is true
                if ($passedFirstWeek !== true) {
                    $passedFirstWeek = true;
                }
            }
        }

        return $timeBlocks;
    }

    function getTimeblocksFromWeekSchedule(Schedule $schedule, Freebusy $freebusy, $weekFreebusyStartDate, $endDate)
    {
        $passedFirstYear = false;
        $totalWeeksPassed = 0;

        for ($weekOfYearCounter = ($weekFreebusyStartDate + 1); ; $weekOfYearCounter++) {
            $totalWeeksPassed++;
            $currentDateOfIteration = date('Y-m-d H:i:s', strtotime("+" . $totalWeeksPassed . " week", strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));
            $currentWeekOfIteration = (int)date('W', strtotime($currentDateOfIteration));
            $currentMonthOfIteration = (int)date("m", strtotime($currentDateOfIteration));

            // If we are past the given endDate, break the loop
            if (strtotime($currentDateOfIteration) >= strtotime($endDate)) {
                break;
            }

            // If we are past the repeatTill date of the Schedule, break the loop
            if (strtotime($currentDateOfIteration) >= strtotime($schedule->getRepeatTill()->format('Y-m-d H:i:s'))) {
                break;
            }

            // If we are not in a Month defined in the Schedules monthsPerYear, next iteration
            if ($schedule->getMonthsPerYear() != null && !in_array($currentMonthOfIteration, $schedule->getMonthsPerYear())) {
                // If the counter is 52 the next iteration needs to be 0
                if ($weekOfYearCounter == 52) {
                    $weekOfYearCounter = 0;

                    //  If dayOfWeekCounter is Sunday 52 passedFirstYear is true
                    if ($passedFirstYear !== true) {
                        $passedFirstWeek = true;
                    }
                }
                continue;
            }

            // If the dayOfWeekCounter is in the daysPerWeek of the Schedule we continue
            if (in_array($weekOfYearCounter, $schedule->getWeeksPerYear())) {

                // Check if it is the first week of the loop
                if ($passedFirstYear !== true) {
                    if ($weekOfYearCounter > $weekFreebusyStartDate) {
                        $newTimeBlockStartDate = date('Y-m-d H:i:s', strtotime("+" . $totalWeeksPassed . " week", strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));
                        $newTimeBlockEndDate = date('Y-m-d H:i:s', strtotime($newTimeBlockStartDate) + (strtotime($freebusy->getEndDate()->format('Y-m-d H:i:s')) - strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));

                        $timeBlocks[] = ['startDate' => $newTimeBlockStartDate, 'endDate' => $newTimeBlockEndDate];
                    }

                    // Else just add the new timeBlocks
                } else {
                    $newTimeBlockStartDate = date('Y-m-d H:i:s', strtotime("+" . $totalWeeksPassed . " week", strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));
                    $newTimeBlockEndDate = date('Y-m-d H:i:s', strtotime($newTimeBlockStartDate) + (strtotime($freebusy->getEndDate()->format('Y-m-d H:i:s')) - strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));

                    $timeBlocks[] = ['startDate' => $newTimeBlockStartDate, 'endDate' => $newTimeBlockEndDate];

                }

            }

            // If the counter is 52 the next iteration needs to be 0
            if ($weekOfYearCounter == 52) {
                $weekOfYearCounter = 0;

                //  If weekOfYearCounter is 52 passedFirstYear is true
                if ($passedFirstYear !== true) {
                    $passedFirstYear = true;
                }
            }
        }

        return $timeBlocks;
    }

    function getTimeblocksFromMonthSchedule(Schedule $schedule, Freebusy $freebusy, $monthFreebusyStartDate, $endDate)
    {
        $passedFirstYear = false;
        $totalMonthsPassed = 0;

        for ($monthOfYearCounter = ($monthFreebusyStartDate + 1); ; $monthOfYearCounter++) {
            $totalMonthsPassed++;
            $currentDateOfIteration = date('Y-m-d H:i:s', strtotime("+" . $totalMonthsPassed . " month", strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));
            $currentWeekOfIteration = (int)date('W', strtotime($currentDateOfIteration));
            $currentMonthOfIteration = (int)date("m", strtotime($currentDateOfIteration));

            // If we are past the given endDate, break the loop
            if (strtotime($currentDateOfIteration) >= strtotime($endDate)) {
                break;
            }

            // If we are past the repeatTill date of the Schedule, break the loop
            if (strtotime($currentDateOfIteration) >= strtotime($schedule->getRepeatTill()->format('Y-m-d H:i:s'))) {
                break;
            }

            // If the dayOfWeekCounter is in the daysPerWeek of the Schedule we continue
            if (in_array($monthOfYearCounter, $schedule->getMonthsPerYear())) {

                // Check if it is the first week of the loop
                if ($passedFirstYear !== true) {
                    if ($monthOfYearCounter > $monthFreebusyStartDate) {
                        $newTimeBlockStartDate = date('Y-m-d H:i:s', strtotime("+" . $totalMonthsPassed . " month", strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));
                        $newTimeBlockEndDate = date('Y-m-d H:i:s', strtotime($newTimeBlockStartDate) + (strtotime($freebusy->getEndDate()->format('Y-m-d H:i:s')) - strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));

                        $timeBlocks[] = ['startDate' => $newTimeBlockStartDate, 'endDate' => $newTimeBlockEndDate];
                    }

                    // Else just add the new timeBlocks
                } else {
                    $newTimeBlockStartDate = date('Y-m-d H:i:s', strtotime("+" . $totalMonthsPassed . " month", strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));
                    $newTimeBlockEndDate = date('Y-m-d H:i:s', strtotime($newTimeBlockStartDate) + (strtotime($freebusy->getEndDate()->format('Y-m-d H:i:s')) - strtotime($freebusy->getStartDate()->format('Y-m-d H:i:s'))));

                    $timeBlocks[] = ['startDate' => $newTimeBlockStartDate, 'endDate' => $newTimeBlockEndDate];

                }

            }

            // If the counter is 12 the next iteration needs to be 0
            if ($monthOfYearCounter == 12) {
                $monthOfYearCounter = 0;

                //  If monthOfYearCounter is 12 passedFirstYear is true
                if ($passedFirstYear !== true) {
                    $passedFirstYear = true;
                }
            }
        }

        return $timeBlocks;

    }
}
