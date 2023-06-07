<?php

namespace NinjaForms\CiviCrm\Bootstraps;

use NinjaForms\CiviCrmShared\Contracts\DataModelProvider;
use NinjaForms\CiviCrmShared\Contracts\NfAdminMarkup;
use NinjaForms\CiviCrmShared\Contracts\LoggerInterface;

use NinjaForms\CiviCrm\Factories\MasterFactory;

use NinjaForms\CiviCrm\Master;
use NinjaForms\CiviCrmShared\Handlers\AjaxRegistrar;
use NinjaForms\CiviCrm\Handlers\FilterSettingsOutput;
use NinjaForms\CiviCrm\Handlers\NfPluginSettingsAjax;
use \Civi\Api4\Contact as CiviContact;
/**
 * Bootstrap functionality hooked at init priority 15
 *
 * Default priority is 10; this runs after all init functions not explicitly
 * prioritized.
 *
 * The bootstrap file calls this class with an action hook at 'init' priority
 *      15.  This enables anything in the class to run after any init hooks not
 *      explicitly prioritized after init 15.  This can be used for situations
 *      where other plugins must be loaded and initialized before the
 *      functionality contained herein.
 *
 * @package Initializing
 */
class InitLate
{

    /** @var Master */
    protected $master;

    /** @var MasterFactory */
    protected $factory;

    public function __construct(Master $master)
    {
        $this->master = $master;

        $this->factory = $this->master->make(MasterFactory::class);

        if (!$this->preRegistrationCheck()) {
            return;
        }

        $this->pluginSettings();
    }

    /**
     * Register plugin setings and filter output
     *
     * Plugin settings are initialized from a configured array using the
     * PluginSettingsRegistrar. A FilterSettingsOutput class, which extends a
     * shared abstract class, is instantiated and gets passed those plugin
     * settings at run time, enabling it to dynamically adjust the configured
     * array values.  Finally, an NfPluginSettingsAjax class, which extends a
     * shared abstract class, activates AJAX functionality for the plugin
     * settings using a standardized hook and enqueuing.
     *
     *
     * @see \NinjaForms\CiviCrmShared\Handlers\PluginSettingsRegistrar
     * @see \NinjaForms\CiviCrm\Handlers\FilterSettingsOutput
     * @see \NinjaForms\CiviCrm\Handlers\NfPluginSettingsAjax
     */
    protected function pluginSettings(): void
    {
        $filterTag = $this->master->registerPluginSettings('PluginSettings');

        (new FilterSettingsOutput(
            $filterTag,
            $this->master->make(NfAdminMarkup::class)
        ))->handle();

        $ajaxHandler = new NfPluginSettingsAjax(
            $this->master->getRootDirectory(),
            $this->factory->verifyDbConnection(),
            $this->factory->dataAccessFactory()->event(),
            $this->factory->dataAccessFactory()->tag(),
            $this->factory->dataAccessFactory()->group(),
            $this->master->make(DataModelProvider::class),
            $this->master->make(NfAdminMarkup::class),
            $this->master->make(LoggerInterface::class)
        );

        new AjaxRegistrar($ajaxHandler);
    }

    /**
     * Check that any required external functionality is present
     *
     * For example, if other plugins are required, perform a check here; The
     * plugins may be active, but may not have initialized fully, so ensure that
     * the required specific functionality is available.  If it is not yet
     * available, move the dependent method to a later action hook.
     *
     * Since CivCrmSdk has added a 'bypass' function, we don't have to stop
     * functionality, instead we set the bypass that tells CiviCrmSdk to provide
     * the mock object instead of actual CiviObjects.
     */
    protected function preRegistrationCheck(): bool
    {
        $return = true;

        if (!class_exists(CiviContact::class)) {
            $this->factory->setBypassCivi(true);
        }

        return $return;
    }
}
