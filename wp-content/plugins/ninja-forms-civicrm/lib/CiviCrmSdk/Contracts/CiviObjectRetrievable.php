<?php

namespace NinjaForms\CiviCrmSdk\Contracts;

use NinjaForms\CiviCrmSdk\Contracts\CiviObject;

/**
 * Required methods for Retrievable CiviObjects
 *
 * Retrievable CiviObjects are those for which the SDK enables the retrieval of
 * records from the given CiviObject.  Note that retrieval of records differs
 * from the retrieval of field definitions.  This interface defines retrieval of
 * records stored for the given object, not field definitions
 */
interface CiviObjectRetrievable extends CiviObject
{

    /**
     * Request records from CiviCrm
     *
     * Records are returned as a indexed collection of associative arrays.  The
     * requestor is responsible for interpreting the returned data into its
     * desired structure.
     * 
     * @return array
     */
    public function getRecords(): array;
}
