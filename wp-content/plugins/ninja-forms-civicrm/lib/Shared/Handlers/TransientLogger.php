<?php

namespace NinjaForms\CiviCrmShared\Handlers;

use NinjaForms\CiviCrmShared\Contracts\LoggerInterface;
use \Psr\Log\LoggerTrait;

/**
 * Provides logging to a transient stored in WP table for one week
 */
class TransientLogger implements LoggerInterface
{

    use LoggerTrait;

    /**
     * Key under which transient is stored
     *
     * @var string
     */
    protected $transientKey;

    /**
     * Array of string messages
     *
     * @var array
     */
    protected $logCollection = [];


    /**
     * Construct with transient key
     *
     * @param string $transientKey
     */
    public function __construct(string $transientKey)
    {
        $this->transientKey = $transientKey;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed   $level
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function log($level, $message, array $context = [])
    {
        $this->getLogCollection();

        $newLogEntry = $this->constructLogEntry($message);

        $this->logCollection[] = $newLogEntry;

        $this->storeLogCollection();
    }

    /**
     * Store the log as a transient for one week
     */
    protected function storeLogCollection(): void
    {
        \set_transient($this->transientKey, $this->logCollection, 7 * 24 * 60 * 60);
    }

    /** @inheritDoc  */
    public function getLogCollection(): array
    {
        $retrieved = \get_transient($this->transientKey);

        if (is_array($retrieved)) {
            $this->logCollection = $retrieved;
        } else {
            $this->logCollection = [];
        }

        return $this->logCollection;
    }

    /** @inheritDoc */
    public function clearLog(): LoggerInterface
    {
        \delete_transient($this->transientKey);

        return $this;
    }

    /**
     * Get the current log from the transient
     * @return array
     */
    protected function constructLogEntry(string $message): array
    {
        $newLogEntry = [
            'timestamp' => date('Y-M-d H:i:s'),
            'message' => $message
        ];

        return $newLogEntry;
    }
}
