<?php

namespace NinjaForms\CiviCrmSdk\Traits;


use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

/**
 * Honors CiviObjectRetrievable contract
 * 
 * Children implement method to provide response object
 */
trait CiviObjectFilterable 
{


    /**
     * Response object containing records from CiviCrm
     *
     * 'getRecords' indicates that this request is a retrieval of records in
     * CiviCrm, as opposed to requests for meta data such as field definitions.
     * @var GetRecordsResponse
     */
    protected $getRecordsResponse;

    /**
     * Response object (entity) standardizing the response
     *
     * @return GetRecordsResponse
     */
    abstract protected function getGetRecordsResponse(): GetRecordsResponse;

    /** @inheritDoc */
    public function filterRecordsWhere(string $where, $value): array
    {
        $returnedObject = $this->civiObject::get()
            ->addWhere($where,'=',$value)
            ->execute();

        $collection = json_decode(\json_encode($returnedObject), true);

        $return = [];

        if (!empty($collection)) {

            foreach ($collection as $array) {
                $return[] = ($this->getRecordsResponse::fromArray($array))->toArray();
            }
        }

        return $return;
    }
}
