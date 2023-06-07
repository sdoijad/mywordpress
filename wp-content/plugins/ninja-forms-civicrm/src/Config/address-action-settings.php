<?php

/**
 * Action settings for address
 */
return [
    'address_field_map' => [
        'name' => 'address_field_map',
        'type' => 'option-repeater',
        'label' => __('Create Addresses Linked to Contact', 'ninja-forms-civicrm') . ' <a href="#" class="nf-add-new">' . __('Add New', 'ninja-forms-civicrm') . '</a>',
        'width' => 'full',
        'group' => 'primary',
        'tmpl_row' => 'nf-tmpl-civicrm-address-map-row',
        'autobuild'=>true,
        'value' => '',
        'columns' => [
            'street_address' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'type' => 'textbox',
                'placeholder' => '',
                'default' => '',
                'options' => [],
                'autobuild_label'=>'Street Address'
            ],
            'city' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'type' => 'textbox',
                'default' => '',
                'options' => [],
                'autobuild_label'=>'City'
            ],
            'county_id' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'type' => 'textbox',
                'default' => '',
                'options' => [],
                'autobuild_label'=>'County'
            ],
            'state_province_id_name' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'type' => 'textbox',
                'default' => '',
                'options' => [],
                'autobuild_label'=>'State Province Id Name'
            ],
            'postal_code' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'type' => 'textbox',
                'default' => '',
                'options' => [],
                'autobuild_label'=>'Postal Code'
            ],
            'supplemental_address_1' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'type' => 'textbox',
                'default' => '',
                'options' => [],
                'autobuild_label'=>'Supplemental Address 1'
            ],
            'country_id_name' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'type' => 'textbox',
                'default' => '',
                'options' => [],
                'autobuild_label'=>'Country'
            ],
            'is_primary' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'type' => 'select',
                'default' => '0',
                'options' => [
                    [
                        'label'=>'Yes',
                        'value'=>'1'
                    ],
                    [
                        'label'=>'No',
                        'value'=>'0'
                    ]
                ],
                'autobuild_label'=>'Is Primary'
            ],
            'location_type_id_name' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'default' => '',
                'type'=>'select',
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
                ],
                'autobuild_label'=>'Location Type'
            ]
        ],
    ],
];
