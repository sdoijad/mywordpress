<?php

/**
 * Action settings for email
 */
return [
    'email_field_map' => [
        'name' => 'email_field_map',
        'type' => 'option-repeater',
        'label' => __('Create Emails Linked to Contact', 'ninja-forms-civicrm') . ' <a href="#" class="nf-add-new">' . __('Add New', 'ninja-forms-civicrm') . '</a>',
        'width' => 'full',
        'group' => 'primary',
        'tmpl_row' => 'nf-tmpl-civicrm-email-map-row',
        'autobuild' => true,
        'value' => '',
        'columns' => [
            'email' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'autobuild_label' => __('Email Address', 'ninja-forms-civicrm'),
                'default' => '',
                'options' => []
            ],
            'location_type_id_name' => [
                'autobuild_label' => __('Location Name', 'ninja-forms-civicrm'),
                'header' => __('', 'ninja-forms-civicrm'),
                'default' => '',
                'type' => 'select',
                'options' => [
                    [
                        'label' => 'Billing',
                        'value' => 'Billing'
                    ],
                    [
                        'label' => 'Main',
                        'value' => 'Main'
                    ],
                    [
                        'label' => 'Home',
                        'value' => 'Home'
                    ],
                    [
                        'label' => 'Other',
                        'value' => 'Other'
                    ],
                    [
                        'label' => 'Work',
                        'value' => 'Work'
                    ],
                ]

            ]
        ],
    ]
];
