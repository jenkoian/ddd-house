<?php

namespace Jenko\HouseBundle\Controller;

use Jenko\House\Factory\HomeAloneHouseFactory;
use Jenko\House\House;
use Jenko\HouseCommandHandling\Command\EnterRoomCommand;
use SimpleBus\Command\Bus\CommandBus;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class EnterRoomController
{
    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @var CommandBus $commandBus
     */
    private $commandBus;

    /**
     * @param EngineInterface $templating
     * @param CommandBus $commandBus
     */
    public function __construct(EngineInterface $templating, CommandBus $commandBus)
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
        $command->house = HomeAloneHouseFactory::getHouse();
        $command->room = $request->get('location');

        /** @var House $house */
        $this->commandBus->handle($command);

        return $this->templating->renderResponse(
            'JenkoHouseBundle::room.html.twig',
            ['currentRoom' => $command->house->whereAmI(), 'previousRoom' => $command->house->whereWasI()]
        );
    }
}
