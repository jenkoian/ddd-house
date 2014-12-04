<?php

namespace Jenko\HouseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class OutsideController
{
    /**
     * @var EngineInterface
     */
    private $templating;

    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    public function outsideAction()
    {
        return $this->templating->renderResponse('JenkoHouseBundle::outside.html.twig');
    }
}
