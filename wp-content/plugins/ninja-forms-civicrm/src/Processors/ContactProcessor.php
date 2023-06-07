<?php

namespace NinjaForms\CiviCrm\Processors;

use NinjaForms\CiviCrmShared\Contracts\DataModelProvider;
use NinjaForms\CiviCrmShared\Contracts\LoggerInterface;
use NinjaForms\CiviCrm\Contracts\ModuleProcessor;
use NinjaForms\CiviCrmSdk\Contracts\Contact as SdkObject;

use NinjaForms\CiviCrmSdk\Entities\CreateObjectResponse;

use NinjaForms\CiviCrm\Processors\ModuleProcessorAbstract;

use Civi\Api4\UFMatch;

class ContactProcessor extends ModuleProcessorAbstract implements ModuleProcessor
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
     * Matching mode for contact
     *
     * How should this processor handle potential matches?  Default is to always
     * create a new record
     * @var string
     */
    protected $matchMode = 'do_not_match';

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
        $fieldMapping = $this->constructFieldMapping();

        $this->matchMode = $this->submissionData['contact_match_options'];
        
        // ensure we have an integer or stringed integer for dedupe rule
        // ensure there is an email set; we will use the first email mapped
        if (
            isset($this->submissionData['contact_match_options'])
            && (int)$this->submissionData['contact_match_options'] == $this->submissionData['contact_match_options']
            && isset($fieldMapping['contact_type'])
            && isset($this->submissionData['email_field_map'][0]['email'])
            
        ) {

            $dedupeRuleId = (int)$this->submissionData['contact_match_options'];
            $contactType = $fieldMapping['contact_type'];
            $email = $this->submissionData['email_field_map'][0]['email'];

            // add email, keyed on 'email' to 
            $contactWithEmail =array_merge($fieldMapping,['email'=>$email]);

            $dedupeId = $this->contactDedupe($contactWithEmail, $contactType, $dedupeRuleId);

            if(0==$dedupeId){
                $this->createNewContact($fieldMapping);
            }else{

                $response = new CreateObjectResponse();
                $response->setEntity('Contact')
                ->setIsSuccessful(true)
                ->setContext(self::class.'_process');

                $response->setId($dedupeId);

                $this->recordIds['Contact'] = $response->getId();
                $this->responses[] = $response;

                // indicate that we are now working with a duplicate
                $this->setIsDupe(true);
                
            }

        } else {

            $this->createNewContact($fieldMapping);
        }

        return $this;
    }

    /**
     * Create a new contact from submission data
     *
     * @return void
     */
    protected function createNewContact(array $fieldMapping): void
    {

        
        if (!empty($fieldMapping)) {
            try {
                $response = $this->sdkObject->create($fieldMapping);

                $this->recordIds['Contact'] = $response->getId();

                $this->responses[] = $response;
            } catch (\Throwable $e) {

                $this->logger->warning($e->getMessage() . ' => ContactProcessor.process');
            }
        }
    }


    /**
     * Construct contact field mapping from dataModelProvider
     *
     * @return array
     */
    protected function constructFieldMapping(): array
    {
        $return = $this->dataModelProvider
            ->keyValuePairsFromCollection(
                $this->submissionData['contact_field_map'],
                'crm_field',
                'form_field'
            );

        if (isset($this->submissionData['contact_type']) && "" !== $this->submissionData['contact_type']) {
            $return['contact_type'] = $this->submissionData['contact_type'];
        }

        if (isset($this->submissionData['contact_sub_type']) && "" !== $this->submissionData['contact_sub_type']) {
            $return['contact_sub_type'] = $this->submissionData['contact_sub_type'];
        }

        return $return;
    }

    protected function contactDedupe( array $contactWithEmailAdded, string $contactType, int $dedupeRuleId ) {
		// Dupes params
		$dedupeParams = \CRM_Dedupe_Finder::formatParams( $contactWithEmailAdded, $contactType );
		$dedupeParams['check_permission'] = FALSE;

		// Check dupes
		$cids = \CRM_Dedupe_Finder::dupesByParams( $dedupeParams, $contactType, NULL, [], $dedupeRuleId );
		$cids = array_reverse( $cids );
        
		return $cids ? array_pop( $cids ) : 0;
	}
}
