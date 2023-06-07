<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from xml/schema/CRM/Mailing/Event/MailingEventReply.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:0b96aff101cae7ec818922a30da1671d)
 */

/**
 * Database access object for the MailingEventReply entity.
 */
class CRM_Mailing_Event_DAO_MailingEventReply extends CRM_Core_DAO {
  const EXT = 'civicrm';
  const TABLE_ADDED = '';
  const COMPONENT = 'CiviMail';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_mailing_event_reply';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = FALSE;

  /**
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $id;

  /**
   * FK to EventQueue
   *
   * @var int|string
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $event_queue_id;

  /**
   * When this reply event occurred.
   *
   * @var string
   *   (SQL type: timestamp)
   *   Note that values will be retrieved from the database as a string.
   */
  public $time_stamp;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_mailing_event_reply';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? ts('Mailing Replies') : ts('Mailing Reply');
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
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'event_queue_id', 'civicrm_mailing_event_queue', 'id');
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
          'title' => ts('Reply ID'),
          'required' => TRUE,
          'where' => 'civicrm_mailing_event_reply.id',
          'table_name' => 'civicrm_mailing_event_reply',
          'entity' => 'MailingEventReply',
          'bao' => 'CRM_Mailing_Event_BAO_MailingEventReply',
          'localizable' => 0,
          'html' => [
            'type' => 'Number',
            'label' => ts("ID"),
          ],
          'readonly' => TRUE,
          'add' => NULL,
        ],
        'event_queue_id' => [
          'name' => 'event_queue_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Event Queue ID'),
          'description' => ts('FK to EventQueue'),
          'required' => TRUE,
          'where' => 'civicrm_mailing_event_reply.event_queue_id',
          'table_name' => 'civicrm_mailing_event_reply',
          'entity' => 'MailingEventReply',
          'bao' => 'CRM_Mailing_Event_BAO_MailingEventReply',
          'localizable' => 0,
          'FKClassName' => 'CRM_Mailing_Event_DAO_MailingEventQueue',
          'html' => [
            'label' => ts("Recipient"),
          ],
          'add' => NULL,
        ],
        'time_stamp' => [
          'name' => 'time_stamp',
          'type' => CRM_Utils_Type::T_TIMESTAMP,
          'title' => ts('Reply Timestamp'),
          'description' => ts('When this reply event occurred.'),
          'required' => TRUE,
          'where' => 'civicrm_mailing_event_reply.time_stamp',
          'default' => 'CURRENT_TIMESTAMP',
          'table_name' => 'civicrm_mailing_event_reply',
          'entity' => 'MailingEventReply',
          'bao' => 'CRM_Mailing_Event_BAO_MailingEventReply',
          'localizable' => 0,
          'add' => NULL,
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
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'mailing_event_reply', $prefix, []);
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
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'mailing_event_reply', $prefix, []);
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
