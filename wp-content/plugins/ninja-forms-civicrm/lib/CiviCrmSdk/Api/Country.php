<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\Country as ContractsCountry;
use NinjaForms\CiviCrmSdk\Entities\GetCountriesResponse;
use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectRetrievable;

use \Civi\Api4\Country as CiviCountry;

/**
 * Honors NinjaForms' Contracts Country using CiviCRM's API v4
 */
class Country extends AbstractCiviObjectRetrievable implements ContractsCountry
{
    /** @inheritDoc */
    protected function getCiviObject( )
    {
        return new CiviCountry();
    }
    
    /** @inheritDoc */
    protected function getGetRecordsResponse( ): GetRecordsResponse
    {
        return new GetCountriesResponse();
    }

}
