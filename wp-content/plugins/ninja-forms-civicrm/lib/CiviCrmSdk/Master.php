<?php

namespace NinjaForms\CiviCrmSdk;

use NinjaForms\CiviCrmShared\Contracts\Master as SharedContractsMaster;
use NinjaForms\CiviCrmShared\Abstracts\Master as SharedAbstractsMaster;

use NinjaForms\CiviCrmSdk\Contracts\CiviObjectsFactory as ContractsCiviObjectsFactory;
use NinjaForms\CiviCrmSdk\Factories\CiviObjectsFactory;

/**
 * Master class for CiviCrm SDK
 */
class Master extends SharedAbstractsMaster implements SharedContractsMaster
{

    /**
     * Collection of configuration arrays
     *
     * @var array
     */
    protected $configs;


    /** @inheritDoc */
    public function registerServices(): SharedContractsMaster
    {

        $this->singleton(ContractsCiviObjectsFactory::class,function(){
            return new CiviObjectsFactory();
        });

        return $this;
    }
}
