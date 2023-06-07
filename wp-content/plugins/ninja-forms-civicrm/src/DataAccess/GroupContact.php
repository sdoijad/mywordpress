<?php

namespace NinjaForms\CiviCrm\DataAccess;

use NinjaForms\CiviCrm\Contracts\DataAccessGroupContact as ContractsDataAccessGroupContact;
use NinjaForms\CiviCrmSdk\Entities\CiviFieldDefinition;
use NinjaForms\CiviCrmSdk\Contracts\GroupContact as ContractsGroupContact;
use NinjaForms\CiviCrm\DataAccess\DataAccessAbstract;


class GroupContact extends DataAccessAbstract implements ContractsDataAccessGroupContact
{

    /** ContractsGroupContact */
    protected $civiObject;


    public function __construct(ContractsGroupContact $civiObject, CiviFieldDefinition $civiFieldDefinition)
    {
        parent::__construct($civiObject,$civiFieldDefinition);
        
    }


}
