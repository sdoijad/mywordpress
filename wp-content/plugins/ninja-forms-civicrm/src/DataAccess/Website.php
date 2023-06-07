<?php

namespace NinjaForms\CiviCrm\DataAccess;

use NinjaForms\CiviCrm\Contracts\DataAccessWebsite as ContractsDataAccessWebsite;
use NinjaForms\CiviCrmSdk\Entities\CiviFieldDefinition;
use NinjaForms\CiviCrmSdk\Contracts\Website as ContractsWebsite;
use NinjaForms\CiviCrm\DataAccess\DataAccessAbstract;

class Website extends DataAccessAbstract implements ContractsDataAccessWebsite
{

    /** @var ContractsWebsite */
    protected $civiObject;


    public function __construct(ContractsWebsite $civiObject, CiviFieldDefinition $civiFieldDefinition)
    {
        parent::__construct($civiObject, $civiFieldDefinition);
    }
}
