<?php

namespace Jenko\House\Event;

use Jenko\House\Logger\LoggerInterface;
use Jenko\House\Adapter\SymfonyEventSubscriberAdapter;

class EnteredRoomSubscriber extends SymfonyEventSubscriberAdapter implements EventSubscriberInterface
{
    /**
     * Log level info
     */
    const INFO = 200;

    /**
     * @var LoggerInterface $logger
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(EnteredRoomEvent::NAME => 'onRoomEntered');
    }

    /**
     * @param EnteredRoomEvent $event
     */
    public function onRoomEntered(EnteredRoomEvent $event)
    {
        $this->logger->log(self::INFO, 'Entered the room ' . $event->roomName);
    }
}
