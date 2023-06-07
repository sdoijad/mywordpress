<?php

namespace NinjaForms\CiviCrm\DataAccess;
use NinjaForms\CiviCrm\Contracts\DataAccessParticipant as ContractsDataAccessParticipant;
use NinjaForms\CiviCrmSdk\Entities\CiviFieldDefinition;
use NinjaForms\CiviCrmSdk\Contracts\Participant as ContractsParticipant;
use NinjaForms\CiviCrm\DataAccess\DataAccessAbstract;

class Participant extends DataAccessAbstract implements ContractsDataAccessParticipant
{

    /** @var ContractsParticipant */
    protected $civiObject;


    public function __construct(ContractsParticipant $civiObject, CiviFieldDefinition $civiFieldDefinition)
    {
        parent::__construct($civiObject,$civiFieldDefinition);
        
    }


}
