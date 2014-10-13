<?php

namespace Jenko\HouseBundle\CommandBus;

use Tabbi89\CommanderBundle\Command\CommandTranslatorInterface as ThirdPartyCommandTranslatorInterface;

class CommanderCommandTranslatorAdapter implements CommandTranslatorInterface
{
    /**
     * @var CommandTranslatorInterface
     */
    private $commandTranslator;

    /**
     * @param ThirdPartyCommandTranslatorInterface $commandTranslator
     */
    public function __construct(ThirdPartyCommandTranslatorInterface $commandTranslator)
    {
        $this->commandTranslator = $commandTranslator;
    }

    /**
     * @param mixed $command
     * @return mixed|void
     */
    public function toCommandHandler($command)
    {
        $this->commandTranslator->toCommandHandler($command);
    }
} 