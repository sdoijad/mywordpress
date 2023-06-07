<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\TagEntity as ContractsTagEntity;

use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectCreateable;

use \Civi\Api4\EntityTag as CiviTagEntity;

/**
 * Honors NinjaForms' Contracts tagEntity using CiviCRM's API v4
 */
class TagEntity extends AbstractCiviObjectCreateable implements ContractsTagEntity
{
    /** @inheritDoc */
    protected function getCiviObject()
    {
        return new CiviTagEntity();
    }

    /** @inheritDoc */
    protected function constructParentNameValuePairs(array $parentIds): array
    {
        $return = [];

        $acceptedKeys = [
            'Contact' => 'contact_id'
        ];

        foreach ($acceptedKeys as $entity => $childFieldKey) {

            if (isset($parentIds[$entity])) {
                $return[$childFieldKey] = $parentIds[$entity];
            }
        }

        return $return;
    }
}
