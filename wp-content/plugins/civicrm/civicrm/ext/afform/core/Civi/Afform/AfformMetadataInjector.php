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

namespace Civi\Afform;

use CRM_Afform_ExtensionUtil as E;

/**
 * Class AfformMetadataInjector
 * @package Civi\Afform
 */
class AfformMetadataInjector {

  /**
   * @param \Civi\Core\Event\GenericHookEvent $e
   * @see CRM_Utils_Hook::alterAngular()
   */
  public static function preprocess($e) {
    $changeSet = \Civi\Angular\ChangeSet::create('fieldMetadata')
      ->alterHtml(';\\.aff\\.html$;', function($doc, $path) {
        try {
          $module = \Civi::service('angular')->getModule(basename($path, '.aff.html'));
          $meta = \Civi\Api4\Afform::get(FALSE)->addWhere('name', '=', $module['_afform'])->setSelect(['join_entity', 'entity_type'])->execute()->first();

          // Add ngForm directive to afForm controllers
          foreach (pq('af-form[ctrl]') as $afForm) {
            pq($afForm)->attr('ng-form', $module['_afform']);
          }
        }
        catch (\Exception $e) {
        }

        $blockEntity = $meta['join_entity'] ?? $meta['entity_type'] ?? NULL;
        if (!$blockEntity) {
          $entities = self::getFormEntities($doc);
        }

        // Each field can be nested within a fieldset, a join or a block
        foreach (pq('af-field', $doc) as $afField) {
          /** @var \DOMElement $afField */
          $action = 'create';
          $joinName = pq($afField)->parents('[af-join]')->attr('af-join');
          if ($joinName) {
            self::fillFieldMetadata($joinName, $action, $afField);
            continue;
          }
          if ($blockEntity) {
            self::fillFieldMetadata($blockEntity, $action, $afField);
            continue;
          }
          // Not a block or a join, get metadata from fieldset
          $fieldset = pq($afField)->parents('[af-fieldset]');
          $apiEntities = pq($fieldset)->attr('api-entities');
          // If this fieldset is standalone (not linked to an af-entity) it is for get rather than create
          if ($apiEntities) {
            $action = 'get';
            $entityList = \CRM_Utils_JS::decode(htmlspecialchars_decode($apiEntities));
            $entityType = self::getFieldEntityType($afField->getAttribute('name'), $entityList);
          }
          else {
            $entityName = pq($fieldset)->attr('af-fieldset');
            if (!preg_match(';^[a-zA-Z0-9\_\-\. ]+$;', $entityName)) {
              \Civi::log()->error("Afform error: cannot process $path: malformed entity name ($entityName)");
              return;
            }
            $entityType = $entities[$entityName]['type'];
          }
          self::fillFieldMetadata($entityType, $action, $afField);
        }
      });
    $e->angular->add($changeSet);
  }

  /**
   * @param $entityNames
   * @param string $action
   * @param string $fieldName
   * @return array|null
   */
  private static function getFieldMetadata($entityNames, string $action, string $fieldName):? array {
    foreach ((array) $entityNames as $entityName) {
      $fieldInfo = FormDataModel::getField($entityName, $fieldName, $action);
      if ($fieldInfo) {
        return $fieldInfo;
      }
    }
    return NULL;
  }

