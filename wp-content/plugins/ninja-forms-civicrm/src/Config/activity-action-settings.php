<?php 

/**
 * Action settings for activity
 */
return [
    'activity_type' => [
        'name' => 'activity_type',
        'type' => 'select',
        'label' => __('Create Activity Type', 'ninja-forms-civicrm') ,
        'width' => 'one-half',
        'group' => 'primary',
        'options'=>[], // populated at runtime
        'value' => '',
        'columns' => [
        ],
    ],
    'activity_status' => [
        'name' => 'activity_status',
        'type' => 'select',
        'label' => __('Create Activity Status', 'ninja-forms-civicrm') ,
        'width' => 'one-half',
        'group' => 'primary',
        'options'=>[], // populated at runtime
        'value' => '',
        'columns' => [
        ],
    ],
    'activity_field_map' => [
        'name' => 'activity_field_map',
        'type' => 'option-repeater',
        'label' => __('Create a Single Activity Linked to Contact', 'ninja-forms-civicrm') . ' <a href="#" class="nf-add-new">' . __('Add New', 'ninja-forms-civicrm') . '</a>',
        'width' => 'full',
        'group' => 'primary',
        'tmpl_row' => 'nf-tmpl-formfield-crmfield-map-row',
        'value' => '',
        'autobuild' =>  true,
        'columns' => [
            'form_field' => [
                'autobuild_label' => __('Form field', 'ninja-forms-civicrm'),
                'header' => __('', 'ninja-forms-civicrm'),
                'default' => '',
                'options' => []
            ],
            'crm_field' => [
                'autobuild_label' => __('Civi CRM field', 'ninja-forms-civicrm'),
                'header' => __('', 'ninja-forms-civicrm'),
                'default' => '',
                'type'  => 'select',
                'options' => [], // created on constuction
            ]
        ],
    ],

];