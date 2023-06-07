<?php

namespace NinjaForms\CiviCrm\Bootstraps;

use NinjaForms\CiviCrmShared\Handlers\ActionRegistrar;

use NinjaForms\CiviCrm\Master;
use NinjaForms\CiviCrm\Factories\MasterFactory;

/**
 * Bootstrap functionality hooked at plugins_loaded priority 5
 *
 * Runs before any plugins_loaded hooks not explicitly prioritized earlier than
 *      5. The bootstrap file calls this class with an action hook at
 *      'plugins_loaded' priority 5.  This enables anything in the class to run
 *      before any hooks not explicitly prioritized before plugin_loaded 5.
 *      This can be used for situations where the functionality container herein
 *      must be present for downstream classes.
 * 
 * @package Initializing
 */
class PluginsLoadedEarly
{

    /** @var Master */
    protected $master;

    /** @var MasterFactory */
    protected $factory;

    /** @var ActionRegistrar */
    protected $actionRegistrar;

    /**
     * Instantiate with a master class
     * 
     * Factory class is made to produce runtime dependencies
     * @param Master $master
     */
    public function __construct(Master $master)
    {
        $this->master = $master;

        $this->factory = $this->master->make(MasterFactory::class);

        if (!$this->preRegistrationCheck()) {
            return;
        }

        $this->registerActions();

        $this->registerSubmissionMetaboxes();
    }

    /**
     * Register plugin actions
     *
     * Create a FormAction class and pass it into master class's registerActions
     * method
     *
     * @return void
     */
    public function registerActions()
    {
        $createContact = $this->factory->createContactFormAction();
        $this->master->registerAction($createContact);
    }

    /**
     * Instantiate the submission metabox
     *
     * @see \NinjaForms\CiviCrm\Handlers\SubmissionMetabox
     * @return void
     */
    public function registerSubmissionMetaboxes(): void
    {
        $this->factory->submissionMetaboxCreateEntries();
    }

    /**
     * Check that any required external functionality is present
     *
     * For example, if other plugins are required, perform a check here; The
     * plugins may be active, but may not have initialized fully, so ensure that
     * the required specific functionality is available.  If it is not yet
     * available, move the dependent method to a later action hook.
     *
     * In this plugin, there is currently no pre-Registration check required,
     * but process flow is kept to ensure that it can easily be added with
     * minimal change after initial release.
     */
    protected function preRegistrationCheck(): bool
    {
        $return = true;

        // Conditionals for exit go here
        // CiviCRM is not active yet, so Civi functionality is deferred via factory to call at runtime
        return $return;
    }
}
