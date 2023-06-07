<?php

namespace NinjaForms\CiviCrm\DataAccess;

use NinjaForms\CiviCrm\Contracts\DataAccessAddress as ContractsDataAccessAddress;
use NinjaForms\CiviCrmSdk\Entities\CiviFieldDefinition;
use NinjaForms\CiviCrmSdk\Contracts\Address as ContractsAddress;
use NinjaForms\CiviCrm\DataAccess\DataAccessAbstract;

class Address extends DataAccessAbstract implements ContractsDataAccessAddress
{

    /** @var ContractsAddress */
    protected $civiObject;


    public function __construct(ContractsAddress $civiObject, CiviFieldDefinition $civiFieldDefinition)
    {
        parent::__construct($civiObject, $civiFieldDefinition);
    }
}
