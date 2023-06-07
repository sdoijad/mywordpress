<?php

namespace NinjaForms\CiviCrm\DataAccess;

use NinjaForms\CiviCrm\Contracts\DataAccessPhone as ContractsDataAccessPhone;
use NinjaForms\CiviCrmSdk\Entities\CiviFieldDefinition;
use NinjaForms\CiviCrmSdk\Contracts\Phone as ContractsPhone;
use NinjaForms\CiviCrm\DataAccess\DataAccessAbstract;

class Phone extends DataAccessAbstract implements ContractsDataAccessPhone
{

    /** @var ContractsPhone */
    protected $civiObject;


    public function __construct(ContractsPhone $civiObject, CiviFieldDefinition $civiFieldDefinition)
    {
        parent::__construct($civiObject, $civiFieldDefinition);
    }
}
