<?php

namespace NinjaForms\CiviCrm\Contracts;

use NinjaForms\CiviCrm\Contracts\ModuleProcessor;

interface ModuleProcessorCollection extends \Iterator
{

    /**
     * Return current ModuleProcessor
     *
     * @param int $position
     * @return ModuleProcessor|null
     */
    public function getObject(int $position): ModuleProcessor;

    /**
     * Add a Module Processor to the collection
     *
     * @param ModuleProcessor $moduleProcessor
     * @return ModuleProcessorCollection
     */
    public function addObject(ModuleProcessor $moduleProcessor): ModuleProcessorCollection;
}
