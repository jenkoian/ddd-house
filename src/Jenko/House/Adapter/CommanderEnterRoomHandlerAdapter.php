<?php

namespace Jenko\House\Adapter;

use Jenko\House\Handler\CommandHandlerInterface;
use Tabbi89\CommanderBundle\Command\CommandHandlerInterface as ThirdPartyCommandHandlerInterface;

class CommanderEnterRoomHandlerAdapter implements CommandHandlerInterface, ThirdPartyCommandHandlerInterface
{
    /**
     * @var CommandHandlerInterface
     */
    private $handler;

    /**
     * @param CommandHandlerInterface $handler
     */
    public function __construct(CommandHandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param mixed $command
     * @return mixed|void
     */
    public function handle($command)
    {
        return $this->handler->handle($command);
    }
}
