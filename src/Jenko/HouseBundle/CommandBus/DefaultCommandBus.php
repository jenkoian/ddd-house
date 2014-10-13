<?php

namespace Jenko\HouseBundle\CommandBus;

use Jenko\House\Handler\CommandHandlerInterface;

class DefaultCommandBus implements CommandBusInterface
{
    /**
     * @var CommandTranslatorInterface
     */
    protected $commandTranslator;

    /**
     * List of all registered handlers
     *
     * @var array
     */
    protected $handlers;

    /**
     * @param CommandTranslatorInterface $commandTranslator
     */
    public function __construct(CommandTranslatorInterface $commandTranslator)
    {
        $this->commandTranslator = $commandTranslator;
        $this->handlers = [];
    }

    /**
     * Add handlers
     *
     * @param CommandHandlerInterface $handler
     * @param string $alias
     */
    public function addHandler(CommandHandlerInterface $handler, $alias)
    {
        $this->handlers[$alias] = $handler;
    }

    /**
     * Execute the command
     *
     * @param mixed $command
     *
     * @throws \RuntimeException
     * @return mixed
     */
    public function execute($command)
    {
        $handler = $this->commandTranslator->toCommandHandler($command);

        if (!array_key_exists($handler, $this->handlers)) {
            throw new \RuntimeException("Handler [$handler] not registered");
        }

        return $this->handlers[$handler]->handle($command);
    }
} 