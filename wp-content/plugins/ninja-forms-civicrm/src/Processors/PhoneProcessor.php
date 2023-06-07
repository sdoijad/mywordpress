<?php

namespace NinjaForms\CiviCrm\Processors;

use NinjaForms\CiviCrmShared\Contracts\LoggerInterface;
use NinjaForms\CiviCrm\Contracts\ModuleProcessor;
use NinjaForms\CiviCrmSdk\Contracts\Phone as SdkObject;
use NinjaForms\CiviCrmSdk\Entities\CreateObjectResponse;

use NinjaForms\CiviCrm\Processors\ModuleProcessorAbstract;

class PhoneProcessor extends ModuleProcessorAbstract implements ModuleProcessor
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

        if (!empty($fieldMappingCollection)) {
    
            $contactRecordId = $this->recordIds['Contact'];

            $existingPhoneNumbers = $this->getExistingPhoneNumbers($contactRecordId);
            
            foreach ($fieldMappingCollection as $fieldMapping) {
                try {
                    
                    if(\in_array($fieldMapping['phone'],$existingPhoneNumbers)){
                        continue;
                    }

                    $response = $this->createPhoneEntry($fieldMapping,$contactRecordId);

                    $this->appendResponseData($response);
                    
                } catch (\Throwable $e) {

                    $this->logError($e);
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

        if (!isset($this->submissionData['phone_field_map'])) {
            return $return;
        }

        foreach ($this->submissionData['phone_field_map'] as $optionRepeaterValue) {

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

    /**
     * Return indexed array of existing phone numbers for a given contact Id
     *
     * @param string $contactRecordId
     * @return array
     */
    protected function getExistingPhoneNumbers( string $contactRecordId): array
    {
        $return = [];
        $existingRecords = $this->filterExistingRecords($contactRecordId);

        if(is_array($existingRecords)){
            $return = \array_column($existingRecords,'phone');
        }

        return $return;
    }

    protected function filterExistingRecords(string $contactRecordId ): array
    {
        $return = $this->sdkObject->filterRecordsWhere('contact_id',$contactRecordId);

        if(!is_array($return)){
            $return = [];
        }

        return $return;

    }

    /**
     * Create a new phone record entry linked to contact id
     *
     * @param array $fieldMapping
     * @param string $contactRecordId
     * @return CreateObjectResponse
     */
    protected function createPhoneEntry(array $fieldMapping, $contactRecordId): CreateObjectResponse
    {
        $response = $this->sdkObject->create($fieldMapping, ['Contact' => $contactRecordId]);

        return $response;
    }

    /**
     * Append response data into object properties
     *
     * @param CreateObjectResponse $response
     * @return void
     */
    protected function appendResponseData(CreateObjectResponse $response): void
    {
        $this->recordIds['Phone'][] = $response->getId();

        $this->responses[] = $response;
    }

    /**
     * Log the throwable
     *
     * @param \Throwable $e
     * @return void
     */
    protected function logError(\Throwable $e ): void
    {
        $this->logger->warning($e->getMessage() . ' => PhoneProcessor.process');
    }
}
