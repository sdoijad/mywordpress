<?php

/**
 * Action settings for line items
 */
return [
    'line_item_field_map' => [
        'name' => 'line_item_field_map',
        'type' => 'option-repeater',
        'label' => __('Add a line item Linked to Contact', 'ninja-forms-civicrm') . ' <a href="#" class="nf-add-new">' . __('Add New', 'ninja-forms-civicrm') . '</a>',
        'width' => 'full',
        'group' => 'primary',
        'tmpl_row' => 'nf-tmpl-line-item-map-row',
        'autobuild' => true,
        'value' => '',
        'columns' => [
            'entity_type' => [
                'header' => '',
                'default' => '',
                'options' => [
                    [
                        'label' => '- please select -',
                        'value' => 'none'
                    ],
                    [
                        'label' => 'Participant',
                        'value' => 'civicrm_participant'
                    ],
                    [
                        'label' => 'Membership',
                        'value' => 'civicrm_membership'
                    ]
                ],
                'autobuild_label' => 'Entity Type'
            ],
            'qty' => [
                'header' => '',
                'default' => '',
                'options' => [],
                'autobuild_label'=>'Quantity'
            ],
            'unit_price' => [
                'header' => '',
                'default' => '',
                'options' => [],
                'autobuild_label'=>'Unit Price'
            ],
            'line_total' => [
                'header' => '',
                'default' => '',
                'options' => [],
                'autobuild_label'=>'Line Total'
            ],
            'price_field_id' => [
                'header' => '',
                'default' => '',
                'options' => [],
                'autobuild_label'=>'Price Field Id'
            ],
            'price_field_value_id' => [
                'header' => '',
                'default' => '',
                'options' => [],
                'autobuild_label'=>'Price Field Value Id'
            ],
            'linked_record_id' => [
                'header' => '',
                'default' => '',
                'options' => [],
                'autobuild_label'=>'Linked Record Id'
            ]
        ],
    ],
];
