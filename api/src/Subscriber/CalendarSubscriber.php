<?php

namespace App\Subscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\AuditTrail;
use App\Entity\Event;
use App\Entity\Journal;
use App\Entity\Todo;
use App\Service\CalendarService;
use App\Service\NLXLogService;
use Doctrine\DBAL\Schema\View;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;

class CalendarSubscriber implements EventSubscriberInterface
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
            KernelEvents::VIEW => ['Calendar', EventPriorities::PRE_SERIALIZE],
        ];
    }

    public function Calendar(ViewEvent $event)
    {
        $method = $event->getRequest()->getMethod();
        $route = $event->getRequest()->attributes->get('_route');
        $result = $event->getControllerResult();

        // Only do somthing if we are on te log route and the entity is logable
        if ($method != 'POST' && $method != 'PUT') {
            return;
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
                $contentType = 'application/json';
                $renderType = 'json';
        }

       if($result instanceof Event){
           $this->calendarService->updateEvent($result, $method, $this->em);
       }
       if($result instanceof Todo){
           $this->calendarService->updateTodo($result, $method, $this->em);
       }
       if($result instanceof Journal){
           $this->calendarService->updateJournal($result, $method, $this->em);
       }


        $response = $this->serializer->serialize(
            $result,
            $renderType,
            ['enable_max_depth'=> true]
        );
       if($method == 'PUT'){
           $status = Response::HTTP_OK;
       }else{
           $status = Response::HTTP_CREATED;
       }

        // Creating a response
        $response = new Response(
            $response,
            $status,
            ['content-type' => $contentType]
        );

        $event->setResponse($response);
    }
}
