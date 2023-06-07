<?php

namespace NinjaForms\CiviCrm\DataAccess;

use NinjaForms\CiviCrmSdk\Contracts\CiviObject;
use NinjaForms\CiviCrm\Contracts\DataAccess as ContractsDataAccess;

use NinjaForms\CiviCrmSdk\Entities\CiviFieldDefinition;

/**
 * Structures data to/from the CRM to the main plugin
 * 
 * Constructed with CRM object and CRM field definition, this class makes calls to
 * the CRM using the CRM object, then structures the requested data for the main plugin
 */
abstract class DataAccessAbstract implements ContractsDataAccess
{
    /** @var CiviObject */
    protected $civiObject;

    /**  @var CiviFieldDefinition*/
    protected $fieldDefinition;

    /**
     * Collection of field definitions of the given CiviCrm entity
     *
     * array of (array) field definitions keyed on unique Id 'name'
     * @var []
     */
    protected $collection;

    /**
     * Id - Label pairs for the given CiviCrm entity
     * 
     * 
     * @var []
     */
    protected $idLabelPairs;

    public function __construct(CiviObject $civiObject, CiviFieldDefinition $civiFieldDefinition)
    {
        $this->civiObject = $civiObject;
        $this->fieldDefinition = $civiFieldDefinition;

    }

    /**
     * Get Id Label pairs for the entity
     *
     * ID = name for a given field
     * @return array
     */
    public function getFieldDefinitionIdLabelPairs(?bool $associative = true): array
    {
        $this->constructIdLabelPairs();
        
        $return = $this->idLabelPairs;

        if(!$associative){
            $return =[];
            foreach($this->idLabelPairs as $id=>$label){
                $return[]=[
                    'value'=>$id,
                    'label'=>$label
                ];
            }

        }
        return $return;
    }


    /**
     * Construct the Id Label pairs
     *
     * @return void
     */
    protected function constructIdLabelPairs(): void
    {
        if (isset($this->idLabelPairs)) {
            return;
        }
        $this->initializeFields();

        $this->idLabelPairs = [];

        foreach ($this->collection as $field) {
            $this->idLabelPairs[ $field['name']] = $field['label'];
        }
    }

    protected function initializeFields(): void
    {
        if (isset($this->collection)) {
            return;
        }

        $this->collection = [];

        $fields = $this->civiObject->getFields();

        foreach ($fields as $field) {

            $this->collection[$field['name']] = $field;
        }
    }
}
