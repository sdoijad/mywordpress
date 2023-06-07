<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\Note as ContractsNote;

use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectCreateable;

use \Civi\Api4\Note as CiviNote;

/**
 * Honors NinjaForms' Contracts note using CiviCRM's API v4
 */
class Note extends AbstractCiviObjectCreateable implements ContractsNote
{
    /** @inheritDoc */
    protected function getCiviObject()
    {
        return new CiviNote();
    }

    /** @inheritDoc */
    protected function constructParentNameValuePairs(array $parentIds): array
    {
        $return = [];

        // Doesn't have a 'parent' because it can be linked to entity of choice

        return $return;
    }
}
