<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\Website as ContractsWebsite;

use NinjaForms\CiviCrmSdk\Entities\GetWebsitesResponse;
use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;
use NinjaForms\CiviCrmSdk\Traits\CiviObjectFilterable;
use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectCreateable;

use \Civi\Api4\Website as CiviWebsite;

/**
 * Honors NinjaForms' Contracts website using CiviCRM's API v4
 */
class Website extends AbstractCiviObjectCreateable implements ContractsWebsite
{
    use CiviObjectFilterable;

    public function __construct()
    {
        parent::__construct();

        $this->getRecordsResponse = $this->getGetRecordsResponse();
    }

    /** @inheritDoc */
    protected function getCiviObject()
    {
        return new CiviWebsite();
    }

    /** @inheritDoc */
    protected function constructParentNameValuePairs(array $parentIds): array
    {
        $return = [];

        $acceptedKeys = [
            'Contact' => 'contact_id'
        ];

        foreach ($acceptedKeys as $entity => $childFieldKey) {

            if (isset($parentIds[$entity])) {
                $return[$childFieldKey] = $parentIds[$entity];
            }
        }

        return $return;
    }

    /** @inheritDoc */
    protected function getGetRecordsResponse(): GetRecordsResponse
    {
        return new GetWebsitesResponse();
    }
}
