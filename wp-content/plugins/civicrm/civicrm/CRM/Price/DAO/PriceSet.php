<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from xml/schema/CRM/Price/PriceSet.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:244a7b5a3ad1505fcbbb3f66d3189ab0)
 */

/**
 * Database access object for the PriceSet entity.
 */
class CRM_Price_DAO_PriceSet extends CRM_Core_DAO {
  const EXT = 'civicrm';
  const TABLE_ADDED = '1.8';
  const COMPONENT = 'CiviContribute';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_price_set';

  /**
   * Field to show when displaying a record.
   *
   * @var string
   */
  public static $_labelField = 'title';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = TRUE;

  /**
   * Price Set
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $id;

  /**
   * Which Domain is this price-set for
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $domain_id;

  /**
   * Variable name/programmatic handle for this set of price fields.
   *
   * @var string
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $name;

  /**
   * Displayed title for the Price Set.
   *
   * @var string
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $title;

  /**
   * Is this price set active
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_active;

  /**
   * Description and/or help text to display before fields in form.
   *
   * @var string|null
   *   (SQL type: text)
   *   Note that values will be retrieved from the database as a string.
   */
  public $help_pre;

  /**
   * Description and/or help text to display after fields in form.
   *
   * @var string|null
   *   (SQL type: text)
   *   Note that values will be retrieved from the database as a string.
   */
  public $help_post;

  /**
   * Optional Javascript script function(s) included on the form with this price_set. Can be used for conditional
   *
   * @var string|null
   *   (SQL type: varchar(64))
   *   Note that values will be retrieved from the database as a string.
   */
  public $javascript;

