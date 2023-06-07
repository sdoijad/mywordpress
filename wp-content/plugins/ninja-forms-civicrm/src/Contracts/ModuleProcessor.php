<?php

namespace NinjaForms\CiviCrm\Contracts;

/**
 * Process individual API module request
 *
 * In CiviCRM, modules are closely paralleled by Entities; each entity will have
 * one (or more, in the case of making duplicate checks) requests to be made.
 * This contract defines the communication to and from the main form processor
 * to pass the data while separating the code for each request.
 */
interface ModuleProcessor
{

    /**
     * Process the form submission data
     *
     * @return ModuleProcessor
     */
    public function process(): ModuleProcessor;

    /**
     * Set submission Data array
     *
     * @param  array  $submissionData  Submission Data array
     *
     * @return  ModuleProcessor
     */
    public function setSubmissionData(array $submissionData): ModuleProcessor;

    /**
     * Set array of previously constructed (or matched) Ids
     *
     * @param  array  $recordIds  Array of previously constructed (or matched) Ids
     *
     * @return  ModuleProcessor
     */
    public function setRecordIds(array $recordIds): ModuleProcessor;

     /**
     * Get array of previously constructed (or matched) Ids
     *
     * @return  array
     */
    public function getRecordIds():array;

    /**
     * Get collection of CreateObjectResponse objects
     *
     * @return  CreateObjectResponse[]
     */
    public function getResponses():array;

    /**
     * Is this processing a previously matched duplicate?
     *
     * Indicates if the processor will be working on a previously matched
     * duplicate.  Important because some processors, like an email, won't run
     * if previously matched on an email.
     *
     * @return boolean
     */
    public function isDupe( ): bool;


    /**
     * Sets bool - is this processing a previously matched duplicate
     *
     * @param boolean|null $isDupe
     * @return ModuleProcessor
     */
    public function setIsDupe(?bool $isDupe=true): ModuleProcessor;
}
