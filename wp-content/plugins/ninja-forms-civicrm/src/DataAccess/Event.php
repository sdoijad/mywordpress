<?php

namespace NinjaForms\CiviCrm\DataAccess;

use NinjaForms\CiviCrm\Contracts\DataAccessEvent as ContractsDataAccessEvent;
use NinjaForms\CiviCrmSdk\Entities\CiviFieldDefinition;
use NinjaForms\CiviCrmSdk\Contracts\Event as ContractsEvent;
use NinjaForms\CiviCrm\DataAccess\DataAccessAbstract;


class Event extends DataAccessAbstract implements ContractsDataAccessEvent
{

    /** @var ContractsEvent */
    protected $civiObject;


    public function __construct(ContractsEvent $civiObject, CiviFieldDefinition $civiFieldDefinition)
    {
        parent::__construct($civiObject, $civiFieldDefinition);
    }

    public function getRecords(): array
    {
        $results=$this->civiObject->getRecords();

        return $results;
    }
}
