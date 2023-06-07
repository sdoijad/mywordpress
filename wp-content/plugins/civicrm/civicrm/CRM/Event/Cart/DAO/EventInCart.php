<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from xml/schema/CRM/Event/Cart/EventInCart.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:81cd95c42078a304bf1a70ea35268a9a)
 */

/**
 * Database access object for the EventInCart entity.
 */
class CRM_Event_Cart_DAO_EventInCart extends CRM_Core_DAO {
  const EXT = 'civicrm';
  const TABLE_ADDED = '';
  const COMPONENT = 'CiviEvent';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_events_in_carts';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = FALSE;

  /**
   * Event In Cart ID
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $id;

  /**
   * FK to Event ID
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $event_id;

  /**
   * FK to Event Cart ID
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $event_cart_id;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_events_in_carts';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? ts('Event In Carts') : ts('Event In Cart');
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
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'event_id', 'civicrm_event', 'id');
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'event_cart_id', 'civicrm_event_carts', 'id');
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
        'event_in_cart_id' => [
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Event In Cart'),
          'description' => ts('Event In Cart ID'),
          'required' => TRUE,
          'where' => 'civicrm_events_in_carts.id',
          'table_name' => 'civicrm_events_in_carts',
          'entity' => 'EventInCart',
          'bao' => 'CRM_Event_Cart_BAO_EventInCart',
          'localizable' => 0,
          'html' => [
            'type' => 'Number',
          ],
          'readonly' => TRUE,
          'add' => '4.1',
        ],
        'event_id' => [
          'name' => 'event_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Event ID'),
          'description' => ts('FK to Event ID'),
          'where' => 'civicrm_events_in_carts.event_id',
          'table_name' => 'civicrm_events_in_carts',
          'entity' => 'EventInCart',
          'bao' => 'CRM_Event_Cart_BAO_EventInCart',
          'localizable' => 0,
          'FKClassName' => 'CRM_Event_DAO_Event',
          'html' => [
            'label' => ts("Event"),
          ],
          'add' => '4.1',
        ],
        'event_cart_id' => [
          'name' => 'event_cart_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Event Cart ID'),
          'description' => ts('FK to Event Cart ID'),
          'where' => 'civicrm_events_in_carts.event_cart_id',
          'table_name' => 'civicrm_events_in_carts',
          'entity' => 'EventInCart',
          'bao' => 'CRM_Event_Cart_BAO_EventInCart',
          'localizable' => 0,
          'FKClassName' => 'CRM_Event_Cart_DAO_Cart',
          'html' => [
            'label' => ts("Event In Cart"),
          ],
          'add' => '4.1',
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
    return self::$_tableName;
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
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'events_in_carts', $prefix, []);
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
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'events_in_carts', $prefix, []);
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
    $indices = [];
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }

}
