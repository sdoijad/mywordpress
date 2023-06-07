<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\DedupeRuleGroup as ContractsDedupeRuleGroup;
use NinjaForms\CiviCrmSdk\Entities\GetDedupeRuleGroupsResponse;
use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectRetrievable;

use \Civi\Api4\DedupeRuleGroup as CiviDedupeRuleGroup;

/**
 * Honors NinjaForms' Contracts DedupeRuleGroup using CiviCRM's API v4
 */
class DedupeRuleGroup extends AbstractCiviObjectRetrievable implements ContractsDedupeRuleGroup
{
    /** @inheritDoc */
    protected function getCiviObject( )
    {
        return new CiviDedupeRuleGroup();
    }
    
    /** @inheritDoc */
    protected function getGetRecordsResponse( ): GetRecordsResponse
    {
        return new GetDedupeRuleGroupsResponse();
    }

}
