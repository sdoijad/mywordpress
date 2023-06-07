<?php

namespace NinjaForms\CiviCrmSdk\Contracts;
use NinjaForms\CiviCrmShared\Entities\HandledResponse;


/**
 * Defines required methods for an Order
 */
interface Order
{
    /**
     * Construct a line item request to be included in Order 
     *
     * @param array $parameterArray
     * @return array
     */
    public function createOrder(?array $parameterArray): HandledResponse;
}
