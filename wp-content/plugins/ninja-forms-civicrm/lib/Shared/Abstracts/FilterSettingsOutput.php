<?php

namespace NinjaForms\CiviCrmShared\Abstracts;

/**
 * Modifies configured settings at run time
 * 
 * Plugin settings are configured by an array, which cannot easily construct
 * more complex output of HTML, nor readily access run-time parameters for
 * output onto the settings page.  This abstract class is constructed as early as
 * practical and hooks into a filter, defined by a string at construct.
 * Child implementations of this class provide a method that modifies the
 * configured array.  Because this happens a runtime, it has access to runtime
 * functionality that can dynamically adjust the output.  Also, being a class, it
 * can call on methods and classes to construct more complex markup than can
 * readily by done in the pre-configured array.
 * 
 * @package Settings
 */
abstract class FilterSettingsOutput
{

    /**
     * Incoming Settings Array
     *
     * @var array
     */
    protected $incomingSettings;

    /**
     * Settings after filtering
     *
     * @var array
     */
    protected $filteredSettings;

    /**
     * Tag used to filter settings
     *
     * @var string
     */
    protected $filterTag;

    public function __construct(string $filterTag)
    {
   
        $this->filterTag = $filterTag;

    }

    /**
     * Modify plugin settings at time of render
     *
     * @return FilterSettingsOutput
     */
    public function handle(): FilterSettingsOutput
    {
        add_filter($this->filterTag, [$this, 'filter']);
        return $this;
    }

    /**
     * Modify plugin settings at time of settings registration
     */
    abstract protected function modifyConfiguredSettings( ): void;

    /**
     * Modify configured settings at time of output
     *
     * @param array $incomingSettings
     * @return array
     */
    public function filter($incomingSettings): array
    {
        $this->incomingSettings = $incomingSettings;

        $this->filteredSettings = $this->incomingSettings;

        $this->modifyConfiguredSettings();

        return $this->filteredSettings;
    }

}
