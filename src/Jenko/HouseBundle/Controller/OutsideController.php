<?php

namespace Jenko\HouseBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class OutsideController
{
    public function outsideAction()
    {
        return new Response('OUTSIDE!');
    }
}
