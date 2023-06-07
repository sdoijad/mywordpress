<?php

namespace NinjaForms\CiviCrm;

use NinjaForms\CiviCrmShared\Contracts\Master as SharedContractsMaster;
use NinjaForms\CiviCrmShared\Contracts\DataModelProvider as ContractsDataModelProvider;
use NinjaForms\CiviCrmShared\Contracts\NfAdminMarkup as ContractsSettingsMarkup;
use NinjaForms\CiviCrmSdk\Contracts\CiviObjectsFactory;

use NinjaForms\CiviCrmShared\Contracts\LoggerInterface;

use NinjaForms\CiviCrmShared\Abstracts\Master as SharedAbstractsMaster;

use NinjaForms\CiviCrmShared\Handlers\DataModelProvider;
use NinjaForms\CiviCrmShared\Handlers\NfAdminMarkup as NfAdminMarkup;
use NinjaForms\CiviCrmShared\Handlers\TransientLogger;

use NinjaForms\CiviCrm\Factories\MasterFactory;
use NinjaForms\CiviCrmSdk\Master as CiviCrmSdkMaster;

/**
 * Master class for Ninja Forms CiviCrm
 *
 * The Master class is the primary class for a given package.  The plugin will
 * have a master class and packages such as an internal SDK for integration can
 * also have its own master class, depending on the complexity.
 *
 * The Master class extends the abstract Master class in the Shared directory;
 * the abstract class standardizes common functionality such as registering
 * plugin settings or advanced form settings.  In doing so, the package
 * developer can focus on the specific plugin functionality.
 *
 * The `registerServices` method uses a Container to register and provide
 * dependent classes downstream.  In certain cases, such as complex class
 * construction, classes requiring run-time construction, or a large family of
 * similar classes, this class can register a factory, which then delivers the
 * other classes as requested. 
 *
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

        // SDK master 
        $this->singleton(CiviCrmSdkMaster::class, function () {

            return (new CiviCrmSdkMaster())->registerServices();
        });

        $this->singleton(LoggerInterface::class,function(){

            return new TransientLogger('nf_civicrm');
        });

        // Factory
        $this->singleton(MasterFactory::class, function () {
            return new MasterFactory(
                $this->configure,
                $this->make(LoggerInterface::class),
                $this->make(CiviCrmSdkMaster::class)
                    ->make(CiviObjectsFactory::class)
            );
        });

        // Shared DataModelProvider
        $this->singleton(ContractsDataModelProvider::class, function () {

            return new DataModelProvider();
        });

        // Shared NFSettingsMarkup
        $this->singleton(ContractsSettingsMarkup::class, function () {

            return new NfAdminMarkup();
        });
        


        return $this;
    }
}
