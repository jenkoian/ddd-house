<?php

namespace Jenko\HouseBundle\Controller;

use Jenko\House\Command\EnterRoomCommand;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tabbi89\CommanderBundle\Command\CommandBusInterface;

class EnterRoomController
{
    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    /**
     * @param EngineInterface $templating
     * @param CommandBusInterface $commandBus
     */
    public function __construct(EngineInterface $templating, CommandBusInterface $commandBus)
    {
        $this->templating = $templating;
        $this->commandBus = $commandBus;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function enterAction(Request $request)
    {
        $command = new EnterRoomCommand();
        $command->room = $request->get('location');
        $this->commandBus->execute($command);

        return $this->templating->renderResponse(
            'JenkoHouseBundle::room.html.twig',
            ['room' => $command->room]
        );
    }
}
