<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\Address as ContractsAddress;

use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectCreateable;

use \Civi\Api4\Address as CiviAddress;

/**
 * Honors NinjaForms' Contracts Address using CiviCRM's API v4
 */
class Address extends AbstractCiviObjectCreateable implements ContractsAddress
{
    /** @inheritDoc */
    protected function getCiviObject()
    {
        return new CiviAddress();
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
