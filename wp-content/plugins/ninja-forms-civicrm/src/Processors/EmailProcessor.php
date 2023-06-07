<?php

namespace NinjaForms\CiviCrm\Processors;

use NinjaForms\CiviCrmShared\Contracts\LoggerInterface;
use NinjaForms\CiviCrm\Contracts\ModuleProcessor;
use NinjaForms\CiviCrmSdk\Contracts\Email as SdkObject;
use NinjaForms\CiviCrmSdk\Entities\CreateObjectResponse;

use NinjaForms\CiviCrm\Processors\ModuleProcessorAbstract;

class EmailProcessor extends ModuleProcessorAbstract implements ModuleProcessor
{

    /**
     * CiviCRM SDK object
     *
     * Use matching Sdk object for the request.  Phone object for phone
     * processing, email object for email processing, etc.
     *
     * @var SdkObject
     */
    protected $SdkObject;

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

    const FIELD_KEY_LOOKUPS = [
        'location_type_id_name' => 'location_type_id:name'
    ];

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
        $fieldMappingCollection = $this->extractSubmissionData();

        if (!empty($fieldMappingCollection) && !$this->isDupe()) {

            foreach ($fieldMappingCollection as $fieldMapping) {
                try {
                    $response = $this->sdkObject->create(
                        $fieldMapping,
                        ['Contact' => $this->recordIds['Contact']]
                    );

                    $this->recordIds['Email'][] = $response->getId();

                    $this->responses[] = $response;
                } catch (\Throwable $e) {

                    $this->logger->warning($e->getMessage() . ' => EmailProcessor.process');
                }
            }
        }

        return $this;
    }

    /**
     * Extract field mapping data from SubmissionData
     *
     * Where a key substitute is required (ex:a key structure we don't want to
     * use as a select field lookup key), the lookup values replace our safe
     * value with the API's value.
     *
     * @return array
     */
    protected function extractSubmissionData(): array
    {
        $return = [];

        if (!isset($this->submissionData['email_field_map'])) {
            return $return;
        }

        foreach ($this->submissionData['email_field_map'] as $optionRepeaterValue) {

            $newRecordRequest = [];

            foreach ($optionRepeaterValue as $key => $value) {
                if (isset(self::FIELD_KEY_LOOKUPS[$key])) {
                    $newRecordRequest[self::FIELD_KEY_LOOKUPS[$key]] = $value;
                } else {
                    $newRecordRequest[$key] = $value;
                }
            }

            $return[] = $newRecordRequest;
        }

        return $return;
    }
}
