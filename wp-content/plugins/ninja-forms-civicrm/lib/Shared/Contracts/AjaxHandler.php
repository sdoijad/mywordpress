<?php

namespace NinjaForms\CiviCrmShared\Contracts;

/**
 * Contract for handling a WP AJAX request
 *
 * An AJAX Handler standardized the registering, enqueuing, localizing of
 * scripts, which enables the passing of data from the UI to the server.  The
 * methods contained herein provide the values WordPress requires to do so.  An
 * abstract parent class handles all the standard functionality, leaving only
 * the specific data definition and its processing to the child classes.
 *
 * @package Settings
 */
interface AjaxHandler
{


    /**
     * Call methods to handle AJAX requests from settings page
     * 
     * This method is registered as the AJAX callback, thus the POSTed
     * request from the AJAX script is sent here.  Implementations can
     * then trigger whatever tasks must be performed and return the
     * corresponding response.
     */
    public function handle(): void;

    /**
     * Get AJAX script handle
     *
     * @return  string
     */
    public function getHandle(): string;


    /**
     * Get URL of script
     *
     * @return  string
     */
    public function getScriptUrl(): string;

    /**
     * Get script version
     *
     * @return  string
     */
    public function getVersion(): string;

    /**
     * Get object name of the JS object
     *
     * @return  string
     */
    public function getObjectName(): string;

    /**
     * Get key value pairs of data passed into JS object
     *
     * @return  $params
     */
    public function getLocalizedArray(): array;
}
