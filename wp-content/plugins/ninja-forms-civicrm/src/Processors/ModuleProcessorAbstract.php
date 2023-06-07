<?php

namespace NinjaForms\CiviCrm\Processors;

use NinjaForms\CiviCrm\Contracts\ModuleProcessor;

abstract class ModuleProcessorAbstract implements ModuleProcessor
{
    /**
     * Is this processor working on a previously matched duplicate?
     *
     * @var boolean
     */
    protected $isDupe = false;

    /**
     * Submission data array
     *
     * @var array
     */
    protected $submissionData;

    /**
     * Collection of record Ids
     *
     * @var array
     */
    protected $recordIds;

    /**
     * Collection of responses
     *
     * @var array
     */
    protected $responses;

    /** @inheritDoc */
    abstract public function process(): ModuleProcessor;

    /** @inheritDoc    */
    public function setSubmissionData(array $submissionData): ModuleProcessor
    {
        $this->submissionData = $submissionData;

        return $this;
    }

    /** @inheritDoc */
    public function setRecordIds(array $recordIds): ModuleProcessor
    {
        $this->recordIds = $recordIds;

        return $this;
    }

    /** @inheritDoc */
    public function getRecordIds(): array
    {
        return $this->recordIds;
    }

    /** @inheritDoc */
    public function getResponses(): array
    {
        return $this->responses;
    }

    /** @inheritDoc */
    public function isDupe( ): bool{

        return $this->isDupe;
    }

    /** @inheritDoc */
    public function setIsDupe(?bool $isDupe=true): ModuleProcessor{
        $this->isDupe = $isDupe;

        return $this;
    }
}
