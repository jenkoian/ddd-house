<?php

namespace Jenko\HouseBundle\Controller;

use Jenko\House\Room;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EnterRoomController
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function enterAction(Request $request)
    {
        $location = new Room($request->get('location'));
        return new Response($location);
    }
}
