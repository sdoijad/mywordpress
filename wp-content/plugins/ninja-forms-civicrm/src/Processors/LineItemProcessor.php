<?php

namespace NinjaForms\CiviCrm\Processors;

use NinjaForms\CiviCrmShared\Contracts\LoggerInterface;
use NinjaForms\CiviCrm\Contracts\ModuleProcessor;
use NinjaForms\CiviCrmSdk\Contracts\LineItem as SdkObject;

use NinjaForms\CiviCrmSdk\Entities\CreateObjectResponse;

use NinjaForms\CiviCrm\Processors\ModuleProcessorAbstract;

class LineItemProcessor extends ModuleProcessorAbstract implements ModuleProcessor
{

    /**
     * CiviCRM SDK object
     *
     * Use matching Sdk object for the request.  Phone object for phone
     * processing, email object for email processing, etc.
     *
     * @var SdkObject
     */
    protected $sdkObject;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * Submission Data array
     *
     * @var array
     */
    protected $submissionData = [];

    /**
     * Array of previously constructed (or matched) Ids
     *
     * @var array
     */
    protected $recordIds = [];

    /**
     * Collection of CreateObjectResponse
     *
     * @var CreateObjectResponse[]
     */
    protected $responses = [];


    /**
     * Construct
     *
     * @param SdkObject $sdkObject
     * @param LoggerInterface $logger
     */
    public function __construct(SdkObject $sdkObject, LoggerInterface $logger)
    {
        $this->sdkObject = $sdkObject;
        $this->logger = $logger;
    }

    /** @inheritDoc */
    public function process(): ModuleProcessor
    {
        $fieldMappingCollection = $this->getLineItemsSubmissionData('line_item_field_map');

        if (!empty($fieldMappingCollection)) {

            foreach ($fieldMappingCollection as $fieldMap) {

                try {
                    $response = $this->sdkObject->constructLineItemForOrder($fieldMap, ['Contact' => $this->recordIds['Contact']]);

                    $this->responses[] = $response;
                } catch (\Throwable $e) {

                    $this->logger->warning($e->getMessage() . ' => LineItemProcessor.process');
                }
            }
        }

        return $this;
    }

    /**
     * Manually construct each line item from option repeater row
     * 
     * This should be refactored into something more scalable; this is meant to test data structures only
     *
     * @param string $actionSettingKey
     * @return array
     */
    protected function getLineItemsSubmissionData(): array
    {
        $return = [];

        if( isset($this->submissionData['line_item_field_map']) && is_array($this->submissionData['line_item_field_map']) ){
            foreach ($this->submissionData['line_item_field_map'] as $optionRepeaterValue) {
                $element = [];

                foreach ($optionRepeaterValue as $key => $value) {

                    $element[$key] = $value;
                }
                $return[] = $element;
            }
        }

        return $return;
    }
}
