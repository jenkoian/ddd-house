<?php

namespace Jenko\HouseBundle\Controller;

use Jenko\House\Command\EnterRoomCommand;
use Jenko\House\Handler\EnterRoomHandler;
use Jenko\House\House;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EnterRoomController
{
    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @param EngineInterface $templating
     */
    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
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

        $handler = new EnterRoomHandler();
        /** @var House $house */
        $house = $handler->handle($command);

        return $this->templating->renderResponse(
            'JenkoHouseBundle::room.html.twig',
            ['currentRoom' => $house->whereAmI(), 'previousRoom' => $house->whereWasI()]
        );
    }
}