<?php

namespace NinjaForms\CiviCrmShared\Contracts;

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
interface Master
{

    /**
     * Register plugin settings with NF core
     *
     * @param string $configFilename
     * @return string Filter tag for modifying registered settings
     */
    public function registerPluginSettings(string $configFilename): string;

    /**
     * Register advanced settings with NF core
     *
     * @param string $configFilename
     * @return string Filter tag for modifying registered settings
     */
    public function registerAdvancedSettings(string $configFilename): string;

    /**
     * Register Services
     *
     * @return Master
     */
    public function registerServices(): Master;

}
