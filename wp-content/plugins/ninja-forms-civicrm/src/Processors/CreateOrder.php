<?php

namespace NinjaForms\CiviCrm\Processors;

use NinjaForms\CiviCrmSdk\Api\LineItem;
use NinjaForms\CiviCrmShared\Contracts\FormActionProcessor as ContractsFormActionProcessor;
use NinjaForms\CiviCrmShared\Contracts\DataModelProvider;
use NinjaForms\CiviCrmShared\Entities\HandledResponse;

use NinjaForms\CiviCrmSdk\Contracts\CiviObjectsFactory as ContractsCiviObjectsFactory;

use NinjaForms\CiviCrmShared\Abstracts\FormActionProcessor as AbstractsFormActionProcessor;

use NinjaForms\CiviCrmShared\Handlers\ExtraDataHandler;

/**
 * Create CiviCRM Order from all line items
 * 
 * ### Functionality ###

 * @package FormProcessing
 */
class CreateOrder extends AbstractsFormActionProcessor implements ContractsFormActionProcessor
{

    /** @var  ContractsCiviObjectsFactory */
    protected $civiObjectsFactory;

    /** @var DataModelProvider    */
    protected $dataModelProvider;

    /** @var ExtraDataHandler */
    protected $extraDataHandler;

    /**
     * Collection of line items 
     *
     * Each line item is a structured line item request created by the LineItem API object
     * @var array
     */
    protected $lineItems;

    /**
     * Action Processor Key of contact assigned to the order
     *
     * @var string
     */
    protected $responsibleContactKey = '';

    /**
     * The first contact appearing in the line items
     *
     * If no match is made for the responsible Contact, then the first contact
     * appearing will be assigned the order
     *
     * @var string
     */
    protected $firstContactId = null;

    /**
     * The id of the contact assigned to the order
     *
     * If no responsible contact key is matched, then the first contact id found
     * becomes the responsible contact id
     *
     * @var string
     */
    protected $responsibleContactId = null;

    /**
     * Total amount of all line items
     *
     * @var float
     */
    protected $totalAmount = 0;

    /**
     *
     * @param array $actionConfiguration Action configuration array
     * @param ContractsCiviObjectsFactory $civiObjectsFactory Factory to provide SDK objects for making API requests
     * @param DataModelProvider $dataModelProvider
     * @param ExtraDataHandler $extraDataHandler
     */
    public function __construct(
        array $actionConfiguration,
        ContractsCiviObjectsFactory $civiObjectsFactory,
        DataModelProvider $dataModelProvider,
        ExtraDataHandler $extraDataHandler
    ) {
        parent::__construct($actionConfiguration);

        $this->civiObjectsFactory = $civiObjectsFactory;
        $this->dataModelProvider = $dataModelProvider;
        $this->extraDataHandler = $extraDataHandler;
    }

    /**
     * Override the parent's action settings with runtime values
     *
     * Update the field map drop down values with constructed values from Civi
     * Objects. CiviCrm is not initialized by the time the action settings must
     * be registered, so only get the field values when the actual output is
     * being generated in a form build.
     * 
     * The dataModelProvider class handles the structuring of the data.
     * @see \NinjaForms\CiviCrmShared\Contracts\DataModelProvider
     * @return array
     */
    public function finalizeActionSettings(): array
    {
        return $this->actionConfiguration['actionSettings'];
    }


    /** @inheritDoc */
    public function processSubmissionData(): void
    {
        $this->extraDataHandler->setData($this->data);

        $this->processorKey = $this->submissionData['action_processor_key'];

        $requestedResponsible = $this->submissionData['order_responsibility_key'];

        if (!is_null($requestedResponsible) && '' !== $requestedResponsible) {
            $this->responsibleContactKey = $requestedResponsible;
        }

        if ('' == $this->processorKey) {
            $this->processorKey = 0;
        }

        $this->consolidateLineItems();

        $parameterArray = [
            'contact_id' => $this->responsibleContactId,
            'total_amount' => $this->totalAmount,
            'financial_type_id' => $this->submissionData['financial_type_id'],
            'contribution_status_id' => 'Pending',
            'line_items' => $this->lineItems
        ];
        
        $sdkObject = $this->civiObjectsFactory->order();

        
        $handledResponse = $sdkObject->createOrder($parameterArray);
        
        $this->extraDataHandler->appendHandledResponse($handledResponse->toArray());

        
        $disableDataStorage = $this->submissionData['disable_results_storage'];

        if (!$disableDataStorage) {
            $this->data = $this->extraDataHandler->getData();
        }
    }

    /**
     * Consolidate all line items from preceding actions
     *
     * @return void
     */
    protected function consolidateLineItems(): void
    {
        if (!isset($this->data['extra']['nfcivicrmcreatecontact'])) {
            return;
        }

        $lineItems = [];

        foreach ($this->data['extra']['nfcivicrmcreatecontact'] as $actionProcessorKey => $handledResponseCollection) {

            foreach ($handledResponseCollection as $handledResponseArray) {

                $object = HandledResponse::fromArray($handledResponseArray);

                $context = $object->getContext();

                if ('createLineItem' !== $context) {
                    continue;
                }

                $lineItem = \json_decode($object->getResponseBody(), true);

                $lineItems[] = $lineItem;

                if (isset($lineItem['line_item'][0]['line_total'])) {

                    $this->totalAmount = $this->totalAmount + floatval($lineItem['line_item'][0]['line_total']);
                }

                /** 
                 * Set first contact id to the first contact id found.  Once set, it doesn't get overwritten
                 */
                if (is_null($this->firstContactId) && isset($lineItem['params']['contact_id'])) {
                    $this->firstContactId = $lineItem['params']['contact_id'];
                }

                /**
                 * If a responsible contact key has been set,
                 */
                if (
                    '' !== $this->responsibleContactKey &&
                    $actionProcessorKey === $this->responsibleContactKey &&
                    isset($lineItem['params']['contact_id'])
                ) {
                    $this->responsibleContactId = $lineItem['params']['contact_id'];
                }
            }
        }

        // First one to order pays
        if (is_null($this->responsibleContactId)) {
            $this->responsibleContactId = $this->firstContactId;
        }

        $this->lineItems = $lineItems;
    }
}
