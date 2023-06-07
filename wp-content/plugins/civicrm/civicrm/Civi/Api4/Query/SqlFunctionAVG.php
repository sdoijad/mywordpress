<?php
/*
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC. All rights reserved.                        |
 |                                                                    |
 | This work is published under the GNU AGPLv3 license with some      |
 | permitted exceptions and without any warranty. For full license    |
 | and copyright information, see https://civicrm.org/licensing       |
 +--------------------------------------------------------------------+
 */

namespace Civi\Api4\Query;

/**
 * Sql function
 */
class SqlFunctionAVG extends SqlFunction {

  protected static $category = self::CATEGORY_AGGREGATE;

  protected static $dataType = 'Float';

  protected static function params(): array {
    return [
      [
        'flag_before' => ['' => NULL, 'DISTINCT' => ts('Distinct')],
        'must_be' => ['SqlField'],
      ],
    ];
  }

  /**
   * @return string
   */
  public static function getTitle(): string {
    return ts('Average');
  }

  /**
   * @return string
   */
  public static function getDescription(): string {
    return ts('The mean of all values in the grouping.');
  }

}
