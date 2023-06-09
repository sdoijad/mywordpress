<?php

/**
 * Civi v5.19 does not provide all the API's we would need to define
 * FlexMailer in an extension, but you can patch core to simulate them.
 * These define()s tell core to enable any such hacks (if available).
 */

define('CIVICRM_FLEXMAILER_HACK_DELIVER', '\Civi\FlexMailer\FlexMailer::createAndRun');
define('CIVICRM_FLEXMAILER_HACK_SENDABLE', '\Civi\FlexMailer\Validator::createAndRun');
define('CIVICRM_FLEXMAILER_HACK_REQUIRED_TOKENS', 'call://civi_flexmailer_required_tokens/getRequiredTokens');

require_once 'flexmailer.civix.php';

use CRM_Flexmailer_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function flexmailer_civicrm_config(&$config) {
  _flexmailer_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function flexmailer_civicrm_install() {
  _flexmailer_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function flexmailer_civicrm_enable() {
  _flexmailer_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 */
function flexmailer_civicrm_navigationMenu(&$menu) {
  _flexmailer_civix_insert_navigation_menu($menu, 'Administer/CiviMail', [
    'label' => E::ts('Flexmailer Settings'),
    'name' => 'flexmailer_settings',
    'permission' => 'administer CiviCRM',
    'child' => [],
    'operator' => 'AND',
    'separator' => 0,
    'url' => CRM_Utils_System::url('civicrm/admin/setting/flexmailer', 'reset=1', TRUE),
  ]);
  _flexmailer_civix_navigationMenu($menu);
}

/**
 * Implements hook_civicrm_container().
 */
function flexmailer_civicrm_container($container) {
  $container->addResource(new \Symfony\Component\Config\Resource\FileResource(__FILE__));
  \Civi\FlexMailer\Services::registerServices($container);
}

/**
 * Get a list of delivery options for traditional mailings.
 *
 * @return array
 *   Array (string $machineName => string $label).
 */
function _flexmailer_traditional_options() {
  return array(
    'auto' => E::ts('Automatic'),
    'bao' => E::ts('CiviMail BAO'),
    'flexmailer' => E::ts('Flexmailer Pipeline'),
  );
}
