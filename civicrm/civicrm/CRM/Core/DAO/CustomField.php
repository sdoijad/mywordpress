<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from xml/schema/CRM/Core/CustomField.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:1bdc1de3a50a96d48b70369e4ff8c97f)
 */

/**
 * Database access object for the CustomField entity.
 */
class CRM_Core_DAO_CustomField extends CRM_Core_DAO {
  const EXT = 'civicrm';
  const TABLE_ADDED = '1.1';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_custom_field';

  /**
   * Field to show when displaying a record.
   *
   * @var string
   */
  public static $_labelField = 'label';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = TRUE;

  /**
   * Paths for accessing this entity in the UI.
   *
   * @var string[]
   */
  protected static $_paths = [
    'add' => 'civicrm/admin/custom/group/field/add?reset=1&action=add&gid=[custom_group_id]',
    'update' => 'civicrm/admin/custom/group/field/update?action=update&reset=1&id=[id]&gid=[custom_group_id]',
    'preview' => 'civicrm/admin/custom/group/preview?reset=1&fid=[id]',
    'delete' => 'civicrm/admin/custom/group/field/delete?reset=1&id=[id]',
    'move' => 'civicrm/admin/custom/group/field/move?reset=1&fid=[id]',
  ];

  /**
   * Unique Custom Field ID
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $id;

  /**
   * FK to civicrm_custom_group.
   *
   * @var int|string
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $custom_group_id;

  /**
   * Variable name/programmatic handle for this field.
   *
   * @var string|null
   *   (SQL type: varchar(64))
   *   Note that values will be retrieved from the database as a string.
   */
  public $name;

  /**
   * Text for form field label (also friendly name for administering this custom property).
   *
   * @var string
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $label;

  /**
   * Controls location of data storage in extended_data table.
   *
   * @var string
   *   (SQL type: varchar(16))
   *   Note that values will be retrieved from the database as a string.
   */
  public $data_type;

  /**
   * HTML types plus several built-in extended types.
   *
   * @var string
   *   (SQL type: varchar(32))
   *   Note that values will be retrieved from the database as a string.
   */
  public $html_type;

  /**
   * Use form_options.is_default for field_types which use options.
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $default_value;

  /**
   * Is a value required for this property.
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_required;

  /**
   * Is this property searchable.
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_searchable;

  /**
   * Is this property range searchable.
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_search_range;

  /**
   * Controls field display order within an extended property group.
   *
   * @var int|string
   *   (SQL type: int)
   *   Note that values will be retrieved from the database as a string.
   */
  public $weight;

  /**
   * Description and/or help text to display before this field.
   *
   * @var string|null
   *   (SQL type: text)
   *   Note that values will be retrieved from the database as a string.
   */
  public $help_pre;

  /**
   * Description and/or help text to display after this field.
   *
   * @var string|null
   *   (SQL type: text)
   *   Note that values will be retrieved from the database as a string.
   */
  public $help_post;

  /**
   * Optional format instructions for specific field types, like date types.
   *
   * @var string|null
   *   (SQL type: varchar(64))
   *   Note that values will be retrieved from the database as a string.
   */
  public $mask;

  /**
   * Store collection of type-appropriate attributes, e.g. textarea  needs rows/cols attributes
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $attributes;

  /**
   * Optional scripting attributes for field.
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $javascript;

  /**
   * Is this property active?
   *
   * @var bool|string|null
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_active;

  /**
   * Is this property set by PHP Code? A code field is viewable but not editable
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_view;

  /**
   * number of options per line for checkbox and radio
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $options_per_line;

  /**
   * field length if alphanumeric
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $text_length;

  /**
   * Date may be up to start_date_years years prior to the current date.
   *
   * @var int|string|null
   *   (SQL type: int)
   *   Note that values will be retrieved from the database as a string.
   */
  public $start_date_years;

  /**
   * Date may be up to end_date_years years after the current date.
   *
   * @var int|string|null
   *   (SQL type: int)
   *   Note that values will be retrieved from the database as a string.
   */
  public $end_date_years;

  /**
   * date format for custom date
   *
   * @var string|null
   *   (SQL type: varchar(64))
   *   Note that values will be retrieved from the database as a string.
   */
  public $date_format;

