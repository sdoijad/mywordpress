<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\OptionGroup as ContractsOptionGroup;
use NinjaForms\CiviCrmSdk\Entities\GetOptionGroupsResponse;
use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectRetrievable;

use \Civi\Api4\OptionGroup as CiviOptionGroup;

/**
 * Honors NinjaForms' Contracts OptionGroup using CiviCRM's API v4
 */
class OptionGroup extends AbstractCiviObjectRetrievable implements ContractsOptionGroup
{
    /** @inheritDoc */
    protected function getCiviObject( )
    {
        return new CiviOptionGroup();
    }
    
    /** @inheritDoc */
    protected function getGetRecordsResponse( ): GetRecordsResponse
    {
        return new GetOptionGroupsResponse();
    }

}
