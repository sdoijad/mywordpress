<?php

namespace NinjaForms\CiviCrm\Contracts;

use NinjaForms\CiviCrm\Contracts\DataAccess as ContractsDataAccess;

interface DataAccessGroup extends ContractsDataAccess
{
    /**
     * Get array of all Groups
     *
     * @return array
     */
    public function getRecords(): array;
}
