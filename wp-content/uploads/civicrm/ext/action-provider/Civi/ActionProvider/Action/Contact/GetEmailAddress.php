<?php

namespace Civi\ActionProvider\Action\Contact;

use Civi\ActionProvider\Action\AbstractGetSingleAction;
use \Civi\ActionProvider\Parameter\ParameterBagInterface;
use \Civi\ActionProvider\Parameter\SpecificationBag;
use \Civi\ActionProvider\Parameter\Specification;
use CRM_ActionProvider_ExtensionUtil as E;

class GetEmailAddress extends AbstractGetSingleAction {

  /**
   * Returns the name of the entity.
   *
   * @return string
   */
  protected function getApiEntity() {
    return 'Email';
  }

  /**
   * Returns the ID from the parameter array
   *
   * @param \Civi\ActionProvider\Parameter\ParameterBagInterface $parameters
   *
   * @return int
   */
  protected function getIdFromParamaters(ParameterBagInterface $parameters) {
    return $parameters->getParameter('contact_id');
  }

  /**
   * Run the action
   *
   * @param ParameterInterface $parameters
   *   The parameters to this action.
   * @param ParameterBagInterface $output
   *   The parameters this action can send back
   * @return void
   */
  protected function doAction(ParameterBagInterface $parameters, ParameterBagInterface $output) {
    $contact_id = $parameters->getParameter('contact_id');
    $existingEmailAddressParams['contact_id'] = $contact_id;
    $existingEmailAddressParams['location_type_id'] = $this->configuration->getParameter('location_type_id');
    try {
      $existingEmail = civicrm_api3('Email', 'getsingle', $existingEmailAddressParams);
      $this->setOutputFromEntity($existingEmail, $output);
    } catch (\Exception $e) {
      if($this->configuration->getParameter('fallbacktoactive')){
        unset($existingEmailAddressParams['location_type_id']);
        $existingEmailAddressParams['is_active'] = 1 ;
        try {
          $existingEmail = civicrm_api3('Email', 'getsingle', $existingEmailAddressParams);
          $this->setOutputFromEntity($existingEmail, $output);
        } catch (\Exception $e){

        }
      }
    }
  }

  /**
   * Returns the specification of the configuration options for the actual action.
   *
   * @return SpecificationBag
   */
  public function getConfigurationSpecification() {
    $locationTypes = ContactActionUtils::getLocationTypes();
    reset($locationTypes);
    $defaultLocationType = key($locationTypes);
    return new SpecificationBag(array(
      new Specification('location_type_id', 'Integer', E::ts('Location type'), true, $defaultLocationType, null, $locationTypes, FALSE),
      new Specification('fallbacktoactive', 'Boolean', E::ts('Fallback to active'), true, 0)
    ));
  }

  /**
   * Returns the specification of the parameters of the actual action.
   *
   * @return SpecificationBag
   */
  public function getParameterSpecification() {
    return new SpecificationBag(array(
      new Specification('contact_id', 'Integer', E::ts('Contact ID'), true),
    ));
  }

}
