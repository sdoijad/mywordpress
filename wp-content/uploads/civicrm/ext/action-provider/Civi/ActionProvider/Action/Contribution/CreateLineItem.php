<?php
/**
 * @author Björn Endres <endres@systopia.de>
 * @license AGPL-3.0
 */

namespace Civi\ActionProvider\Action\Contribution;

use Civi\ActionProvider\Action\AbstractAction;
use Civi\ActionProvider\Parameter\ParameterBagInterface;

use Civi\ActionProvider\Parameter\Specification;
use Civi\ActionProvider\Parameter\SpecificationBag;
use CRM_ActionProvider_ExtensionUtil as E;

class CreateLineItem extends AbstractAction {


  /**
   * @return \Civi\ActionProvider\Parameter\SpecificationBag
   */
  public function getOutputSpecification() {
    return new SpecificationBag([
        new Specification('line_item_id', 'Integer', E::ts('Line Item ID'), false),
    ]);
  }

  /**
   * Returns the specification of the configuration options for the actual action.
   *
   * @return SpecificationBag
   */
  public function getConfigurationSpecification() {
    $linked_entity_options = [
        'civicrm_contribution' => E::ts("None"),
        'civicrm_membership'   => E::ts("Membership"),
        'civicrm_participant'  => E::ts("Event Registration"),
    ];

    return new SpecificationBag([
        new Specification('qty', 'Integer', E::ts('Default Quantity'), TRUE, 1),
        new Specification('label', 'String', E::ts('Default Label'), TRUE, E::ts("Contribution Amount")),
        new Specification('entity_table', 'String', E::ts('Linked Object'), 'true', 'civicrm_contribution', null, $linked_entity_options),
        new Specification('financial_type_id', 'Integer', E::ts('Financial Type'), false, null, 'FinancialType'),
    ]);
  }

  /**
   * Returns the specification of the parameters of the actual action.
   *
   * @return SpecificationBag
   */
  public function getParameterSpecification() {
    return new SpecificationBag([
        new Specification('contribution_id', 'Integer', E::ts('Contribution ID'), true),
        new Specification('entity_id', 'Integer', E::ts('Linked Entity ID')),
        new Specification('financial_type_id', 'Integer', E::ts('Financial Type'), false, null, 'FinancialType'),
        new Specification('label', 'String', E::ts('Label')),
        new Specification('qty', 'Integer', E::ts('Quantity')),
        new Specification('unit_price', 'Float', E::ts('Unit Price')),
    ]);
  }


  /**
   * Run the action
   *
   * @param ParameterBagInterface $parameters
   *   The parameters to this action.
   * @param ParameterBagInterface $output
   * 	 The parameters this action can send back
   * @return void
   * @throws \Exception
   */
  protected function doAction(ParameterBagInterface $parameters, ParameterBagInterface $output) {
    $line_item_data = [];

    // add default values
    $line_item_data['qty'] = $this->configuration->getParameter('qty');
    $line_item_data['label'] = $this->configuration->getParameter('label');
    $line_item_data['entity_table'] = $this->configuration->getParameter('entity_table');

    if ($this->configuration->doesParameterExists('financial_type_id')) {
      $line_item_data['financial_type_id'] = $this->configuration->getParameter('financial_type_id');
    }
    if ($parameters->doesParameterExists('financial_type_id')) {
      $line_item_data['financial_type_id'] = $parameters->getParameter('financial_type_id');
    }

    // override with parameters
    foreach (['contribution_id', 'entity_id', 'label', 'qty', 'unit_price'] as $field) {
      $value = $parameters->getParameter($field);
      if (!empty($value)) {
        $line_item_data[$field] = $value;
      }
    }

    $line_item_data['qty'] = (float) $line_item_data['qty'];
    $line_item_data['unit_price'] = (float) $line_item_data['unit_price'];

    // Set the CiviCRM default Priceset for the line item, if not already set
    if ( empty( $line_item_data['price_field_id'] ) ) {
      $line_item_data['price_field_id'] = 1;
	  }

    // do some calculations and sanity checks
    $contribution = \civicrm_api3('Contribution', 'getsingle', ['id' => $line_item_data['contribution_id']]);

    // if no specific entity ID is given, and it's contribution, then we reference ourselves
    if (empty($line_item_data['entity_id']) && $line_item_data['entity_table'] == 'civicrm_contribution') {
      $line_item_data['entity_id'] = $line_item_data['contribution_id'];
    }

    // exit if unit price is zero value
    if ($line_item_data['unit_price'] == 0) {
      return false;
    }

    // calculate line total + copy financial type
    $line_item_data['line_total'] = $line_item_data['unit_price'] * $line_item_data['qty'];

    // if the financial type is not set then use the Contribution financial type
    if (empty($line_item_data['financial_type_id'])) {
      $line_item_data['financial_type_id'] = $contribution['financial_type_id'];
    }

    // Create line item
    $new_lineitem = \civicrm_api3('LineItem', 'create', $line_item_data);
    $output->setParameter('line_item_id', $new_lineitem['id']);

    // Get the lineitem object (not the array)
    $lineitem_param = ['id' => $new_lineitem['id']];
    $lineitem = \CRM_Price_BAO_LineItem::create($lineitem_param);
    $lineitem->find(TRUE);

    // Get the contribution object (not the array)
    $contribution_param = ['id' => $line_item_data['contribution_id']];
    $contribution = \CRM_Contribute_BAO_Contribution::create($contribution_param);

    // Add the financial item
    \CRM_Financial_BAO_FinancialItem::add($lineitem, $contribution);

    // Add the financial item for tax
    if (!empty($lineitem->tax_amount)) {
      \CRM_Financial_BAO_FinancialItem::add($lineitem, $contribution, TRUE);
    }

  }

}
