<?php

/**
 * Array constructing PluginSettings for the plugin
 * 
 * Initialized with default values, but SettingsOutputFilter can be used to 
 * modify the output with dynamic values at time of rendering
 * 
 * @package Settings
 */
return [
    'id' => 'nf_civicrm_plugin_settings_id',
    'label' => __('CiviCrm', 'ninja-forms-civicrm'),
    'pluginSettings' => [
        'nf_civicrm_button_controls' => [
            'id' => 'nf_civicrm_button_controls',
            'type' => 'html',
            'label' => '',
            'html' => ''
        ],
        'nf_civicrm_status' => [
            'id' => 'nf_civicrm_status',
            'type' => 'html',
            'label' => __('Status', 'ninja-forms-civicrm'),
            'html' => 'No new status update', // created on construction
        ],
        'nf_civicrm_diagnostic_result' => [
            'id' => 'nf_civicrm_diagnostic_result',
            'type' => 'html',
            'label' => __('Diagnostic Results', 'ninja-forms-civicrm'),
            'html' => 'No Results', // created on construction
        ],
        'nf_civicrm_show_diagnostics_on_startup' => [
            'id' => 'nf_civicrm_show_diagnostics_on_startup',
            'type' => 'checkbox',
            'label' => __('Show diagnostics on startup', 'ninja-forms-civicrm'),
            'html' => '',
        ],

    ]
];
