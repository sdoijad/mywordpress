<?php

namespace NinjaForms\CiviCrm\DataAccess;
use NinjaForms\CiviCrm\Contracts\DataAccessActivity as ContractsDataAccessActivity;
use NinjaForms\CiviCrmSdk\Entities\CiviFieldDefinition;
use NinjaForms\CiviCrmSdk\Contracts\Activity as ContractsActivity;
use NinjaForms\CiviCrm\DataAccess\DataAccessAbstract;

class Activity extends DataAccessAbstract implements ContractsDataAccessActivity
{

    /** @var ContractsActivity */
    protected $civiObject;


    public function __construct(ContractsActivity $civiObject, CiviFieldDefinition $civiFieldDefinition)
    {
        parent::__construct($civiObject,$civiFieldDefinition);
        
    }


}
