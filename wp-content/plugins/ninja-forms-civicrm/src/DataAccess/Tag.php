<?php

namespace NinjaForms\CiviCrm\DataAccess;

use NinjaForms\CiviCrm\Contracts\DataAccessTag as ContractsDataAccessTag;
use NinjaForms\CiviCrmSdk\Entities\CiviFieldDefinition;
use NinjaForms\CiviCrmSdk\Contracts\Tag as ContractsTag;
use NinjaForms\CiviCrm\DataAccess\DataAccessAbstract;


class Tag extends DataAccessAbstract implements ContractsDataAccessTag
{

    /** @var ContractsTag */
    protected $civiObject;


    public function __construct(ContractsTag $civiObject, CiviFieldDefinition $civiFieldDefinition)
    {
        parent::__construct($civiObject, $civiFieldDefinition);
    }

    public function getRecords(): array
    {
        $results=$this->civiObject->getRecords();

        return $results;
    }
}
