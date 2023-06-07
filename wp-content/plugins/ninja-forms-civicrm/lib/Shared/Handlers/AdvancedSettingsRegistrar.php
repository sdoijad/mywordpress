<?php

namespace NinjaForms\CiviCrmShared\Handlers;

use NinjaForms\CiviCrmShared\Entities\AdvancedSettings;
use Throwable;

/**
 * Registers settings for forms' Advanced 
 * 
 * Provides a filter tag and passes the configured data such that
 * methods calling the tag can modify the configured settings at run 
 * time.
 */
class AdvancedSettingsRegistrar
{

    /**
     * AdvancedSettings entity
     *
     * @var AdvancedSettings
     */
    protected $advancedSettings;

    /**
     * Tag used to filter settings
     *
     * @var string
     */
    protected $filterTag;

    /**
     * Root directory
     *
     * @var string
     */
    protected $rootDirectory = '';

    /**
     * Construct with Settings Group  and Settings arrays
     *
     * @param array $settingsGroupArray
     * @param array $settingsArray
     */
    public function __construct(AdvancedSettings $advancedSettings)
    {
        $this->advancedSettings = $advancedSettings;

        $this->filterTag = 'filter-' . $this->advancedSettings->getId();
    }

    /**
     * Register the configured settings with NF core
     * 
     * Also passes data to a filter at run time
     *
     * @return AdvancedSettingsRegistrar
     */
    public function handle(): AdvancedSettingsRegistrar
    {

        add_filter('ninja_forms_from_settings_types', [$this, 'addAdvancedSettingsGroup'], 10, 1);

        add_filter('ninja_forms_localize_forms_settings', [$this, 'addAdvancedSettings'], 10, 1);

        add_action('ninja_forms_builder_templates', [$this, 'builderTemplates']);

        return $this;
    }


    /**
     * Add configured settings group to the NF groups
     * @param array $groups
     * @return array
     */
    public function addAdvancedSettingsGroup($groups)
    {
        if (!is_admin()) {
            return $groups;
        }

        $id = $this->advancedSettings->getId();

        $nicename = $this->advancedSettings->getNicename();

        $groups[$id] = [
            'id' => $id,
            'nicename' => $nicename
        ];

        return $groups;
    }
    /**
     * Add configured settings  to the gropu
     * @param array $settings
     * @return array
     */
    public function addAdvancedSettings($settings)
    {
        if (!is_admin()) {
            return $settings;
        }

        $advancedSettingsArray = $this->advancedSettings->getAdvancedSettingsArray();

        $addNewWap = array_map([$this, 'wrapAddNew'], $advancedSettingsArray);

        $filtered = apply_filters($this->filterTag, $addNewWap);

        $settings[$this->advancedSettings->getId()] = $filtered;

        return $settings;
    }

    /**
     * Add the markup to Add New option repeater entries
     * 
     * This is a helper function.  Option repeaters require this markup for
     * the JS builder to add the Add New UI.  Given the string of option
     * repeater text, this method adds the necessary markup.
     *
     * @param array $advancedSetting
     * @return array
     */
    protected function wrapAddNew(array $advancedSetting): array
    {
        if ('option-repeater' === $advancedSetting['type']) {

            $advancedSetting['label'] = '<a href="#" class="nf-add-new">' . esc_html__($advancedSetting['label'], 'ninja-forms') . '</a>';
        }
        return $advancedSetting;
    }


    /**
     * Loads a template for admin display
     *
     * @return void
     */
    public function builderTemplates()
    {
        $advancedSettingsArray = $this->advancedSettings->getAdvancedSettingsArray();

        $templates = \array_column($advancedSettingsArray, 'tmpl_row');

        foreach ($templates as $template) {
            $sharedFilename = \dirname(__DIR__, 1) . '/Templates/' . $template . '.html';

            $pluginSpecificTemplateFilename = $this->rootDirectory . '/Templates/' . $template . '.html';

            if (\file_exists($sharedFilename)) {

                include_once($sharedFilename);
            } elseif (\file_exists($pluginSpecificTemplateFilename)) {

                include_once($pluginSpecificTemplateFilename);
            }
        }
    }

    /**
     * Set root directory
     *
     * @param string $rootDirectory
     * @return AdvancedSettingsRegistrar
     */
    public function setRootDirectory(string $rootDirectory): AdvancedSettingsRegistrar
    {
        $this->rootDirectory = $rootDirectory;

        return $this;
    }

    /**
     * Get tag used to filter settings
     *
     * @return  string
     */
    public function getFilterTag(): string
    {
        return $this->filterTag;
    }
}
