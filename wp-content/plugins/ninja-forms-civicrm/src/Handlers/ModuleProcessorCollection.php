<?php

namespace NinjaForms\CiviCrm\Handlers;

use NinjaForms\CiviCrm\Contracts\ModuleProcessor;
use NinjaForms\CiviCrm\Contracts\ModuleProcessorCollection as ContractsModuleProcessorCollection;

/**
 * Collection of ModuleProcessors
 */
class ModuleProcessorCollection implements ContractsModuleProcessorCollection
{

    /** @var array */
    protected $moduleProcessorCollection = [];

    /** @var int */
    protected $position = 0;

    /** @inheritDoc */
    public function getObject(int $position): ModuleProcessor
    {
        if (isset($this->moduleProcessorCollection[$position])) {
            return $this->moduleProcessorCollection[$position];
        }

        throw new \Exception('No Module Processor Available', 1);
        
    }

    /** @inheritDoc */
    public function addObject(ModuleProcessor $moduleProcessor): ContractsModuleProcessorCollection
    {
        $this->moduleProcessorCollection[] = $moduleProcessor;

        return $this;
    }

    /**
     * Return count of objects in collection
     *
     * @return integer
     */
    public function count(): int
    {
        return count($this->moduleProcessorCollection);
    }


    /**
     * Return current module processor
     *
     * @return ModuleProcessor
     */
    public function current(): ModuleProcessor
    {
        return $this->moduleProcessorCollection[$this->position];
    }

    /**
     * Move to next ModuleProcessor
     *
     * @return void
     */
    public function next():void
    {
        $this->position++;
    }

    /**
     * Return current index position in collection
     *
     * @return integer
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * Ensure element at current position is a valid object of the aggregate
     *
     * @return boolean
     */
    public function valid(): bool
    {
        return isset($this->moduleProcessorCollection[$this->position]) &&
            !is_null($this->moduleProcessorCollection[$this->position]);
    }

    /**
     * Move pointer back to initial position
     *
     * @return void
     */
    public function rewind():void
    {
        $this->position = 0;
    }
}
