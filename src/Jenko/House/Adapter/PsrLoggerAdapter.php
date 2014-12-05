<?php

namespace Jenko\House\Adapter;

use Jenko\House\Logger\LoggerInterface as LocalLoggerInterface;
use Psr\Log\LoggerInterface;

class PsrLoggerAdapter implements LocalLoggerInterface
{
    /**
     * @var LoggerInterface $logger
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function log($level, $message, array $context = array())
    {
        $this->logger->log($level, $message, $context);
    }
}
