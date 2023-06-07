<?php

namespace Civi\ActionProvider\Action\Contact;

use \Civi\ActionProvider\Action\AbstractAction;
use Civi\ActionProvider\Exception\InvalidParameterException;
use \Civi\ActionProvider\Parameter\ParameterBagInterface;
use \Civi\ActionProvider\Parameter\SpecificationBag;
use \Civi\ActionProvider\Parameter\Specification;

use Civi\ActionProvider\Utils\CustomField;
use CRM_ActionProvider_ExtensionUtil as E;

class FindOrCreateOrganizationByName extends AbstractAction {

	/**
	 * Run the action
	 *
	 * @param ParameterInterface $parameters
	 *   The parameters to this action.
	 * @param ParameterBagInterface $output
	 * 	 The parameters this action can send back
	 * @return void
	 */
	protected function doAction(ParameterBagInterface $parameters, ParameterBagInterface $output) {
    $contact_sub_type = $this->configuration->getParameter('contact_sub_type');
	  try {
      $params['contact_type'] = 'Organization';
      if ($contact_sub_type) {
        $params['contact_sub_type'] = $contact_sub_type;
      }
      $params['organization_name'] = $parameters->getParameter('organization_name');
      $params['return'] = 'id';
      $params['options'] = ['sort' => 'contact_id ASC', 'limit' => 1];
      $contactId = civicrm_api3('Contact', 'getvalue', $params);
    } catch (\Exception $e) {
      $createParams['organization_name'] = $parameters->getParameter('organization_name');
      $createParams['contact_type'] = 'Organization';
      if ($contact_sub_type) {
        $createParams['contact_sub_type'] = $contact_sub_type;
      }
      $result = civicrm_api3('Contact', 'create', $createParams);
      $contactId = $result['id'];
    }
    $output->setParameter('contact_id', $contactId);
	}

	/**
	 * Returns the specification of the configuration options for the actual action.
	 *
	 * @return SpecificationBag
	 */
	public function getConfigurationSpecification() {
    $contactSubTypes = array();
    $contactSubTypesApi = civicrm_api3('ContactType', 'get', array('parent_id' => 'Organization', 'options' => array('limit' => 0)));
    $contactSubTypes[''] = E::ts(' - Select - ');
    foreach($contactSubTypesApi['values'] as $contactSubType) {
      $contactSubTypes[$contactSubType['name']] = $contactSubType['label'];
    }

    $spec = new SpecificationBag(array(
      new Specification('contact_sub_type', 'String', E::ts('Contact sub type'), false, null, null, $contactSubTypes, FALSE),
    ));

    return $spec;
	}

	/**
	 * Returns the specification of the parameters of the actual action.
	 *
	 * @return SpecificationBag
	 */
	public function getParameterSpecification() {
		$specs = new SpecificationBag(array(
      new Specification('organization_name', 'String', E::ts('Organization name'), true),
    ));
    return $specs;
	}

	/**
	 * Returns the specification of the output parameters of this action.
	 *
	 * This function could be overridden by child classes.
	 *
	 * @return SpecificationBag
	 */
	public function getOutputSpecification() {
		return new SpecificationBag(array(
			new Specification('contact_id', 'Integer', E::ts('Contact ID'), true)
		));
	}

}
