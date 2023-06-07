<?php

namespace NinjaForms\CiviCrmSdk\Contracts;

/**
 * Required methods for Filterable CiviObjects
 *
 * Filterable CiviObjects are those for which the SDK enables the filtering of 
 */
interface CiviObjectFilterable
{

    /**
     * Filter records where a given key equals a given value
     *
     * @param string $where Key under which to search
     * @param mixed $value Value for which to search
     * @return array
     */
    public function filterRecordsWhere(string $where, $value): array;
}