  /**
   * Merge a field's definition with whatever's already in the markup
   *
   * @param \DOMElement $afField
   * @param array $fieldInfo
   * @throws \CRM_Core_Exception
   * @throws \Civi\API\Exception\NotImplementedException
   */
  public static function setFieldMetadata(\DOMElement $afField, array $fieldInfo):void {
    $deep = ['input_attrs'];
    // Defaults for attributes not in spec
    $fieldInfo['search_range'] = FALSE;

    $existingFieldDefn = trim(pq($afField)->attr('defn') ?: '');
    if ($existingFieldDefn && $existingFieldDefn[0] != '{') {
      // If it's not an object, don't mess with it.
      return;
    }

    // Get field defn from afform markup
    $fieldDefn = $existingFieldDefn ? \CRM_Utils_JS::getRawProps($existingFieldDefn) : [];
    // This is the input type set on the form (may be different from the default input type in the field spec)
    $inputType = !empty($fieldDefn['input_type']) ? \CRM_Utils_JS::decode($fieldDefn['input_type']) : $fieldInfo['input_type'];
    // On a search form, search_range will present a pair of fields (or possibly 3 fields for date select + range)
    $isSearchRange = !empty($fieldDefn['search_range']) && \CRM_Utils_JS::decode($fieldDefn['search_range']);

    // Default placeholder for select inputs
    if ($inputType === 'Select' || $inputType === 'ChainSelect') {
      $fieldInfo['input_attrs']['placeholder'] = E::ts('Select');
    }
    elseif ($inputType === 'EntityRef' && empty($field['is_id'])) {
      $info = civicrm_api4('Entity', 'get', [
        'where' => [['name', '=', $fieldInfo['fk_entity']]],
        'checkPermissions' => FALSE,
        'select' => ['title', 'title_plural'],
      ], 0);
      $label = empty($fieldInfo['input_attrs']['multiple']) ? $info['title'] : $info['title_plural'];
      $fieldInfo['input_attrs']['placeholder'] = E::ts('Select %1', [1 => $label]);
    }

    if ($fieldInfo['input_type'] === 'Date') {
      // This flag gets used by the afField controller
      $fieldDefn['is_date'] = TRUE;
      // For date fields that have been converted to Select
      if ($inputType === 'Select') {
        $dateOptions = \CRM_Utils_Array::makeNonAssociative(\CRM_Core_OptionGroup::values('relative_date_filters'), 'id', 'label');
        if ($isSearchRange) {
          $dateOptions = array_merge([['id' => '{}', 'label' => E::ts('Choose Date Range')]], $dateOptions);
        }
        $fieldInfo['options'] = $dateOptions;
      }
    }

    foreach ($fieldInfo as $name => $prop) {
      // Merge array props 1 level deep
      if (in_array($name, $deep) && !empty($fieldDefn[$name])) {
        $fieldDefn[$name] = \CRM_Utils_JS::writeObject(\CRM_Utils_JS::getRawProps($fieldDefn[$name]) + array_map(['\CRM_Utils_JS', 'encode'], $prop));
      }
      elseif (!isset($fieldDefn[$name])) {
        $fieldDefn[$name] = \CRM_Utils_JS::encode($prop);
      }
    }
    pq($afField)->attr('defn', htmlspecialchars(\CRM_Utils_JS::writeObject($fieldDefn), ENT_COMPAT));
  }

  /**
   * Merge field definition metadata into an afform field's definition
   *
   * @param string|array $entityNames
   * @param string $action
   * @param \DOMElement $afField
   * @throws \CRM_Core_Exception
   */
  private static function fillFieldMetadata($entityNames, string $action, \DOMElement $afField):void {
    $fieldName = $afField->getAttribute('name');
    $fieldInfo = self::getFieldMetadata($entityNames, $action, $fieldName);
    // Merge field definition data with whatever's already in the markup.
    if ($fieldInfo) {
      self::setFieldMetadata($afField, $fieldInfo);
    }
  }

  /**
   * Determines name of the api entit(ies) based on the field name prefix
   *
   * Note: Normally will return a single entity name, but
   * Will return 2 entity names in the case of Bridge joins e.g. RelationshipCache
   *
   * @param string $fieldName
   * @param string[] $entityList
   * @return string|array
   */
  private static function getFieldEntityType($fieldName, $entityList) {
    $prefix = strpos($fieldName, '.') ? explode('.', $fieldName)[0] : NULL;
    $joinEntities = [];
    $baseEntity = array_shift($entityList);
    if ($prefix) {
      foreach ($entityList as $entityAndAlias) {
        [$entity, $alias] = explode(' AS ', $entityAndAlias);
        if ($alias === $prefix) {
          $joinEntities[] = $entityAndAlias;
        }
      }
    }
    return $joinEntities ?: $baseEntity;
  }

  private static function getFormEntities(\phpQueryObject $doc) {
    $entities = [];
    foreach ($doc->find('af-entity') as $afmModelProp) {
      $entities[$afmModelProp->getAttribute('name')] = [
        'type' => $afmModelProp->getAttribute('type'),
      ];
    }
    return $entities;
  }

}
