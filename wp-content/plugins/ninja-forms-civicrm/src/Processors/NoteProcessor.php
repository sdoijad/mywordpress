<?php

namespace NinjaForms\CiviCrm\Processors;

use NinjaForms\CiviCrmShared\Contracts\LoggerInterface;
use NinjaForms\CiviCrm\Contracts\ModuleProcessor;
use NinjaForms\CiviCrmSdk\Contracts\Note as SdkObject;

use NinjaForms\CiviCrmSdk\Entities\CreateObjectResponse;

use NinjaForms\CiviCrm\Processors\ModuleProcessorAbstract;

class NoteProcessor extends ModuleProcessorAbstract implements ModuleProcessor
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
        $fieldMapping = isset($this->submissionData['note_field_map']) ? $this->submissionData['note_field_map'] : [];

        if (!empty($fieldMapping)) {
            foreach ($fieldMapping as $fieldMap) {
                // stop if no tag id set
                if (isset($fieldMap['tagged_entity']) && '' == $fieldMap['tagged_entity']) {
                    continue;
                }

                // Get associated entity id, if set; stop if not set
                if (isset($fieldMap['tagged_entity']) && 'civicrm_contact' === $fieldMap['tagged_entity'] && isset($this->recordIds['Contact'])) {

                    $entityId = $this->recordIds['Contact'];
                } elseif (isset($fieldMap['tagged_entity']) && 'civicrm_participant' === $fieldMap['tagged_entity'] && isset($this->recordIds['Participant'])) {

                    $entityId = $this->recordIds['Participant'];
                } else {

                    continue;
                }

                $array = [
                    'note' => $fieldMap['note'],
                    'subject' => $fieldMap['subject'],
                    'entity_table' => $fieldMap['tagged_entity'],
                    'entity_id' => $entityId
                ];

                try {
                    $response = $this->sdkObject->create(
                        $array
                    );
                    $this->recordIds['Note'] = $response->getId();

                    $this->responses[] = $response;
                } catch (\Throwable $e) {

                    $this->logger->warning($e->getMessage() . ' => NoteProcessor.process');
                }
            }
        }

        return $this;
    }
}
