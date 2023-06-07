<?php

namespace NinjaForms\CiviCrmShared\Abstracts;

use NinjaForms\CiviCrmShared\Contracts\Master as SharedContractsMaster;
use NinjaForms\CiviCrmShared\Entities\AdvancedSettings;
use NinjaForms\CiviCrmShared\Entities\PluginSettings;

use NinjaForms\CiviCrmShared\Handlers\Container;

use NinjaForms\CiviCrmShared\Handlers\Configure;
use NinjaForms\CiviCrmShared\Handlers\PluginSettingsRegistrar;
use NinjaForms\CiviCrmShared\Handlers\AdvancedSettingsRegistrar;
use NinjaForms\CiviCrmShared\Handlers\ActionRegistrar;
use NinjaForms\CiviCrmShared\Handlers\FormAction;
use NinjaForms\CiviCrmShared\Handlers\TemplateAutobuilder;

/**
 * Master class for Ninja Forms Extensions
 * 
 * Top level class for a given package, which includes not only a plugin, but
 * also an SDK library or other functional units that could benefit from a
 * single controlling class.  
 * For a plugin, this is instantiated by the bootstrap file.  As a container,
 * the master class registers primary dependencies that can be injected
 * into other classes.  To reduce clutter, dependencies can be grouped into
 * factories such that the master class provides factories to provide such
 * dependencies.
 */
abstract class Master extends Container implements SharedContractsMaster
{
    /** @var Configure */
    protected $configure;

    /**
     * Root directory
     *
     * @var string
     */
    protected $rootDirectory = '';

    /** @inheritDoc */
    abstract public function registerServices(): SharedContractsMaster;

    /**
     * Set root directory for the file and associated Configure class
     *
     * @param string $rootDir
     * @return Master
     */
    public function setRootDirectory(string $rootDirectory): Master
    {
        $this->rootDirectory = $rootDirectory;
        $this->configure = new Configure($this->rootDirectory);

        return $this;
    }

    public function registerPluginSettings(string $configFilename): string
    {
        try {
            $pluginSettingsArray = $this->configure($configFilename);

            $pluginSettings = PluginSettings::fromArray($pluginSettingsArray);

            $settingsRegistrar = (new PluginSettingsRegistrar($pluginSettings))->handle();
        } catch (\Throwable $e) {
            var_dump($e->getMessage());
        }
        return $settingsRegistrar->getFilterTag();
    }

    public function registerAdvancedSettings(string $configFilename): string
    {
        try {
            $advancedSettingsArray = $this->configure($configFilename);

            $advancedSettings = AdvancedSettings::fromArray($advancedSettingsArray);

            $advancedSettingsRegistrar = (new AdvancedSettingsRegistrar($advancedSettings))
                ->setRootDirectory($this->rootDirectory)
                ->handle();
        } catch (\Throwable $e) {
            var_dump($e->getMessage());
        }
        return $advancedSettingsRegistrar->getFilterTag();
    }


    /**
     * Registers a form action with NF Core
     *
     * @param FormAction $formAction
     * @return Master
     */
    public function registerAction(FormAction $formAction): Master
    {
        $actionRegistrar = new ActionRegistrar();
        
        $templateAutobuilder = new TemplateAutobuilder();

        $actionRegistrar
            ->setRootDirectory($this->rootDirectory)
            ->setTemplateAutobuilder($templateAutobuilder)
            ->handle($formAction);

        return $this;
    }

    protected function configure(string $filename): array
    {
        return $this->configure->configure($filename);
    }
    /**
     * Get root directory
     *
     * @return  string
     */
    public function getRootDirectory(): string
    {
        return $this->rootDirectory;
    }
}
