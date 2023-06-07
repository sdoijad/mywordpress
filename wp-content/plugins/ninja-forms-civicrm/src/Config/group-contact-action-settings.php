<?php

/**
 * Action settings to subscribe contact to group (Civi mailing list)
 */
return [
    'create_group_contact' => [
        'name' => 'create_group_contact',
        'type' => 'option-repeater',
        'label' => __('Subscribe Contact to Group', 'ninja-forms-civicrm') . ' <a href="#" class="nf-add-new">' . __('Add New', 'ninja-forms-civicrm') . '</a>',
        'width' => 'full',
        'group' => 'primary',
        'tmpl_row' => 'nf-tmpl-civicrm-group-contact-row',
        'autobuild' => true,
        'value' => '',
        'columns' => [
            'group_id' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'autobuild_label' => __('Group', 'ninja-forms-civicrm'),
                'type' => 'select',
                'placeholder' => '',
                'default' => '',
                'options' => []
            ],
            'field_conditional' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'autobuild_label' => __('Static Conditional Form Field', 'ninja-forms-civicrm'),
                'type' => 'textbox',
                'default' => '',
                'options' => [],
                'use_merge_tags' => true
            ],
            'field_conditional_match_value' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'autobuild_label' => __('Conditional Value', 'ninja-forms-civicrm'),
                'type' => 'textbox',
                'default' => '',
                'options' => []
            ],

        ],
    ],
];
