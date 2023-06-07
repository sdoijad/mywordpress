<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\GroupContact as ContractsGroupContact;

use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectCreateable;

use \Civi\Api4\GroupContact as CiviGroupContact;

/**
 * Honors NinjaForms' Contracts groupContact using CiviCRM's API v4
 */
class GroupContact extends AbstractCiviObjectCreateable implements ContractsGroupContact
{
    /** @inheritDoc */
    protected function getCiviObject()
    {
        return new CiviGroupContact();
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
