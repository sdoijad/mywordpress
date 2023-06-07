<?php

namespace NinjaForms\CiviCrm\DataAccess;

use NinjaForms\CiviCrm\Contracts\DataAccessIm as ContractsDataAccessIm;
use NinjaForms\CiviCrmSdk\Entities\CiviFieldDefinition;
use NinjaForms\CiviCrmSdk\Contracts\Im as ContractsIm;
use NinjaForms\CiviCrm\DataAccess\DataAccessAbstract;

class Im extends DataAccessAbstract implements ContractsDataAccessIm
{

    /** @var ContractsIm */
    protected $civiObject;


    public function __construct(ContractsIm $civiObject, CiviFieldDefinition $civiFieldDefinition)
    {
        parent::__construct($civiObject, $civiFieldDefinition);
    }
}
