<?php

namespace NinjaForms\CiviCrm\Processors;

use NinjaForms\CiviCrmShared\Contracts\LoggerInterface;

use NinjaForms\CiviCrm\Contracts\ModuleProcessor;
use NinjaForms\CiviCrmSdk\Contracts\Website as SdkObject;
use NinjaForms\CiviCrmSdk\Entities\CreateObjectResponse;

use NinjaForms\CiviCrm\Processors\ModuleProcessorAbstract;

class WebsiteProcessor extends ModuleProcessorAbstract implements ModuleProcessor
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
        'website_type_id_name' => 'website_type_id:name'
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

            $existingRecords = $this->getExistingWebsites($contactRecordId);

            foreach ($fieldMappingCollection as $fieldMapping) {

                try {
                    if (\in_array($fieldMapping['url'], $existingRecords)) {

                        continue;
                    }

                    $response = $this->createWebsiteEntry($fieldMapping,$contactRecordId);

                    $this->appendResponseData($response);
                } catch (\Throwable $e) {

                    $this->logError($e);
                }
            }
        }

        return $this;
    }

            /**
     * Return indexed array of existing phone numbers for a given contact Id
     *
     * @param string $contactRecordId
     * @return array
     */
    protected function getExistingWebsites( string $contactRecordId): array
    {
        $return = [];
        $existingRecords = $this->filterExistingRecords($contactRecordId);

        if(is_array($existingRecords)){
            $return = \array_column($existingRecords,'url');
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

        if (!isset($this->submissionData['website_field_map'])) {
            return $return;
        }

        foreach ($this->submissionData['website_field_map'] as $optionRepeaterValue) {

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
     * Create a new phone record entry linked to contact id
     *
     * @param array $fieldMapping
     * @param string $contactRecordId
     * @return CreateObjectResponse
     */
    protected function createWebsiteEntry(array $fieldMapping, $contactRecordId): CreateObjectResponse
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
        $this->recordIds['Website'][] = $response->getId();

        $this->responses[] = $response;
    }

    /**
     * Log the throwable
     *
     * @param \Throwable $e
     * @return void
     */
    protected function logError(\Throwable $e): void
    {
        $this->logger->warning($e->getMessage() . ' => WebsiteProcessor.process');
    }
}
