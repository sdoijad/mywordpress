<?php

namespace NinjaForms\CiviCrmShared\Handlers;

use NinjaForms\CiviCrmShared\Entities\PluginSettings;

class PluginSettingsRegistrar
{

/**
 * PluginSettings entity
 *
 * @var PluginSettings
 */
    protected $pluginSettings;

    /**
     * Tag used to filter settings
     *
     * @var string
     */
    protected $filterTag;

    /**
     * Construct with Settings Group  and Settings arrays
     *
     * @param array $settingsGroupArray
     * @param array $settingsArray
     */
    public function __construct(PluginSettings $pluginSettings)
    {
        $this->pluginSettings = $pluginSettings;
        
        $this->filterTag = 'filter-'.$this->pluginSettings->getId();
    }

    public function handle(): PluginSettingsRegistrar
    {
        add_filter('ninja_forms_plugin_settings', array( $this, 'addPluginSettings' ), 10, 1);

        add_filter('ninja_forms_plugin_settings_groups', array( $this, 'addPluginSettingsGroup' ), 10, 1);

        return $this;
    }


    /**
     * Add configured settings group to the NF groups
     * @param array $groups
     * @return array
     */
    public function addPluginSettingsGroup($groups)
    {
        $id = $this->pluginSettings->getId();

        $label = $this->pluginSettings->getLabel();

        $groups[ $id] =[
            'id'=>$id,
            'label'=>$label
        ];

        return $groups;
    }
    /**
     * Add configured settings  to the gropu
     * @param array $settings
     * @return array
     */
    public function addPluginSettings($settings)
    {
        $pluginSettingsArray = $this->pluginSettings->getPluginSettingsArray();

        $filtered = apply_filters($this->filterTag, $pluginSettingsArray);

        $settings[ $this->pluginSettings->getId()] =$filtered;


        return $settings;
    }


    /**
     * Get tag used to filter settings
     *
     * @return  string
     */ 
    public function getFilterTag():string
    {
        return $this->filterTag;
    }
}
