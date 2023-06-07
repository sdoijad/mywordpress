<?php

namespace NinjaForms\CiviCrm\Contracts;

use NinjaForms\CiviCrm\Contracts\DataAccess as ContractsDataAccess;

interface DataAccessTag extends ContractsDataAccess
{
    /**
     * Get array of all Tags
     *
     * @return array
     */
    public function getRecords(): array;
}
