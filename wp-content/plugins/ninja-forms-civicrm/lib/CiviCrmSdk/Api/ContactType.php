<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\ContactType as ContractsContactType;
use NinjaForms\CiviCrmSdk\Entities\GetContactTypesResponse;
use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectRetrievable;

use \Civi\Api4\ContactType as CiviContactType;

/**
 * Honors NinjaForms' Contracts ContactType using CiviCRM's API v4
 */
class ContactType extends AbstractCiviObjectRetrievable implements ContractsContactType
{
    /** @inheritDoc */
    protected function getCiviObject( )
    {
        return new CiviContactType();
    }
    
    /** @inheritDoc */
    protected function getGetRecordsResponse( ): GetRecordsResponse
    {
        return new GetContactTypesResponse();
    }

}
