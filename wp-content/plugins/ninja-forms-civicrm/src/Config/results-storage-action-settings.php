<?php

/**
 * Action setting to store or disable storage of results
 *
 * Responses from requests can be stored for later use, such as diagnostics;
 * this option asks form designers if they wish to disable the storage.
 */
return [
    'disable_results_storage' => [
        'name' => 'disable_results_storage',
        'type' => 'toggle',
        'label' => __('Disable storing submission diagnostic data', 'ninja-forms-civicrm'),
        'width' => 'one-half',
        'group' => 'advanced',
        'tmpl_row' => '',
        'value' => '',
        'columns' => [],
        'use_merge_tags' => false
    ],
];
