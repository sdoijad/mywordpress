<?php

namespace NinjaForms\CiviCrm\DataAccess;

use NinjaForms\CiviCrm\Contracts\DataAccessNote as ContractsDataAccessNote;
use NinjaForms\CiviCrmSdk\Entities\CiviFieldDefinition;
use NinjaForms\CiviCrmSdk\Contracts\Note as ContractsNote;
use NinjaForms\CiviCrm\DataAccess\DataAccessAbstract;

class Note extends DataAccessAbstract implements ContractsDataAccessNote
{

    /** @var ContractsNote */
    protected $civiObject;


    public function __construct(ContractsNote $civiObject, CiviFieldDefinition $civiFieldDefinition)
    {
        parent::__construct($civiObject, $civiFieldDefinition);
    }
}
