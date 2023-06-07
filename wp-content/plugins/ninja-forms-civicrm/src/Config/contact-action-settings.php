<?php 

/**
 * Action settings configuration for Contact
 */
return [
    /**
     * Option repeater rows to point one submission field to a CRM field.  
     */
    'contact_field_map' => [
        'name' => 'contact_field_map',
        'type' => 'option-repeater',
        'label' => __('Field Mapping for Contact', 'ninja-forms-civicrm') . ' <a href="#" class="nf-add-new">' . __('Add New', 'ninja-forms-civicrm') . '</a>',
        'width' => 'full',
        'group' => 'primary',
        'autobuild'=>true,
        'tmpl_row' => 'nf-tmpl-formfield-crmfield-map-row',
        'value' => '',
        'columns' => [
            'form_field' => [
                'autobuild_label' =>__( 'Form Field', 'ninja-forms-civicrm'),
                'header' => __('', 'ninja-forms-civicrm'),
                'default' => '',
                'options' => []
            ],
            'crm_field' => [
                'autobuild_label' =>__( 'CiviCRM Field', 'ninja-forms-civicrm'),
                'header' => __('', 'ninja-forms-civicrm'),
                'default' => '',
                'class'=> 'nf-select',
                'options' => [], // created on constuction
            ]
        ],
    ],
    'contact_type'=>[
        'name'=>'contact_type',
        'type'=>'select',
        'label'=> __('Contact Type', 'ninja-forms-civicrm'),
        'width'=>'one-half',
        'group'=>'primary',
        'value'=>'',
        'options'=>[]
    ],
    'contact_sub_type'=>[
        'name'=>'contact_sub_type',
        'type'=>'select',
        'label'=> __('Contact Subtype', 'ninja-forms-civicrm'),
        'width'=>'one-half',
        'group'=>'primary',
        'value'=>'',
        'options'=>[]
    ],
    /**
     * How to handle matching existing records
     */
    'contact_match_options' => [
        'name' => 'contact_match_options',
        'type' => 'select',
        'label' => __('Use Dedupe Rule Group', 'ninja-forms-civicrm'),
        'width' => 'full',
        'group' => 'advanced',
        'tmpl_row' => '',
        'value' => 'do_not_match',
        'options' => [ // options moved to CreateChainedContact for run time construction
                ],
    ],
];