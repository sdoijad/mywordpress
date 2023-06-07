<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\Activity as ContractsActivity;

use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectCreateable;

use \Civi\Api4\Activity as CiviActivity;

/**
 * Honors NinjaForms' Contracts activity using CiviCRM's API v4
 */
class Activity extends AbstractCiviObjectCreateable implements ContractsActivity
{
    /** @inheritDoc */
    protected function getCiviObject( )
    {
        return new CiviActivity();
    }
    

    /** 
     * Given parent ids keyed on entity, constructs name=>value pairs
     *
     * Incoming array receives key with record Id for association.
     * $parentIds specify the key under which the incoming id will be set
     * 
     * 'ActivityAddedByContact'=>'123' will be mapped as 'source_contact_id'=>123
     * 
     * 'ActivityWithContact'=>'456' will be mapped as 'target_contact_id'=>[456]
     *
     */
    protected function constructParentNameValuePairs(array $parentIds): array
    {
        $return = [];

        if (isset($parentIds['ActivityAddedByContact'])) {
            $return['source_contact_id'] = (int)$parentIds['ActivityAddedByContact'];
        }

        if (isset($parentIds['ActivityWithContact'])) {
            $return['target_contact_id'] = [(int)$parentIds['ActivityWithContact']];
        }

        return $return;
    }
}
