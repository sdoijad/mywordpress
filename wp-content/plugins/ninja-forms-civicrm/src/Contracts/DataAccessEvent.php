<?php

namespace NinjaForms\CiviCrm\Contracts;

use NinjaForms\CiviCrm\Contracts\DataAccess as ContractsDataAccess;

interface DataAccessEvent extends ContractsDataAccess
{
    /**
     * Get array of all Events
     *
     * @return array
     */
    public function getRecords(): array;
}
