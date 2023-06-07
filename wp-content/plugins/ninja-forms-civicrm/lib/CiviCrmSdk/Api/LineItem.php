<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\LineItem as ContractsLineItem;
use NinjaForms\CiviCrmShared\Entities\HandledResponse;

/** @inheritDoc */
class LineItem implements ContractsLineItem
{
    /**
     * Parameter array from which to construct Line Item
     *
     * @var array
     */
    protected $parameterArray;

    /**
     * Key value pairs of parent entities with Ids
     *
     * @var array
     */
    protected $parentIds;

    /**
     * Constructed line item for an Order 
     *
     * @var array
     */
    protected $lineItemForOrder;

    /**
     * Handled Response
     *
     * @var HandledResponse
     */
    protected $handledResponse;

    /** @inheritDoc */
    public function constructLineItemForOrder(?array $parameterArray, array $parentIds): HandledResponse
    {
        $this->validateParameters($parameterArray);

        $this->parentIds = $parentIds;

        $this->handledResponse = HandledResponse::fromArray([]);

        $this->handledResponse->setContext('createLineItem');

        $this->initializeLineItemForOrder();

        $this->setValues();

        $this->handledResponse->setResponseBody(\json_encode($this->lineItemForOrder));

        $this->validateConstructedLineItem();

        return $this->handledResponse;
    }

    /**
     * Check for required construction, set HandledResponse flags
     *
     * @return void
     */
    protected function validateConstructedLineItem(): void
    {
        $errorFlag = false;

        if ('' == $this->lineItemForOrder['line_item'][0]['entity_table']) {

            $this->handledResponse->appendErrorMessage(__('Missing entity table', 'ninja-forms-civicrm'));
            $errorFlag = true;
        }

        if ($errorFlag) {

            $this->handledResponse->setIsSuccessful(false);
            $this->handledResponse->setIsApiError(true);
        }
    }
    /**
     * Set lineItem values from incoming parameters
     *
     * @return void
     */
    protected function setValues(): void
    {
        $this->lineItemForOrder['params']['status_id'] = $this->parameterArray['status_id'];

        if (isset($this->parentIds['Contact'])) {

            $this->lineItemForOrder['params']['contact_id'] = $this->parentIds['Contact'];
        }

        if (!is_null($this->parameterArray['linked_record_id']) && '' != $this->parameterArray['linked_record_id']) {

            if ('civicrm_participant' === $this->parameterArray['entity_type']) {
                $this->lineItemForOrder['params']['event_id'] = $this->parameterArray['linked_record_id'];
            }
            if ('civicrm_membership' === $this->parameterArray['entity_type']) {
                $this->lineItemForOrder['params']['membership_type_id'] = $this->parameterArray['linked_record_id'];
            }
        }

        $lineItemRecord = [
            'entity_table' => $this->parameterArray['entity_type'],
            'qty' => $this->parameterArray['qty'],
            'unit_price' => $this->parameterArray['unit_price'],
            'line_total' => $this->parameterArray['line_total'],
            'price_field_id' => $this->parameterArray['price_field_id'],
            'price_field_value_id' => $this->parameterArray['price_field_value_id'],
        ];

        $this->lineItemForOrder['line_item'][] = $lineItemRecord;
    }

    /**
     * Ensures required parameters are set
     *
     * @param array $parameterArray
     * @return void
     */
    protected function validateParameters(array $parameterArray): void
    {
        $required = [
            'entity_type' => '',
            'qty' => '0',
            'unit_price' => '0',
            'line_total' => '0',
            'linked_record_id' => null,
            'price_field_id' => null,
            'price_field_value_id' => null,
            'status_id' => 'Pending from incomplete transaction',
        ];

        $this->parameterArray = \array_merge($required, $parameterArray);
    }
    
    /**
     * Initialize the basic Line Item construct
     */
    protected function initializeLineItemForOrder(): void
    {
        $this->lineItemForOrder = [
            'params' => [],
            'line_item' => []
        ];
    }
}
