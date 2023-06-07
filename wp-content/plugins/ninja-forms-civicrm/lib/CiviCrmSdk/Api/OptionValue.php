<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\OptionValue as ContractsOptionValue;
use NinjaForms\CiviCrmSdk\Entities\GetOptionValuesResponse;
use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectRetrievable;

use \Civi\Api4\OptionValue as CiviOptionValue;

/**
 * Honors NinjaForms' Contracts OptionValue using CiviCRM's API v4
 */
class OptionValue extends AbstractCiviObjectRetrievable implements ContractsOptionValue
{
    /** @inheritDoc */
    protected function getCiviObject( )
    {
        return new CiviOptionValue();
    }
    
    /** @inheritDoc */
    protected function getGetRecordsResponse( ): GetRecordsResponse
    {
        return new GetOptionValuesResponse();
    }

}
