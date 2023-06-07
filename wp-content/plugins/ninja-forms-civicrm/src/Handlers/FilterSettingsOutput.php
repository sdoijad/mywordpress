<?php

namespace NinjaForms\CiviCrm\Handlers;

use NinjaForms\CiviCrmShared\Contracts\NfAdminMarkup;
use NinjaForms\CiviCrmShared\Abstracts\FilterSettingsOutput as AbstractsFilterSettingsOutput;

/**
 * Modify the configured plugin settings
 *
 * By extending the shared abstract class, this class is responsible for a
 * single method `modifyConfiguredSettings` to dynamically alter the plugin
 * settings.  This class creates a collection of UI buttons which, when coupled
 * with the AJAX handler class, provides single page UI functionality.
 * 
 * @package Settings
 */
class FilterSettingsOutput extends AbstractsFilterSettingsOutput
{
    /**  @var NfAdminMarkup */
    protected $markup;

    /**
     * Construct with filter tag and Markup object
     *
     * @param string $filterTag
     * @param NfAdminMarkup $markup
     */
    public function __construct(string $filterTag,  NfAdminMarkup $markup)
    {
        parent::__construct($filterTag);

        $this->markup = $markup;
    }

    /** @inheritDoc */
    protected function modifyConfiguredSettings(): void
    {
        $this->filteredSettings['nf_civicrm_button_controls']['html'] = $this->markupButtonControls();
    }

    /**
     * Add buttons to Settings page 
     */
    protected function markupButtonControls(): string
    {
        $markup = '';

        $markup .= $this->markup->markupButton(__('Verify Connection', 'ninja-forms-civicrm'), 'nf_civicrm_verify_db_connnection');
        $markup .= '  ';  // Spacing can be handled with CSS
        $markup .= $this->markup->markupButton(__('Show Diagnostics', 'ninja-forms-civicrm'), 'nf_civicrm_toggle_diagnostics');
        $markup .= '  ';  // Spacing can be handled with CSS
        $markup .= $this->markup->markupButton(__('List Events', 'ninja-forms-civicrm'), 'nf_civicrm_list_events');
        $markup .= '  ';  // Spacing can be handled with CSS
        $markup .= $this->markup->markupButton(__('List Tags', 'ninja-forms-civicrm'), 'nf_civicrm_list_tags');
        $markup .= '  ';  // Spacing can be handled with CSS
        $markup .= $this->markup->markupButton(__('List Groups', 'ninja-forms-civicrm'), 'nf_civicrm_list_groups');
        $markup .= '  ';  // Spacing can be handled with CSS
        $markup .= $this->markup->markupButton(__('View Log', 'ninja-forms-civicrm'), 'nf_civicrm_view_log');
        $markup .= '  ';  // Spacing can be handled with CSS
        $markup .= $this->markup->markupButton(__('Clear Log', 'ninja-forms-civicrm'), 'nf_civicrm_clear_log');

        return $markup;
    }
}
