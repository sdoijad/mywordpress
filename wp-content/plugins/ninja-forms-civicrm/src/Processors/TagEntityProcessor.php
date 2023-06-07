<?php

namespace NinjaForms\CiviCrm\Processors;

use NinjaForms\CiviCrmShared\Contracts\LoggerInterface;
use NinjaForms\CiviCrm\Contracts\ModuleProcessor;
use NinjaForms\CiviCrmSdk\Contracts\TagEntity as SdkObject;
use NinjaForms\CiviCrmSdk\Entities\CreateObjectResponse;

use NinjaForms\CiviCrm\Processors\ModuleProcessorAbstract;

class TagEntityProcessor extends ModuleProcessorAbstract implements ModuleProcessor
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
        $fieldMappingCollection = isset($this->submissionData['create_entity_tag']) ? $this->submissionData['create_entity_tag'] : [];

        if (!empty($fieldMappingCollection)) {

            foreach ($fieldMappingCollection as $fieldMapping) {
                // stop if no tag id set or key is not set
                if (isset($fieldMapping['tag_id']) && '' == $fieldMapping['tag_id'] || !isset($fieldMapping['field_conditional_match_value']) || !isset($fieldMapping['field_conditional'])) {
                    continue;
                }

                // stop if condition not met
                if ('' !== $fieldMapping['field_conditional_match_value'] && $fieldMapping['field_conditional'] !== $fieldMapping['field_conditional_match_value']) {
                    continue;
                }

                // Get associated entity id, if set; stop if not set
                if ('civicrm_contact' === $fieldMapping['tagged_entity'] && isset($this->recordIds['Contact'])) {

                    $entityId = $this->recordIds['Contact'];
                } elseif ('civicrm_activity' === $fieldMapping['tagged_entity'] && isset($this->recordIds['Activity'])) {

                    $entityId = $this->recordIds['Activity'];
                } else {

                    continue;
                }

                $array = [
                    'tag_id' => $fieldMapping['tag_id'],
                    'entity_table' => $fieldMapping['tagged_entity'],
                    'entity_id' => $entityId
                ];
                
                $this->createTag($array);
            }
        }
        return $this;
    }

    /**
     * Request SDK object to create tag
     *
     * @param array $array
     * @return void
     */
    protected function createTag(array $array): void
    {
        try {
            $response = $this->sdkObject->create(
                $array
            );

            $this->recordIds['EntityTag'][] = $response->getId();

            $this->responses[] = $response;
        } catch (\Throwable $e) {

            $this->logger->warning($e->getMessage() . ' => TagEntityProcessor.createTag');
        }
    }
}
