<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\CiviObjectRetrievable;
use NinjaForms\CiviCrmSdk\Api\AbstractCiviObject;

use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

/**
 * Honors CiviObjectRetrievable contract
 * 
 * Children implement method to provide response object
 */
abstract class AbstractCiviObjectRetrievable extends AbstractCiviObject implements CiviObjectRetrievable
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
     * Construct with calls to protected methods defining required objects
     *
     * The CiviCrm and GetRecordsResponse objects are instantiated in protected
     * methods required by this parent class.
     */
    public function __construct()
    {
        parent::__construct();

        $this->getRecordsResponse = $this->getGetRecordsResponse();
    }

    /**
     * Response object (entity) standardizing the response
     *
     * @return GetRecordsResponse
     */
    abstract protected function getGetRecordsResponse(): GetRecordsResponse;

    /**
     * Request records from CiviCrm using its API
     * 
     * @return array
     */
    public function getRecords(): array
    {
        $returnedObject = $this->civiObject::get()
            ->setCheckPermissions(FALSE)
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
