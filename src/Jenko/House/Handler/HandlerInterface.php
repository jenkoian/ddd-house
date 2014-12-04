<?php

namespace Jenko\House\Handler;

interface HandlerInterface
{
    /**
     * @param $command
     * @return mixed
     */
    public function handle($command);
}
