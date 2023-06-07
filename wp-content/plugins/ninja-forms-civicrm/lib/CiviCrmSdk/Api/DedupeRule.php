<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\DedupeRule as ContractsDedupeRule;
use NinjaForms\CiviCrmSdk\Entities\GetDedupeRulesResponse;
use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectRetrievable;

use \Civi\Api4\DedupeRule as CiviDedupeRule;

/**
 * Honors NinjaForms' Contracts DedupeRule using CiviCRM's API v4
 */
class DedupeRule extends AbstractCiviObjectRetrievable implements ContractsDedupeRule
{
    /** @inheritDoc */
    protected function getCiviObject( )
    {
        return new CiviDedupeRule();
    }
    
    /** @inheritDoc */
    protected function getGetRecordsResponse( ): GetRecordsResponse
    {
        return new GetDedupeRulesResponse();
    }

}
