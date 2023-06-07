<?php 
namespace NinjaForms\CiviCrm\Contracts;

use NinjaForms\CiviCrm\Contracts\ModuleProcessorCollection;

/**
 * Provide sequenced Module Processors for handling form submission 
 *
 * Module processors are only used during form submission and should not be
 * instantiated before such time.  Passing a factory into the primary form
 * processor defers the construction of module processors until they are
 * required.
 */
interface ModuleProcessorFactory{

    public function getModuleProcessors( ): ModuleProcessorCollection;
}