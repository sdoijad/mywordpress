<?php

/**
 * Action settings for email
 */
return [
    'website_field_map' => [
        'name' => 'website_field_map',
        'type' => 'option-repeater',
        'label' => __('Create Websites Linked to Contact', 'ninja-forms-civicrm') . ' <a href="#" class="nf-add-new">' . __('Add New', 'ninja-forms-civicrm') . '</a>',
        'width' => 'full',
        'group' => 'primary',
        'tmpl_row' => 'nf-tmpl-civicrm-website-map-row',
        'autobuild'=>true,
        'value' => '',
        'columns' => [
            'url' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'default' => '',
                'options' => [],
                'autobuild_label' =>__( 'URL', 'ninja-forms-civicrm')
            ],
            'website_type_id_name' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'default' => '',
                'type'=>'select',
                'autobuild_label' =>__( 'Website Type', 'ninja-forms-civicrm'),
                'options' => [
                    [
                        'label' => 'Work',
                        'value' => 'Work'
                    ],
                    [
                        'label' => 'Main',
                        'value' => 'Main'
                    ],
                    [
                        'label' => 'Facebook',
                        'value' => 'Facebook'
                    ],
                    [
                        'label' => 'Instagram',
                        'value' => 'Instagram'
                    ],
                    [
                        'label' => 'LinkedIn',
                        'value' => 'LinkedIn'
                    ],
                    [
                        'label' => 'MySpace',
                        'value' => 'MySpace'
                    ],
                    [
                        'label' => 'Pinterest',
                        'value' => 'Pinterest'
                    ],
                    [
                        'label' => 'SnapChat',
                        'value' => 'SnapChat'
                    ],
                    [
                        'label' => 'Tumbler',
                        'value' => 'Tumbler'
                    ],
                    [
                        'label' => 'Twitter',
                        'value' => 'Twitter'
                    ],
                    [
                        'label' => 'Vine',
                        'value' => 'Vine'
                    ]
                ]

            ]
        ],
    ]
];
