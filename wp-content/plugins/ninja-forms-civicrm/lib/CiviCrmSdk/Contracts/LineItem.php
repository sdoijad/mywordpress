<?php

namespace NinjaForms\CiviCrmSdk\Contracts;
use NinjaForms\CiviCrmShared\Entities\HandledResponse;

/**
 * Defines required methods for Line Item
 *
 * Line item entity differs significantly from the other CiviCrm objects in how
 * we use them.  We do not directly create records for LineItems, rather, a
 * collection of line items is consolidated into a single Order entity and the
 * Order is responsible for creating the entities associated with the line items.
 */
interface LineItem
{
    /**
     * Construct a line item request to be included in Order 
     *
     * @param array $parameterArray
     * @return array
     */
    public function constructLineItemForOrder(?array $parameterArray, array $parentIds): HandledResponse;
}
