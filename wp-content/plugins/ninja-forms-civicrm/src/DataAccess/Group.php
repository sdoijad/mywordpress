<?php

namespace NinjaForms\CiviCrm\DataAccess;

use NinjaForms\CiviCrm\Contracts\DataAccessGroup as ContractsDataAccessGroup;
use NinjaForms\CiviCrmSdk\Entities\CiviFieldDefinition;
use NinjaForms\CiviCrmSdk\Contracts\Group as ContractsGroup;
use NinjaForms\CiviCrm\DataAccess\DataAccessAbstract;


class Group extends DataAccessAbstract implements ContractsDataAccessGroup
{

    /** @var ContractsGroup */
    protected $civiObject;


    
    public function __construct(ContractsGroup $civiObject, CiviFieldDefinition $civiFieldDefinition)
    {
        parent::__construct($civiObject, $civiFieldDefinition);
    }

    /**
     * Get Group records
     *
     * @return array
     */
    public function getRecords(): array
    {
        $results=$this->civiObject->getRecords();

        return $results;
    }
}
