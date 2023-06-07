<?php

namespace NinjaForms\CiviCrm\Processors;

use NinjaForms\CiviCrmShared\Contracts\LoggerInterface;
use NinjaForms\CiviCrm\Contracts\ModuleProcessor;
use NinjaForms\CiviCrmSdk\Contracts\GroupContact as SdkObject;
use NinjaForms\CiviCrmSdk\Entities\CreateObjectResponse;

use NinjaForms\CiviCrm\Processors\ModuleProcessorAbstract;

class GroupContactProcessor extends ModuleProcessorAbstract implements ModuleProcessor
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
        $fieldMappingCollection = isset($this->submissionData['create_group_contact']) ? $this->submissionData['create_group_contact'] : [];

        if (!empty($fieldMappingCollection) && isset($this->recordIds['Contact'])) {

            foreach ($fieldMappingCollection as $fieldMapping) {

                if (isset($fieldMapping['group_id']) && '' == $fieldMapping['group_id']) {
                    continue;
                }

                if (
                    isset( $fieldMapping['field_conditional_match_value'] ) && isset( $fieldMapping['field_conditional'] ) && isset( $fieldMapping['field_conditional_match_value'] ) &&
                    '' !== $fieldMapping['field_conditional_match_value'] && $fieldMapping['field_conditional'] !== $fieldMapping['field_conditional_match_value']) {
                    continue;
                }

                if( isset($fieldMapping['group_id']) ){
                    $array = [
                        'group_id' => $fieldMapping['group_id'],
                        'status' => 'Added'
                    ];
                }
                
                if( isset($array) ){
                    try {
                        $response = $this->sdkObject->create(
                            $array,
                            ['Contact' => $this->recordIds['Contact']]
                        );

                        $this->recordIds['GroupContact'][] = $response->getId();

                        $this->responses[] = $response;
                    } catch (\Throwable $e) {

                        $this->logger->warning($e->getMessage() . ' => GroupContactProcessor.process');
                    }
                }
            }
        }

        return $this;
    }
}
