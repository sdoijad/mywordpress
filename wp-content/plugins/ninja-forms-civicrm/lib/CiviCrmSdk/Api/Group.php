<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\Group as ContractsGroup;
use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;
use NinjaForms\CiviCrmSdk\Entities\GetGroupsResponse;

use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectRetrievable;

use \Civi\Api4\Group as CiviGroup;

/**
 * Honors NinjaForms' Contracts group using CiviCRM's API v4
 */
class Group extends AbstractCiviObjectRetrievable implements ContractsGroup
{
    /** @inheritDoc */
    protected function getCiviObject( )
    {
        return new CiviGroup();
    }
    
    /** @inheritDoc */
    protected function getGetRecordsResponse( ): GetRecordsResponse
    {
        return new GetGroupsResponse();
    }

}
