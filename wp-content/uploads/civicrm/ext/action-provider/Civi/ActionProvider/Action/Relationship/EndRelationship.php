<?php
/**
 * @author Jaap Jansma <jaap.jansma@civicoop.org>
 * @license AGPL-3.0
 */

namespace Civi\ActionProvider\Action\Relationship;

use \Civi\ActionProvider\Action\AbstractAction;
use \Civi\ActionProvider\Parameter\ParameterBagInterface;
use \Civi\ActionProvider\Parameter\SpecificationBag;
use \Civi\ActionProvider\Parameter\Specification;

use CRM_ActionProvider_ExtensionUtil as E;

class EndRelationship extends AbstractAction {

  protected $relationshipTypes = array();
  protected $relationshipTypeIds = array();

  public function __construct() {
    parent::__construct();
    $relationshipTypesApi = civicrm_api3('RelationshipType', 'get', array('is_active' => 1, 'options' => array('limit' => 0)));
    $this->relationshipTypes = array();
    $this->relationshipTypeIds = array();
    foreach($relationshipTypesApi['values'] as $relType) {
      $this->relationshipTypes[$relType['name_a_b']] = $relType['label_a_b'];
      $this->relationshipTypeIds[$relType['name_a_b']] = $relType['id'];
    }

  }

  /**
   * Returns the specification of the configuration options for the actual action.
   *
   * @return SpecificationBag
   */
  public function getConfigurationSpecification() {
    return new SpecificationBag(array(
      new Specification('relationship_type_id', 'String', E::ts('Relationship type'), true, null, null, $this->relationshipTypes, False),
      new Specification('set_end_date', 'Boolean', E::ts('Set end date?'), false, 0, null, null, FALSE),
    ));
  }

  /**
   * Returns the specification of the configuration options for the actual action.
   *
   * @return SpecificationBag
   */
  public function getParameterSpecification() {
    $specs = new SpecificationBag(array(
      /**
       * The parameters given to the Specification object are:
       * @param string $name
       * @param string $dataType
       * @param string $title
       * @param bool $required
       * @param mixed $defaultValue
       * @param string|null $fkEntity
       * @param array $options
       * @param bool $multiple
       */
      new Specification('contact_id_a', 'Integer', E::ts('Contact ID A'), true, null, null, null, FALSE),
      new Specification('contact_id_b', 'Integer', E::ts('Contact ID B'), true, null, null, null, FALSE),
    ));

    return $specs;
  }

  /**
   * Run the action
   *
   * @param ParameterBagInterface $parameters
   *   The parameters to this action.
   * @param ParameterBagInterface $output
   *   The parameters this action can send back
   * @return void
   */
  protected function doAction(ParameterBagInterface $parameters, ParameterBagInterface $output) {
    // Get the contact and the event.
    $contact_id_a = $parameters->getParameter('contact_id_a');
    $contact_id_b = $parameters->getParameter('contact_id_b');
    $relationship_type_id = $this->relationshipTypeIds[$this->configuration->getParameter('relationship_type_id')];

    $sql = "SELECT id FROM civicrm_relationship WHERE contact_id_a = %1 AND contact_id_b = %2 AND relationship_type_id = %3 
      AND civicrm_relationship.is_active = 1 
      AND (civicrm_relationship.start_date IS NULL OR civicrm_relationship.start_date <= CURRENT_DATE()) 
      AND (civicrm_relationship.end_date IS NULL OR civicrm_relationship.end_date >= CURRENT_DATE())";
    $sqlParams[1] = array($contact_id_a, 'Integer');
    $sqlParams[2] = array($contact_id_b, 'Integer');
    $sqlParams[3] = array($relationship_type_id, 'Integer');
    $dao = \CRM_Core_DAO::executeQuery($sql, $sqlParams);
    while ($dao->fetch()) {
      try {
        $apiParams['id'] = $dao->id;
        $apiParams['is_active'] = '0';
        if ($this->configuration->getParameter('set_end_date')) {
          $today = new \DateTime();
          $apiParams['end_date'] = $today->format('Ymd');
        }
        civicrm_api3('Relationship', 'create', $apiParams);
      } catch (\Exception $e) {
        // Do nothing.
      }
    }
  }

}