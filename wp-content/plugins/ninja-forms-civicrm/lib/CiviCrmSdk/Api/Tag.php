<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\Tag as ContractsTag;
use NinjaForms\CiviCrmSdk\Entities\GetTagsResponse;
use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectRetrievable;

use \Civi\Api4\Tag as CiviTag;

/**
 * Honors NinjaForms' Contracts tag using CiviCRM's API v4
 */
class Tag extends AbstractCiviObjectRetrievable implements ContractsTag
{
    /** @inheritDoc */
    protected function getCiviObject( )
    {
        return new CiviTag();
    }
    
    /** @inheritDoc */
    protected function getGetRecordsResponse( ): GetRecordsResponse
    {
        return new GetTagsResponse();
    }

}
