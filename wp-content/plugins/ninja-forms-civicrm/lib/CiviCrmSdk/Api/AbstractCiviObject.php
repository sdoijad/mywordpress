<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\CiviObject as ContractsCiviObject;
use NinjaForms\CiviCrmSdk\Entities\CiviFieldDefinition;

/**
 * Honors CiviObject contract
 *
 * All CiviObjects share common functionality.  This class provides a common
 * implementation of that common functionality.
 */
abstract class AbstractCiviObject implements ContractsCiviObject
{
    /** 
     * CiviObject
     * 
     * CiviCrm plugin object used to make API requests of CiviCrm.
     */
    protected $civiObject;


    /**
     * Call protected child method that instantiates CiviCRM object
     */
    public function __construct()
    {
        $this->civiObject = $this->getCiviObject();
    }

    /** @inheritDoc */
    public function getFields(): array
    {
        $returnedObject = $this->civiObject::getFields()
            ->setCheckPermissions(FALSE)
            ->execute();

        $collection = json_decode(\json_encode($returnedObject), true);

        $return = [];

        foreach ($collection as $array) {
            $return[] = (CiviFieldDefinition::fromArray($array))->toArray();
        }

        return $return;
    }

    /**
     * Return an instance of a CiviCrm plugin's API object
     *
     * Encapsulated within the child class to make API request
     */
    abstract protected function getCiviObject();

}
