<?php

namespace NinjaForms\CiviCrm\Processors;

use NinjaForms\CiviCrmShared\Contracts\DataModelProvider;
use NinjaForms\CiviCrm\Contracts\ModuleProcessor;
use NinjaForms\CiviCrmSdk\Contracts\Activity as SdkObject;
use NinjaForms\CiviCrmShared\Contracts\LoggerInterface;

use NinjaForms\CiviCrmSdk\Entities\CreateObjectResponse;

use NinjaForms\CiviCrm\Processors\ModuleProcessorAbstract;

class ActivityProcessor extends ModuleProcessorAbstract implements ModuleProcessor
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

    /** @var DataModelProvider */
    protected $dataModelProvider;

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
     *
     * @param SdkObject $sdkObject
     * @param DataModelProvider $dataModelProvider
     * @param LoggerInterface $logger
     */
    public function __construct(SdkObject $sdkObject, DataModelProvider $dataModelProvider, LoggerInterface $logger)
    {
        $this->sdkObject = $sdkObject;

        $this->dataModelProvider = $dataModelProvider;

        $this->logger = $logger;
    }

    /** @inheritDoc */
    public function process(): ModuleProcessor
    {
        if( isset($this->submissionData['activity_field_map']) ){
            $fieldMapping = $this->dataModelProvider
                ->keyValuePairsFromCollection(
                    $this->submissionData['activity_field_map'],
                    'crm_field',
                    'form_field'
                );
        }
        
        if(empty($fieldMapping)){
            return $this;
        }
        
        if( isset($this->submissionData['activity_type']) ){
            $fieldMapping['activity_type_id']=$this->submissionData['activity_type'];
        }

        if( isset($this->submissionData['activity_status']) ){
            $fieldMapping['activity_status_id']=$this->submissionData['activity_status'];
        }

        if ( isset($this->recordIds['Contact'])) {
            
            try {
                $response = $this->sdkObject->create(
                    $fieldMapping,
                    [
                        'ActivityAddedByContact' => $this->recordIds['Contact'],
                        'ActivityWithContact' => $this->recordIds['Contact'],
                    ]
                );

                $this->recordIds['Activity'] = $response->getId();
                $this->responses[] = $response;
            } catch (\Throwable $e) {

                $this->logger->warning($e->getMessage() . ' => ActivityProcessor.process');
            }
        }

        return $this;
    }
}
