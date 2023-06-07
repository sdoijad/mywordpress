<?php

/**
 * Processing key to uniquely identify action during processing
 *
 * Form submissions can have multiple instances of the same action.  This key
 * serves as an identifier for each individual instance.
 */
return [
    'order_responsibility_key' => [
        'name' => 'order_responsibility_key',
        'type' => 'textbox',
        'label' => __('Contact responsible for order (use action processor key)', 'ninja-forms-civicrm'),
        'width' => 'one-half',
        'group' => 'advanced',
        'value' => '',
        'columns' => [],
        'use_merge_tags' => false
    ],
];
