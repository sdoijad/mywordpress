<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\Event as ContractsEvent;
use NinjaForms\CiviCrmSdk\Entities\GetEventsResponse;
use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectRetrievable;

use \Civi\Api4\Event as CiviEvent;

/**
 * Honors NinjaForms' Contracts event using CiviCRM's API v4
 */
class Event extends AbstractCiviObjectRetrievable implements ContractsEvent
{
    /** @inheritDoc */
    protected function getCiviObject()
    {
        return new CiviEvent();
    }

    /** @inheritDoc */
    protected function getGetRecordsResponse(): GetRecordsResponse
    {
        return new GetEventsResponse();
    }
}
