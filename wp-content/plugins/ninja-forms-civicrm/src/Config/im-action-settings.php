<?php

/**
 * Action settings for IM
 */
return [
    'im_field_map' => [
        'name' => 'im_field_map',
        'type' => 'option-repeater',
        'label' => __('Create IM Linked to Contact', 'ninja-forms-civicrm') . ' <a href="#" class="nf-add-new">' . __('Add New', 'ninja-forms-civicrm') . '</a>',
        'width' => 'full',
        'group' => 'primary',
        'tmpl_row' => 'nf-tmpl-civicrm-im-map-row',
        'autobuild'=>true,
        'value' => '',
        'columns' => [
            'name' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'default' => '',
                'options' => [],
                'autobuild_label' =>__( 'Name', 'ninja-forms-civicrm')
            ],
            'location_type_id_name' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'default' => '',
                'type'=>'select',
                'autobuild_label' =>__( 'Location Type', 'ninja-forms-civicrm'),
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
