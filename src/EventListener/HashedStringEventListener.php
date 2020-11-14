<?php


namespace App\EventListener;


use App\Event\HashedStringEvent;
use App\Services\LoggerService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class HashedStringEventListener
 * @package App\EventListener
 */
class HashedStringEventListener implements EventSubscriberInterface
{
    /**
     * @var LoggerService
     */
    protected $loggerService;

    /**
     * HashedStringEventListener constructor.
     * @param LoggerService $loggerService
     */
    public function __construct(LoggerService $loggerService)
    {
        $this->loggerService = $loggerService;
    }

    /**
     * @param HashedStringEvent $event
     */
    public function onHashedString(HashedStringEvent $event)
    {
        $this->loggerService->log($event->getInputString(), $event->getResult());
    }

    /**
     * @return string[]
     */
    public static function getSubscribedEvents()
    {
        return [
            HashedStringEvent::NAME => 'onHashedString',
        ];
    }
}