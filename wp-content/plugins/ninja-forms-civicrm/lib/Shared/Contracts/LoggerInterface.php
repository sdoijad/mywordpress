<?php 
namespace NinjaForms\CiviCrmShared\Contracts;
use Psr\Log\LoggerInterface as PsrLogLoggerInterface;

interface LoggerInterface extends PsrLogLoggerInterface{

    /**
     * Load the existing log collection from transient
     */
    public function getLogCollection( ): array;

    /**
     * Clear the log's storage location
     */
    public function clearLog( ): LoggerInterface;
}