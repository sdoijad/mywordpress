<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\Im as ContractsIm;

use NinjaForms\CiviCrmSdk\Entities\GetImsResponse;
use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

use NinjaForms\CiviCrmSdk\Traits\CiviObjectFilterable;
use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectCreateable;

use \Civi\Api4\IM as CiviIm;

/**
 * Honors NinjaForms' Contracts IM using CiviCRM's API v4
 */
class Im extends AbstractCiviObjectCreateable implements ContractsIm
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
        return new CiviIm();
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
            return new GetImsResponse();
        }
}
