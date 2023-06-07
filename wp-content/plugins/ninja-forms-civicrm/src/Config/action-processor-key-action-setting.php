<?php

/**
 * Processing key to uniquely identify action during processing
 *
 * Form submissions can have multiple instances of the same action.  This key
 * serves as an identifier for each individual instance.
 */
return [
    'action_processor_key' => [
        'name' => 'action_processor_key',
        'type' => 'textbox',
        'label' => __('Optional Unique Key for Multiple CiviCRM Requests', 'ninja-forms-civicrm'),
        'width' => 'full',
        'group' => 'advanced',
        'value' => '',
        'columns' => [],
        'use_merge_tags' => false
    ],
];
