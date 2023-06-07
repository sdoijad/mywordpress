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

namespace Civi\Api4\Service\Spec\Provider;

use Civi\Api4\Service\Spec\RequestSpec;

/**
 * @service
 * @internal
 */
class BatchCreationSpecProvider extends \Civi\Core\Service\AutoService implements Generic\SpecProviderInterface {

  /**
   * @inheritDoc
   */
  public function modifySpec(RequestSpec $spec) {
    $spec->getFieldByName('created_id')->setDefaultValue('user_contact_id');
    $spec->getFieldByName('created_date')->setDefaultValue('now');
    $spec->getFieldByName('modified_id')->setDefaultValue('user_contact_id');
    $spec->getFieldByName('modified_date')->setDefaultValue('now');
  }

  /**
   * @inheritDoc
   */
  public function applies($entity, $action) {
    return $entity === 'Batch' && $action === 'create';
  }

}
