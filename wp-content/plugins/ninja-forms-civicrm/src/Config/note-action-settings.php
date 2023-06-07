<?php

/**
 * Action settings for note
 */
return [
    'note_field_map' => [
        'name' => 'note_field_map',
        'type' => 'option-repeater',
        'label' => __('Add Note to an Entity', 'ninja-forms-civicrm') . ' <a href="#" class="nf-add-new">' . __('Add New', 'ninja-forms-civicrm') . '</a>',
        'width' => 'full',
        'group' => 'primary',
        'tmpl_row' => 'nf-tmpl-civicrm-note-map-row',
        'autobuild'=>true,
        'value' => '',
        'columns' => [
            'subject' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'type' => 'textbox',
                'placeholder' => '',
                'default' => '',
                'options' => [],
                'use_merge_tags' => true,
                'autobuild_label' =>__( 'Subject', 'ninja-forms-civicrm')
            ],
            'note' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'type' => 'textbox',
                'placeholder' => '',
                'default' => '',
                'options' => [],
                'use_merge_tags' => true,
                'autobuild_label' =>__( 'Note', 'ninja-forms-civicrm')
            ],
            'tagged_entity' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'type' => 'select',
                'placeholder' => '',
                'default' => '',
                'use_merge_tags' => false,
                'options' => [
                    [
                        'label'=>__('- please select -', 'ninja-forms-civicrm'),
                        'value'=>'none'
                    ],
                    [
                        'label'=>__('Contact', 'ninja-forms-civicrm'),
                        'value'=>'civicrm_contact'
                    ],
                    [
                        'label'=>__('Participant', 'ninja-forms-civicrm'),
                        'value'=>'civicrm_participant'
                    ],
                ],
                'autobuild_label' => 'Entity Type'
            ],
        ],
    ]
];