  /**
   * What components are using this price set?
   *
   * @var string
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $extends;

  /**
   * FK to Financial Type(for membership price sets only).
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $financial_type_id;

  /**
   * Is set if edited on Contribution or Event Page rather than through Manage Price Sets
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_quick_config;

  /**
   * Is this a predefined system price set  (i.e. it can not be deleted, edited)?
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_reserved;

  /**
   * Minimum Amount required for this set.
   *
   * @var float|string|null
   *   (SQL type: decimal(20,2))
   *   Note that values will be retrieved from the database as a string.
   */
  public $min_amount;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_price_set';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? ts('Price Sets') : ts('Price Set');
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
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'domain_id', 'civicrm_domain', 'id');
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'financial_type_id', 'civicrm_financial_type', 'id');
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
          'title' => ts('Price Set'),
          'description' => ts('Price Set'),
          'required' => TRUE,
          'where' => 'civicrm_price_set.id',
          'table_name' => 'civicrm_price_set',
          'entity' => 'PriceSet',
          'bao' => 'CRM_Price_BAO_PriceSet',
          'localizable' => 0,
          'html' => [
            'type' => 'Number',
            'label' => ts("ID"),
          ],
          'readonly' => TRUE,
          'add' => '1.8',
        ],
        'domain_id' => [
          'name' => 'domain_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Domain ID'),
          'description' => ts('Which Domain is this price-set for'),
          'where' => 'civicrm_price_set.domain_id',
          'table_name' => 'civicrm_price_set',
          'entity' => 'PriceSet',
          'bao' => 'CRM_Price_BAO_PriceSet',
          'localizable' => 0,
          'FKClassName' => 'CRM_Core_DAO_Domain',
          'html' => [
            'type' => 'Text',
            'label' => ts("Domain"),
          ],
          'pseudoconstant' => [
            'table' => 'civicrm_domain',
            'keyColumn' => 'id',
            'labelColumn' => 'name',
          ],
          'add' => '3.1',
        ],
        'name' => [
          'name' => 'name',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Name'),
          'description' => ts('Variable name/programmatic handle for this set of price fields.'),
          'required' => TRUE,
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_price_set.name',
          'table_name' => 'civicrm_price_set',
          'entity' => 'PriceSet',
          'bao' => 'CRM_Price_BAO_PriceSet',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
            'label' => ts("Name"),
          ],
          'add' => '1.8',
        ],
        'title' => [
          'name' => 'title',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Price Set Title'),
          'description' => ts('Displayed title for the Price Set.'),
          'required' => TRUE,
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_price_set.title',
          'table_name' => 'civicrm_price_set',
          'entity' => 'PriceSet',
          'bao' => 'CRM_Price_BAO_PriceSet',
          'localizable' => 1,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '1.8',
        ],
        'is_active' => [
          'name' => 'is_active',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Price Set Is Active?'),
          'description' => ts('Is this price set active'),
          'required' => TRUE,
          'where' => 'civicrm_price_set.is_active',
          'default' => '1',
          'table_name' => 'civicrm_price_set',
          'entity' => 'PriceSet',
          'bao' => 'CRM_Price_BAO_PriceSet',
          'localizable' => 0,
          'html' => [
            'type' => 'CheckBox',
            'label' => ts("Enabled"),
          ],
          'add' => '1.8',
        ],
        'help_pre' => [
          'name' => 'help_pre',
          'type' => CRM_Utils_Type::T_TEXT,
          'title' => ts('Price Set Pre Help'),
          'description' => ts('Description and/or help text to display before fields in form.'),
          'rows' => 4,
          'cols' => 80,
          'where' => 'civicrm_price_set.help_pre',
          'table_name' => 'civicrm_price_set',
          'entity' => 'PriceSet',
          'bao' => 'CRM_Price_BAO_PriceSet',
          'localizable' => 1,
          'html' => [
            'type' => 'TextArea',
          ],
          'add' => '1.8',
        ],
        'help_post' => [
          'name' => 'help_post',
          'type' => CRM_Utils_Type::T_TEXT,
          'title' => ts('Price Set Post Help'),
          'description' => ts('Description and/or help text to display after fields in form.'),
          'rows' => 4,
          'cols' => 80,
          'where' => 'civicrm_price_set.help_post',
          'table_name' => 'civicrm_price_set',
          'entity' => 'PriceSet',
          'bao' => 'CRM_Price_BAO_PriceSet',
          'localizable' => 1,
          'html' => [
            'type' => 'TextArea',
          ],
          'add' => '1.8',
        ],
        'javascript' => [
          'name' => 'javascript',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Price Set Javascript'),
          'description' => ts('Optional Javascript script function(s) included on the form with this price_set. Can be used for conditional'),
          'maxlength' => 64,
          'size' => CRM_Utils_Type::BIG,
          'where' => 'civicrm_price_set.javascript',
          'table_name' => 'civicrm_price_set',
          'entity' => 'PriceSet',
          'bao' => 'CRM_Price_BAO_PriceSet',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '1.8',
        ],
        'extends' => [
          'name' => 'extends',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Price Set Extends'),
          'description' => ts('What components are using this price set?'),
          'required' => TRUE,
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_price_set.extends',
          'table_name' => 'civicrm_price_set',
          'entity' => 'PriceSet',
          'bao' => 'CRM_Price_BAO_PriceSet',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
          ],
          'pseudoconstant' => [
            'table' => 'civicrm_component',
            'keyColumn' => 'id',
            'labelColumn' => 'name',
          ],
          'add' => '3.1',
        ],
        'financial_type_id' => [
          'name' => 'financial_type_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Financial Type ID'),
          'description' => ts('FK to Financial Type(for membership price sets only).'),
          'where' => 'civicrm_price_set.financial_type_id',
          'default' => NULL,
          'table_name' => 'civicrm_price_set',
          'entity' => 'PriceSet',
          'bao' => 'CRM_Price_BAO_PriceSet',
          'localizable' => 0,
          'FKClassName' => 'CRM_Financial_DAO_FinancialType',
          'html' => [
            'type' => 'Select',
            'label' => ts("Financial Type"),
          ],
          'pseudoconstant' => [
            'table' => 'civicrm_financial_type',
            'keyColumn' => 'id',
            'labelColumn' => 'name',
          ],
          'add' => '4.3',
        ],
        'is_quick_config' => [
          'name' => 'is_quick_config',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Is Price Set Quick Config?'),
          'description' => ts('Is set if edited on Contribution or Event Page rather than through Manage Price Sets'),
          'required' => TRUE,
          'where' => 'civicrm_price_set.is_quick_config',
          'default' => '0',
          'table_name' => 'civicrm_price_set',
          'entity' => 'PriceSet',
          'bao' => 'CRM_Price_BAO_PriceSet',
          'localizable' => 0,
          'html' => [
            'type' => 'CheckBox',
          ],
          'add' => '4.1',
        ],
        'is_reserved' => [
          'name' => 'is_reserved',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Price Set Is Reserved'),
          'description' => ts('Is this a predefined system price set  (i.e. it can not be deleted, edited)?'),
          'required' => TRUE,
          'where' => 'civicrm_price_set.is_reserved',
          'default' => '0',
          'table_name' => 'civicrm_price_set',
          'entity' => 'PriceSet',
          'bao' => 'CRM_Price_BAO_PriceSet',
          'localizable' => 0,
          'html' => [
            'type' => 'CheckBox',
          ],
          'add' => '4.2',
        ],
        'min_amount' => [
          'name' => 'min_amount',
          'type' => CRM_Utils_Type::T_MONEY,
          'title' => ts('Minimum Amount'),
          'description' => ts('Minimum Amount required for this set.'),
          'precision' => [
            20,
            2,
          ],
          'where' => 'civicrm_price_set.min_amount',
          'default' => '0.0',
          'table_name' => 'civicrm_price_set',
          'entity' => 'PriceSet',
          'bao' => 'CRM_Price_BAO_PriceSet',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '4.7',
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
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'price_set', $prefix, []);
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
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'price_set', $prefix, []);
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
      'UI_name' => [
        'name' => 'UI_name',
        'field' => [
          0 => 'name',
        ],
        'localizable' => FALSE,
        'unique' => TRUE,
        'sig' => 'civicrm_price_set::1::name',
      ],
    ];
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }

}