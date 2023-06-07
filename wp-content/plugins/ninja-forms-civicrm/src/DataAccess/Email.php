<?php

namespace NinjaForms\CiviCrm\DataAccess;

use NinjaForms\CiviCrm\Contracts\DataAccessEmail as ContractsDataAccessEmail;
use NinjaForms\CiviCrmSdk\Entities\CiviFieldDefinition;
use NinjaForms\CiviCrmSdk\Contracts\Email as ContractsEmail;
use NinjaForms\CiviCrm\DataAccess\DataAccessAbstract;

class Email extends DataAccessAbstract implements ContractsDataAccessEmail
{

    /** @var ContractsEmail */
    protected $civiObject;


    public function __construct(ContractsEmail $civiObject, CiviFieldDefinition $civiFieldDefinition)
    {
        parent::__construct($civiObject, $civiFieldDefinition);
    }
}
