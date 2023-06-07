<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\Phone as ContractsPhone;

use NinjaForms\CiviCrmSdk\Entities\GetPhonesResponse;
use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

use NinjaForms\CiviCrmSdk\Traits\CiviObjectFilterable;
use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectCreateable;

use \Civi\Api4\Phone as CiviPhone;

/**
 * Honors NinjaForms' Contracts phone using CiviCRM's API v4
 */
class Phone extends AbstractCiviObjectCreateable implements ContractsPhone
{
    use CiviObjectFilterable;

    public function __construct()
    {
        parent::__construct();

        $this->getRecordsResponse=$this->getGetRecordsResponse();
    }

    /** @inheritDoc */
    protected function getCiviObject()
    {
        return new CiviPhone();
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
        return new GetPhonesResponse();
    }
}