  /**
   * time format for custom date
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $time_format;

  /**
   * Number of columns in Note Field
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $note_columns;

  /**
   * Number of rows in Note Field
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $note_rows;

  /**
   * Name of the column that holds the values for this field.
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $column_name;

  /**
   * For elements with options, the option group id that is used
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $option_group_id;

  /**
   * Serialization method - a non-zero value indicates a multi-valued field.
   *
   * @var int|string
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $serialize;

  /**
   * Stores Contact Get API params contact reference custom fields. May be used for other filters in the future.
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $filter;

  /**
   * Should the multi-record custom field values be displayed in tab table listing
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $in_selector;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_custom_field';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? ts('Custom Fields') : ts('Custom Field');
  }

  /**
   * Returns foreign keys and entity references.
   *
   * @return array
   *   [CRM_Core_Reference_Interface]
   */
  public static function getReferenceColumns() {
    if (!isset(Civi::$statics[__CLASS__]['links'])) {
      Civi::$statics[__CLASS__]['links'] = static::createReferenceColumns(__CLASS__);
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'custom_group_id', 'civicrm_custom_group', 'id');
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'option_group_id', 'civicrm_option_group', 'id');
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'links_callback', Civi::$statics[__CLASS__]['links']);
    }
    return Civi::$statics[__CLASS__]['links'];
  }

  /**
   * Returns all the column names of this table
   *
   * @return array
   */
  public static function &fields() {
    if (!isset(Civi::$statics[__CLASS__]['fields'])) {
      Civi::$statics[__CLASS__]['fields'] = [
        'id' => [
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Custom Field ID'),
          'description' => ts('Unique Custom Field ID'),
          'required' => TRUE,
          'where' => 'civicrm_custom_field.id',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'html' => [
            'type' => 'Number',
          ],
          'readonly' => TRUE,
          'add' => '1.1',
        ],
        'custom_group_id' => [
          'name' => 'custom_group_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Custom Group ID'),
          'description' => ts('FK to civicrm_custom_group.'),
          'required' => TRUE,
          'where' => 'civicrm_custom_field.custom_group_id',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'FKClassName' => 'CRM_Core_DAO_CustomGroup',
          'html' => [
            'type' => 'Select',
            'label' => ts("Custom Group"),
          ],
          'pseudoconstant' => [
            'table' => 'civicrm_custom_group',
            'keyColumn' => 'id',
            'labelColumn' => 'title',
          ],
          'add' => '1.1',
        ],
        'name' => [
          'name' => 'name',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Custom Field Name'),
          'description' => ts('Variable name/programmatic handle for this field.'),
          'maxlength' => 64,
          'size' => CRM_Utils_Type::BIG,
          'where' => 'civicrm_custom_field.name',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '3.3',
        ],
        'label' => [
          'name' => 'label',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Custom Field Label'),
          'description' => ts('Text for form field label (also friendly name for administering this custom property).'),
          'required' => TRUE,
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_custom_field.label',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 1,
          'add' => '1.1',
        ],
        'data_type' => [
          'name' => 'data_type',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Data Type'),
          'description' => ts('Controls location of data storage in extended_data table.'),
          'required' => TRUE,
          'maxlength' => 16,
          'size' => CRM_Utils_Type::TWELVE,
          'where' => 'civicrm_custom_field.data_type',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'html' => [
            'type' => 'Select',
            'label' => ts("Data Type"),
          ],
          'pseudoconstant' => [
            'callback' => 'CRM_Core_BAO_CustomField::dataType',
          ],
          'add' => '1.1',
        ],
        'html_type' => [
          'name' => 'html_type',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('HTML Type'),
          'description' => ts('HTML types plus several built-in extended types.'),
          'required' => TRUE,
          'maxlength' => 32,
          'size' => CRM_Utils_Type::MEDIUM,
          'where' => 'civicrm_custom_field.html_type',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'html' => [
            'type' => 'Select',
            'label' => ts("Field Input Type"),
          ],
          'pseudoconstant' => [
            'callback' => 'CRM_Core_SelectValues::customHtmlType',
          ],
          'add' => '1.1',
        ],
        'default_value' => [
          'name' => 'default_value',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Custom Field Default'),
          'description' => ts('Use form_options.is_default for field_types which use options.'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_custom_field.default_value',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '1.1',
        ],
        'is_required' => [
          'name' => 'is_required',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Custom Field Is Required?'),
          'description' => ts('Is a value required for this property.'),
          'required' => TRUE,
          'where' => 'civicrm_custom_field.is_required',
          'default' => '0',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '1.1',
        ],
        'is_searchable' => [
          'name' => 'is_searchable',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Allow Searching on Field?'),
          'description' => ts('Is this property searchable.'),
          'required' => TRUE,
          'where' => 'civicrm_custom_field.is_searchable',
          'default' => '0',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '1.1',
        ],
        'is_search_range' => [
          'name' => 'is_search_range',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Search as a Range'),
          'description' => ts('Is this property range searchable.'),
          'required' => TRUE,
          'where' => 'civicrm_custom_field.is_search_range',
          'default' => '0',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '1.4',
        ],
        'weight' => [
          'name' => 'weight',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Order'),
          'description' => ts('Controls field display order within an extended property group.'),
          'required' => TRUE,
          'where' => 'civicrm_custom_field.weight',
          'default' => '1',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '1.1',
        ],
        'help_pre' => [
          'name' => 'help_pre',
          'type' => CRM_Utils_Type::T_TEXT,
          'title' => ts('Custom Field Pre Text'),
          'description' => ts('Description and/or help text to display before this field.'),
          'where' => 'civicrm_custom_field.help_pre',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 1,
          'add' => '1.1',
        ],
        'help_post' => [
          'name' => 'help_post',
          'type' => CRM_Utils_Type::T_TEXT,
          'title' => ts('Custom Field Post Text'),
          'description' => ts('Description and/or help text to display after this field.'),
          'where' => 'civicrm_custom_field.help_post',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 1,
          'add' => '1.1',
        ],
        'mask' => [
          'name' => 'mask',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Custom Field Formatting'),
          'description' => ts('Optional format instructions for specific field types, like date types.'),
          'maxlength' => 64,
          'size' => CRM_Utils_Type::BIG,
          'where' => 'civicrm_custom_field.mask',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '1.1',
        ],
        'attributes' => [
          'name' => 'attributes',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Custom Field Attributes'),
          'description' => ts('Store collection of type-appropriate attributes, e.g. textarea  needs rows/cols attributes'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_custom_field.attributes',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '1.1',
        ],
        'javascript' => [
          'name' => 'javascript',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Custom Field Javascript'),
          'description' => ts('Optional scripting attributes for field.'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_custom_field.javascript',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '1.1',
        ],
        'is_active' => [
          'name' => 'is_active',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Custom Field Is Active?'),
          'description' => ts('Is this property active?'),
          'where' => 'civicrm_custom_field.is_active',
          'default' => '1',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '1.1',
        ],
        'is_view' => [
          'name' => 'is_view',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Field is Viewable'),
          'description' => ts('Is this property set by PHP Code? A code field is viewable but not editable'),
          'required' => TRUE,
          'where' => 'civicrm_custom_field.is_view',
          'default' => '0',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '1.1',
        ],
        'options_per_line' => [
          'name' => 'options_per_line',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Field Options Per Line'),
          'description' => ts('number of options per line for checkbox and radio'),
          'where' => 'civicrm_custom_field.options_per_line',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => NULL,
        ],
        'text_length' => [
          'name' => 'text_length',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Field Length'),
          'description' => ts('field length if alphanumeric'),
          'where' => 'civicrm_custom_field.text_length',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '2.2',
        ],
        'start_date_years' => [
          'name' => 'start_date_years',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Field Start Date'),
          'description' => ts('Date may be up to start_date_years years prior to the current date.'),
          'where' => 'civicrm_custom_field.start_date_years',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '1.4',
        ],
        'end_date_years' => [
          'name' => 'end_date_years',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Field End Date'),
          'description' => ts('Date may be up to end_date_years years after the current date.'),
          'where' => 'civicrm_custom_field.end_date_years',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '1.4',
        ],
        'date_format' => [
          'name' => 'date_format',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Field Data Format'),
          'description' => ts('date format for custom date'),
          'maxlength' => 64,
          'size' => CRM_Utils_Type::BIG,
          'where' => 'civicrm_custom_field.date_format',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'pseudoconstant' => [
            'callback' => 'CRM_Core_SelectValues::getDatePluginInputFormats',
          ],
          'add' => '3.1',
        ],
        'time_format' => [
          'name' => 'time_format',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Field Time Format'),
          'description' => ts('time format for custom date'),
          'where' => 'civicrm_custom_field.time_format',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'pseudoconstant' => [
            'callback' => 'CRM_Core_SelectValues::getTimeFormats',
          ],
          'add' => '3.1',
        ],
        'note_columns' => [
          'name' => 'note_columns',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Field Note Columns'),
          'description' => ts('Number of columns in Note Field'),
          'where' => 'civicrm_custom_field.note_columns',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '1.4',
        ],
        'note_rows' => [
          'name' => 'note_rows',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Field Note Rows'),
          'description' => ts('Number of rows in Note Field'),
          'where' => 'civicrm_custom_field.note_rows',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '1.4',
        ],
        'column_name' => [
          'name' => 'column_name',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Field Column Name'),
          'description' => ts('Name of the column that holds the values for this field.'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_custom_field.column_name',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '2.0',
        ],
        'option_group_id' => [
          'name' => 'option_group_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Field Option Group ID'),
          'description' => ts('For elements with options, the option group id that is used'),
          'where' => 'civicrm_custom_field.option_group_id',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'FKClassName' => 'CRM_Core_DAO_OptionGroup',
          'html' => [
            'label' => ts("Field Option Group"),
          ],
          'pseudoconstant' => [
            'table' => 'civicrm_option_group',
            'keyColumn' => 'id',
            'labelColumn' => 'title',
          ],
          'add' => '1.4',
        ],
        'serialize' => [
          'name' => 'serialize',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Serialize'),
          'description' => ts('Serialization method - a non-zero value indicates a multi-valued field.'),
          'required' => TRUE,
          'where' => 'civicrm_custom_field.serialize',
          'default' => '0',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'pseudoconstant' => [
            'callback' => 'CRM_Core_SelectValues::fieldSerialization',
          ],
          'add' => '5.27',
        ],
        'filter' => [
          'name' => 'filter',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Field Filter'),
          'description' => ts('Stores Contact Get API params contact reference custom fields. May be used for other filters in the future.'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_custom_field.filter',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '4.1',
        ],
        'in_selector' => [
          'name' => 'in_selector',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Field Display'),
          'description' => ts('Should the multi-record custom field values be displayed in tab table listing'),
          'required' => TRUE,
          'where' => 'civicrm_custom_field.in_selector',
          'default' => '0',
          'table_name' => 'civicrm_custom_field',
          'entity' => 'CustomField',
          'bao' => 'CRM_Core_BAO_CustomField',
          'localizable' => 0,
          'add' => '4.5',
        ],
      ];
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'fields_callback', Civi::$statics[__CLASS__]['fields']);
    }
    return Civi::$statics[__CLASS__]['fields'];
  }

  /**
   * Return a mapping from field-name to the corresponding key (as used in fields()).
   *
   * @return array
   *   Array(string $name => string $uniqueName).
   */
  public static function &fieldKeys() {
    if (!isset(Civi::$statics[__CLASS__]['fieldKeys'])) {
      Civi::$statics[__CLASS__]['fieldKeys'] = array_flip(CRM_Utils_Array::collect('name', self::fields()));
    }
    return Civi::$statics[__CLASS__]['fieldKeys'];
  }

  /**
   * Returns the names of this table
   *
   * @return string
   */
  public static function getTableName() {
    return CRM_Core_DAO::getLocaleTableName(self::$_tableName);
  }

  /**
   * Returns if this table needs to be logged
   *
   * @return bool
   */
  public function getLog() {
    return self::$_log;
  }

  /**
   * Returns the list of fields that can be imported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &import($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'custom_field', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of fields that can be exported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &export($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'custom_field', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of indices
   *
   * @param bool $localize
   *
   * @return array
   */
  public static function indices($localize = TRUE) {
    $indices = [
      'UI_label_custom_group_id' => [
        'name' => 'UI_label_custom_group_id',
        'field' => [
          0 => 'label',
          1 => 'custom_group_id',
        ],
        'localizable' => TRUE,
        'unique' => TRUE,
        'sig' => 'civicrm_custom_field::1::label::custom_group_id',
      ],
      'UI_name_custom_group_id' => [
        'name' => 'UI_name_custom_group_id',
        'field' => [
          0 => 'name',
          1 => 'custom_group_id',
        ],
        'localizable' => FALSE,
        'unique' => TRUE,
        'sig' => 'civicrm_custom_field::1::name::custom_group_id',
      ],
    ];
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }

}
