<?php

namespace Jenko\HouseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

class OutsideController
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
     * @return Response
     */
    public function outsideAction()
    {
        return $this->templating->renderResponse('JenkoHouseBundle::outside.html.twig');
    }
}
