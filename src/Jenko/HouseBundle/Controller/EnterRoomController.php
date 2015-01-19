<?php

namespace Jenko\HouseBundle\Controller;

use Jenko\House\Command\EnterRoomCommand;
use Jenko\House\Handler\HandlerInterface;
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
     * @var HandlerInterface $handler
     */
    private $handler;

    /**
     * @param EngineInterface $templating
     */
    public function __construct(EngineInterface $templating, HandlerInterface $handler)
    {
        $this->templating = $templating;
        $this->handler = $handler;
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

        /** @var House $house */
        $house = $this->handler->handle($command);

        return $this->templating->renderResponse(
            'JenkoHouseBundle::room.html.twig',
            ['currentRoom' => $house->whereAmI(), 'previousRoom' => $house->whereWasI()]
        );
    }
}
