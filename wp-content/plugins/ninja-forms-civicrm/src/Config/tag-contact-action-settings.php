<?php

/**
 * Action settings to subscribe contact to group (Civi mailing list)
 */
return [
    'create_entity_tag' => [
        'name' => 'create_entity_tag',
        'type' => 'option-repeater',
        'label' => __('Tag Entity', 'ninja-forms-civicrm') . ' <a href="#" class="nf-add-new">' . __('Add New', 'ninja-forms-civicrm') . '</a>',
        'width' => 'full',
        'group' => 'primary',
        'tmpl_row' => 'nf-tmpl-civicrm-tag-contact-row',
        'value' => '',
        'autobuild' => true,
        'columns' => [
            'tag_id' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'autobuild_label' => __('Tag', 'ninja-forms-civicrm'),
                'type' => 'select',
                'placeholder' => '',
                'default' => '',
                'options' => [],
            ],
            'field_conditional' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'type' => 'textbox',
                'default' => '',
                'options' => [],
                'use_merge_tags' => true,
                'autobuild_label' => __('Static Conditional Form Field', 'ninja-forms-civicrm')
            ],
            'field_conditional_match_value' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'type' => 'textbox',
                'default' => '',
                'options' => [],
                'autobuild_label' => __('Conditional Value', 'ninja-forms-civicrm')
            ],
            'tagged_entity' => [
                'header' => __('', 'ninja-forms-civicrm'),
                'type' => 'hidden',
                'placeholder' => '',
                'default' => 'civicrm_contact',
                'options' => [],
                'autobuild_label' => 'Entity Type'
            ],
        ],
    ],
];
