<?php
use CRM_CivicrmAdminUi_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_User_defined_Profiles',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'unmodified',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'User_defined_Profiles',
        'label' => E::ts('Administer Profiles'),
        'form_values' => NULL,
        'mapping_id' => NULL,
        'search_custom_id' => NULL,
        'api_entity' => 'UFGroup',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'title',
            'frontend_title',
            'created_id.display_name',
            'description',
            'group_type',
            'is_reserved',
            'is_active',
            'COUNT(UFGroup_UFField_uf_group_id_01.id) AS COUNT_UFGroup_UFField_uf_group_id_01_id',
          ],
          'orderBy' => [],
          'where' => [],
          'groupBy' => [
            'id',
          ],
          'join' => [
            [
              'UFField AS UFGroup_UFField_uf_group_id_01',
              'LEFT',
              [
                'id',
                '=',
                'UFGroup_UFField_uf_group_id_01.uf_group_id',
              ],
            ],
          ],
          'having' => [],
        ],
        'expires_date' => NULL,
        'description' => NULL,
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_User_defined_Profiles_SearchDisplay_User_defined_Profiles',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'unmodified',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'User_defined_Profiles',
        'label' => E::ts('Administer Profiles'),
        'saved_search_id.name' => 'User_defined_Profiles',
        'type' => 'table',
        'settings' => [
          'actions' => FALSE,
          'limit' => 50,
          'classes' => [
            'table',
            'table-striped',
          ],
          'pager' => [
            'show_count' => TRUE,
            'expose_limit' => TRUE,
          ],
          'placeholder' => 5,
          'sort' => [],
          'columns' => [
            [
              'type' => 'field',
              'key' => 'id',
              'dataType' => 'String',
              'label' => E::ts('ID'),
              'sortable' => TRUE,
              'editable' => FALSE,
            ],
            [
              'type' => 'field',
              'key' => 'title',
              'dataType' => 'String',
              'label' => E::ts('Profile Title'),
              'sortable' => TRUE,
              'editable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'frontend_title',
              'dataType' => 'String',
              'label' => E::ts('Public Title'),
              'sortable' => TRUE,
              'editable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'created_id.display_name',
              'dataType' => 'String',
              'label' => E::ts('Created By'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'description',
              'dataType' => 'Text',
              'label' => E::ts('Description'),
              'sortable' => TRUE,
              'editable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'group_type',
              'dataType' => 'String',
              'label' => E::ts('Type'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'is_active',
              'dataType' => 'Boolean',
              'label' => E::ts('Enabled'),
              'sortable' => TRUE,
              'editable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'is_reserved',
              'dataType' => 'Boolean',
              'label' => E::ts('Reserved'),
              'sortable' => TRUE,
              'rewrite' => ' ',
              'icons' => [
                [
                  'icon' => 'fa-lock',
                  'side' => 'left',
                  'if' => ['is_reserved', '=', TRUE],
                ],
              ],
            ],
            [
              'size' => 'btn-xs',
              'links' => [
                [
                  'icon' => 'fa-pencil',
                  'text' => E::ts('Settings'),
                  'style' => 'default',
                  'condition' => ['is_reserved', '=', FALSE],
                  'entity' => 'UFGroup',
                  'action' => 'update',
                  'join' => '',
                  'target' => 'crm-popup',
                ],
                [
                  'path' => 'civicrm/admin/uf/group/field#/?uf_group_id=[id]',
                  'icon' => 'fa-list-alt',
                  'text' => E::ts('Fields') . ' ([COUNT_UFGroup_UFField_uf_group_id_01_id])',
                  'style' => 'default',
                  'condition' => [],
                  'entity' => '',
                  'action' => '',
                  'join' => '',
                  'target' => '',
                ],
              ],
              'type' => 'buttons',
              'alignment' => 'text-right',
            ],
            [
              'text' => '',
              'style' => 'default-outline',
              'size' => 'btn-xs',
              'icon' => 'fa-bars',
              'links' => [
                [
                  'text' => E::ts('Preview'),
                  'style' => 'default',
                  'condition' => ['COUNT_UFGroup_UFField_uf_group_id_01_id', '>', 0],
                  'entity' => 'UFGroup',
                  'action' => 'preview',
                  'join' => '',
                  'target' => 'crm-popup',
                  'icon' => 'fa-eye',
                ],
                [
                  'path' => 'civicrm/profile/create?gid=[id]&reset=1',
                  'icon' => 'fa-external-link',
                  'text' => E::ts('Use - Create Mode'),
                  'style' => 'default',
                  'condition' => [],
                  'entity' => '',
                  'action' => '',
                  'join' => '',
                  'target' => '_blank',
                ],
                [
                  'path' => 'civicrm/profile/edit?gid=[id]&reset=1',
                  'icon' => 'fa-external-link',
                  'text' => E::ts('Use - Edit Mode'),
                  'style' => 'default',
                  'condition' => [],
                  'entity' => '',
                  'action' => '',
                  'join' => '',
                  'target' => '_blank',
                ],
                [
                  'path' => 'civicrm/profile?gid=[id]&reset=1',
                  'icon' => 'fa-external-link',
                  'text' => E::ts('Use - Listing Mode'),
                  'style' => 'default',
                  'condition' => [],
                  'entity' => '',
                  'action' => '',
                  'join' => '',
                  'target' => '_blank',
                ],
                [
                  'icon' => 'fa-trash',
                  'text' => E::ts('Delete'),
                  'style' => 'danger',
                  'condition' => ['is_reserved', '=', FALSE],
                  'entity' => 'UFGroup',
                  'action' => 'delete',
                  'join' => '',
                  'target' => 'crm-popup',
                ],
              ],
              'type' => 'menu',
              'alignment' => 'text-right',
              'label' => '',
            ],
          ],
          'addButton' => [
            'path' => 'civicrm/admin/uf/group/add?action=add&reset=1',
            'text' => E::ts('Add Profile'),
            'icon' => 'fa-plus',
          ],
          'cssRules' => [
            [
              'disabled',
              'is_active',
              '=',
              FALSE,
            ],
          ],
        ],
        'acl_bypass' => FALSE,
      ],
    ],
  ],
];
