<?php

namespace NinjaForms\CiviCrm\DataAccess;
use NinjaForms\CiviCrm\Contracts\DataAccessContact as ContractsDataAccessContact;

use NinjaForms\CiviCrmSdk\Entities\CiviFieldDefinition;
use NinjaForms\CiviCrmSdk\Contracts\Contact as ContractsContact;
use NinjaForms\CiviCrm\DataAccess\DataAccessAbstract;

class Contact extends DataAccessAbstract implements ContractsDataAccessContact
{

    /** Contact */
    protected $civiObject;


    public function __construct(ContractsContact $contact, CiviFieldDefinition $civiFieldDefinition)
    {
        parent::__construct($contact,$civiFieldDefinition);
        
    }


}
