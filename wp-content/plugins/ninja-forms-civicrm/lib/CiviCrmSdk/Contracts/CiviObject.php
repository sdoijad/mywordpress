<?php

namespace NinjaForms\CiviCrmSdk\Contracts;

/**
 * Defines required methods for all Civi Objects
 *
 * CiviObjects are SDK representations of CiviCRM'ss communication.  The SDK
 * provides implementations of these contracts to make live requests of CiviCRM
 * and also provides a mock version of the requests that enable clients of the
 * SDK to function in some capacity without CiviCRM being active on the site.
 * 
 */
interface CiviObject
{

    /**
     * Get field definitions as indexed array of CiviFieldDefinition->toArray()
     * 
     * @return array
     */
    public function getFields(): array;
    
}
