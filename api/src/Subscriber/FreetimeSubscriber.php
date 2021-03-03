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

        foreach ($needed as $requirement) {
            if ($requirement == 'type' && $post[$requirement] != 'FREE' && $post[$requirement] != 'BUSY') {
                throw new BadRequestHttpException('Given type is not FREE or BUSY');
            }
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

        foreach ($freebusies as $freebusy) {
            if ($freebusy->getFreebusy() == 'FREE') {
                if (strtotime($freebusy->getStartDate()) => strtotime($post['startDate'])) {

                }
            } elseif ($freebusy->getFreebusy() == 'BUSY') {

            }
        }


        $responseData = $calendar;

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
}
