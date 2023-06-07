<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\Email as ContractsEmail;

use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectCreateable;

use \Civi\Api4\Email as CiviEmail;

/**
 * Honors NinjaForms' Contracts email using CiviCRM's API v4
 */
class Email extends AbstractCiviObjectCreateable implements ContractsEmail
{
    /** @inheritDoc */
    protected function getCiviObject()
    {
        return new CiviEmail();
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
