<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\Participant as ContractsParticipant;

use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectCreateable;

use \Civi\Api4\Participant as CiviParticipant;

/**
 * Honors NinjaForms' Contracts participant using CiviCRM's API v4
 */
class Participant extends AbstractCiviObjectCreateable implements ContractsParticipant
{
    /** @inheritDoc */
    protected function getCiviObject()
    {
        return new CiviParticipant();
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
