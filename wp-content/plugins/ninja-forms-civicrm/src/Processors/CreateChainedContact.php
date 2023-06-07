<?php

namespace NinjaForms\CiviCrm\Processors;

use NinjaForms\CiviCrm\Contracts\ModuleProcessor;
use NinjaForms\CiviCrmShared\Contracts\FormActionProcessor as ContractsFormActionProcessor;
use NinjaForms\CiviCrmShared\Contracts\DataModelProvider;
use NinjaForms\CiviCrm\Contracts\ModuleProcessorFactory;
use NinjaForms\CiviCrmSdk\Contracts\CiviObjectsFactory as ContractsCiviObjectsFactory;

use NinjaForms\CiviCrmShared\Contracts\LoggerInterface;

use NinjaForms\CiviCrmShared\Abstracts\FormActionProcessor as AbstractsFormActionProcessor;

use NinjaForms\CiviCrmShared\Handlers\ExtraDataHandler;

/**
 * Create CiviCRM Contact with chained child objects
 * 
 * ### Functionality ###
 * 1.  Create a new Contact
 * 2.  Create multiple emails linked to Contact using pre-defined 'location names'
 * 3.  Create multiple address linked to Contact using pre-defined 'location names'
 * 4.  Create a new Activity linked to Contact
 * 5.  Subscribe contact to a group
 * 6.  Add tags to contact and activity
 * 7.  Add line items for events and memberships
 * 8.  Add participants directly to free events
 * 9.  Add note to contact or participant
 * 10. Uniquely identify contact when creating multiple contacts on same form
 * 11. Option to disable storage of communication diagnostics data (not the actual submission data)
 * 
 * @package FormProcessing
 */
class CreateChainedContact extends AbstractsFormActionProcessor implements ContractsFormActionProcessor
{

    /** @var  ContractsCiviObjectsFactory */
    protected $civiObjectsFactory;

    /** @var DataModelProvider    */
    protected $dataModelProvider;

    /** @var ModuleProcessorFactory */
    protected $moduleProcessorFactory;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * Ids of newly created records
     *
     * @var array
     */
    protected $recordIds = [];

    /** @var ExtraDataHandler */
    protected $extraDataHandler;

    /**
     * Processing key to uniquely identify action during processing
     *
     * @var string
     */
    protected $processorKey;

    /**
     * Construct
     * 
     * @param array $actionConfiguration
     * @param ContractsCiviObjectsFactory $civiObjectsFactory
     * @param DataModelProvider $dataModelProvider
     * @param ExtraDataHandler $extraDataHandler
     * @param ModuleProcessorFactory $moduleProcessFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        array $actionConfiguration,
        ContractsCiviObjectsFactory $civiObjectsFactory,
        DataModelProvider $dataModelProvider,
        ExtraDataHandler $extraDataHandler,
        ModuleProcessorFactory $moduleProcessFactory,
        LoggerInterface $logger
    ) {
        parent::__construct($actionConfiguration);

        $this->civiObjectsFactory = $civiObjectsFactory;
        $this->dataModelProvider = $dataModelProvider;
        $this->extraDataHandler = $extraDataHandler;
        $this->moduleProcessorFactory = $moduleProcessFactory;
        $this->logger = $logger;
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
        $this->finalizeContactFields();
        $this->finalizeContactTypes();
        $this->finalizeActivityFields();
        $this->finalizeCreateGroupContact();
        $this->finalizeCreateEntityTag();
        $this->finalizeContactMatchOptions();

        return $this->actionConfiguration['actionSettings'];
    }

    /**
     * Populate contact fields
     *
     * @return void
     */
    protected function finalizeContactFields(): void
    {
        if (!isset($this->actionConfiguration['actionSettings']['contact_field_map'])) {
            return;
        }
        try {
            $contactFieldCollection = $this->civiObjectsFactory->contact()->getFields();
        } catch (\Exception $e) {
            $this->logger->warning($e->getMessage() . ' => CreateChainedContact.finalizeActionSettings.contactFieldCollection');
            $contactFieldCollection = [];
        }

        $this->actionConfiguration['actionSettings']['contact_field_map']['columns']['crm_field']['options']
        = $this->dataModelProvider->labelValuePairsFromCollection(
            $contactFieldCollection,
            'label',
            'name'
        );
    }

    /**
     * Populate contact type and subtype
     *
     * types/subtypes contained in one object; differentiator is presence of a parent_id, which designates it as a sub type
     * @return void
     */
    protected function finalizeContactTypes(): void
    {
        // if neither is set, don't make unneccessary DB call
        if (!isset($this->actionConfiguration['actionSettings']['contact_type']) && !isset($this->actionConfiguration['actionSettings']['contact_sub_type'])) {
            return;
        }

        $contactTypes = [];
        $contactSubTypes = [];
        $pleaseSelect =     [    
            'label'=>__('- Please Select ','ninja-forms-civicrm'),
            'value'=>''
        ];

        try {
            $allTypes = $this->civiObjectsFactory->contactType()->getRecords();
            
            foreach($allTypes as $type){

                if(!isset($type['parent_id']) || \is_null($type['parent_id'])){
                    $contactTypes[]=$type;
                }else{
                    $contactSubTypes[]=$type;
                }
            }

        } catch (\Exception $e) {
            $this->logger->warning($e->getMessage() . ' => CreateChainedContact.finalizeActionSettings.contactFieldCollection');

        }


        if (isset($this->actionConfiguration['actionSettings']['contact_type'])) {

            $this->actionConfiguration['actionSettings']['contact_type']['options']
            = $this->dataModelProvider->labelValuePairsFromCollection(
                $contactTypes,
                'label',
                'name'
            );

            \array_unshift($this->actionConfiguration['actionSettings']['contact_type']['options'], $pleaseSelect);
        }

        if (isset($this->actionConfiguration['actionSettings']['contact_sub_type'])) {
            $this->actionConfiguration['actionSettings']['contact_sub_type']['options']
            = $this->dataModelProvider->labelValuePairsFromCollection(
                $contactSubTypes,
                'label',
                'name'
            );

            \array_unshift($this->actionConfiguration['actionSettings']['contact_sub_type']['options'], $pleaseSelect);
        } 
       
    }

    /**
     * Adds select options with common name label and ISO country code value
     *
     * Not currently used; this option was switched out to enable merge tags to
     * set value; this option can be used if a hard-coded mapping is required
     *
     * @return void
     */
    protected function finalizeAddressFields( ): void
    {
        if (isset($this->actionConfiguration['actionSettings']['address_field_map'])) {
            try {
                $countryCollection = $this->civiObjectsFactory->country()->getRecords();
            } catch (\Exception $e) {
                $this->logger->warning($e->getMessage() . ' => CreateChainedContact.finalizeActionSettings.countryCollection');
                $countryCollection = [];
            }


            $this->actionConfiguration['actionSettings']['address_field_map']['columns']['country_id_name']['options']
                = $this->dataModelProvider->labelValuePairsFromCollection(
                    $countryCollection,
                    'name',
                    'iso_code'
                );
                
            $pleaseSelect = ['label'=>__('- Please select','ninja-forms-civicrm'),'value'=>''];

            array_unshift($this->actionConfiguration['actionSettings']['address_field_map']['columns']['country_id_name']['options'],$pleaseSelect);
        }
    }
  
    /**
     * Populate activity fields
     *
     * @return void
     */
    protected function finalizeActivityFields(): void
    {
        $this->modifyActivityFieldMap();
        $this->modifyActivityLookups();
    }

    /**
     * Retrieve label value pairs for all Activity fields, except status and type
     *
     * @return void
     */
    protected function modifyActivityFieldMap( ): void
    {
        if (!isset($this->actionConfiguration['actionSettings']['activity_field_map'])) {
            return;
        }

        try {
            $activityFieldCollection = $this->civiObjectsFactory->activity()->getFields();

            // Remove status and type from field map; these are done with select dropdowns
            $activityFieldMap = [];
            foreach ($activityFieldCollection as $activityField) {
                $doNotAddToFieldMap = isset($activityField['name']) && ('activity_type_id' == $activityField['name'] || 'status_id' == $activityField['name']);
                if( !$doNotAddToFieldMap ){
                    $activityFieldMap[]=$activityField; 
                }
            }

        } catch (\Exception $e) {
            $this->logger->warning($e->getMessage() . ' => CreateChainedContact.finalizeActionSettings.modifyActivityFieldMap');
            $activityFieldMap = [];
        }

        $this->actionConfiguration['actionSettings']['activity_field_map']['columns']['crm_field']['options']
        = $this->dataModelProvider->labelValuePairsFromCollection(
            $activityFieldMap,
            'label',
            'name'
        );
    }

    /**
     * Populate the Actity Stype dropdown with available statuses (sp?) for Contacts
     *
     * @return void
     */
    protected function modifyActivityLookups(): void
    {
        if (!isset($this->actionConfiguration['actionSettings']['activity_type'])) {
            return;
        }

        $activityTypeGroupId = '-1';
        $activityStatusGroupId = '-1';

        try {
            $groupIds = $this->findActivityGroupIds();
            $activityTypeGroupId = (string)$groupIds[0];
            $activityStatusGroupId = (string)$groupIds[1];
        } catch (\Exception $e) {

            $this->logger->warning($e->getMessage() . ' => CreateChainedContact.finalizeActionSettings.modifyActivityLookups');
        }

        $activityTypes = [];
        $activityStatuses = [];

        try {

            $lookups = $this->findActivityLookups($activityTypeGroupId, $activityStatusGroupId);
            $activityTypes = $lookups[0];
            $activityStatuses = $lookups[1];
        } catch (\Exception $e) {

            $this->logger->warning($e->getMessage() . ' => CreateChainedContact.finalizeActionSettings.modifyActivityLookups');
        }

        $pleaseSelect =     [    
            'label'=>__('- Please Select ','ninja-forms-civicrm'),
            'value'=>''
        ];

        $this->actionConfiguration['actionSettings']['activity_type']['options']  = $activityTypes;
        \array_unshift($this->actionConfiguration['actionSettings']['activity_type']['options'], $pleaseSelect);

        $this->actionConfiguration['actionSettings']['activity_status']['options'] = $activityStatuses;
        \array_unshift($this->actionConfiguration['actionSettings']['activity_status']['options'], $pleaseSelect);

    }

    /**
     * Get OptionGroup Ids for activity type and status
     *
     * @return array Indexed array of [activityTypeGroupId,activityStatusGroupId]
     */
    protected function findActivityGroupIds( ): array
    {
        $activityTypeGroupId = '-1';
        $activityStatusGroupId = '-1';

        $optionGroups = $this->civiObjectsFactory->optionGroup()->getRecords();

        foreach ($optionGroups as $optionGroup) {

            if (!isset($optionGroup['name'])    || !isset($optionGroup['id'])) {
                continue;
            }

            if ('activity_type' == $optionGroup['name']) {
                $activityTypeGroupId = $optionGroup['id'];
                continue;
            }

            if ('activity_status' == $optionGroup['name']) {
                $activityStatusGroupId = $optionGroup['id'];
            }
        }

        return [$activityTypeGroupId, $activityStatusGroupId];
    }

    /**
     * Finds lookups for Activity type and status
     *
     * @return array Indexed array of [ activityTypeNameLabel, activityStatusNameLabel]
     */
    protected function findActivityLookups(string $activityTypeGroupId, string $activityStatusGroupId ): array
    {
        $activityTypes = [];
        $activityStatuses = [];

        $optionValues = $this->civiObjectsFactory->optionValue()->getRecords();

        foreach ($optionValues as $optionValue) {

            if (
                !isset($optionValue['label'])
                || !isset($optionValue['value'])
                || !isset($optionValue['option_group_id'])
            ) {
                continue;
            }

            if ($activityTypeGroupId  == $optionValue['option_group_id']) {

                $activityTypes[] =                            [
                    'value' => $optionValue['value'],
                    'label' => $optionValue['name']
                ];

                continue;
            }

            if (($activityStatusGroupId  == $optionValue['option_group_id'])) {

                $activityStatuses[] =                            [
                    'value' => $optionValue['value'],
                    'label' => $optionValue['name']
                ];
            }
        }

        return [$activityTypes,$activityStatuses];
    }

    /**
     * Populate group dropdown select values
     *
     * @return void
     */
    protected function finalizeCreateGroupContact(): void
    {
        if (!isset($this->actionConfiguration['actionSettings']['create_group_contact'])) {
            return;
        }

        try {
            $groups = $this->civiObjectsFactory->group()->getRecords();
            $groupLabelValuePairsRaw = $this->dataModelProvider->labelValuePairsFromCollection($groups, 'title', 'id');

            // Convert integer to string for textbox value
            $groupLabelValuePairs = array_map(
                function ($row) {
                    $row['value'] = (string)$row['value'];
                    return $row;
                },
                $groupLabelValuePairsRaw
            );
        } catch (\Exception $e) {

            $this->logger->warning($e->getMessage() . ' => CreateChainedContact.finalizeActionSettings.groupLabelValuePairs');
            $groupLabelValuePairs = [];
        }

        $this->actionConfiguration['actionSettings']['create_group_contact']['columns']['group_id']['options']
        = $groupLabelValuePairs;
    }

    /**
     * Populate tag field map as dropdown
     *
     * @return void
     */
    protected function finalizeCreateEntityTag( ): void
    {
        if (!isset($this->actionConfiguration['actionSettings']['create_entity_tag'])) {
            return;
        }

        try {
            $tags = $this->civiObjectsFactory->tag()->getRecords();

            $tagsLabelValuePairsRaw = $this->dataModelProvider->labelValuePairsFromCollection($tags, 'name', 'id');

            // Convert integer to string for textbox value
            $tagsLabelValuePairs = array_map(
                function ($row) {
                    $row['value'] = (string)$row['value'];
                    return $row;
                },
                $tagsLabelValuePairsRaw
            );
        } catch (\Exception $e) {

            $this->logger->warning($e->getMessage() . ' => CreateChainedContact.finalizeActionSettings.createEntityTag');
            $tagsLabelValuePairs = [];
        }

        $this->actionConfiguration['actionSettings']['create_entity_tag']['columns']['tag_id']['options']
        = $tagsLabelValuePairs;
    }

    /**
     * Populate ContactMatchOptions with DedupeRuleGroups for `Individuals`
     *
     * @return void
     */
    protected function finalizeContactMatchOptions(): void
    {
        if (!isset($this->actionConfiguration['actionSettings']['activity_type'])) {
            return;
        }

        try {
            $dedupeRuleGroupCollection = $this->findDedupeRuleGroupsForIndividuals();

        } catch (\Exception $e) {

            $this->logger->warning($e->getMessage() . ' => CreateChainedContact.finalizeContactMatchOptions.modifyActivityLookups');
        }

        $dedupeRuleGroupOptions=$this->dataModelProvider->labelValuePairsFromCollection($dedupeRuleGroupCollection,'title','id');

        $pleaseSelect =     [    
            'label'=>__('Do not use Dedupe Rule Group', 'ninja-forms-civicrm'),
            'value'=>'do_not_match'
        ];

        $this->actionConfiguration['actionSettings']['contact_match_options']['options']  = $dedupeRuleGroupOptions;
        \array_unshift($this->actionConfiguration['actionSettings']['contact_match_options']['options'], $pleaseSelect);

    }

    /**
     * Returns collection of DedupeRuleGroup where contact type is Individual
     *
     * Returns indexed array of DedupeRuleGroup-as-associative array.  Each
     * element is ensured to have `contact_type`, `id` and `title`, so these can
     * be referenced without checking isset
     *
     * @return array
     */
    protected function findDedupeRuleGroupsForIndividuals( ): array
    {
        $dedupeRuleGroupCollection = [];

        $allDedupeRuleGroups = $this->civiObjectsFactory->dedupeRuleGroup()->getRecords();

        foreach ($allDedupeRuleGroups as $dedupeRuleGroup) {

            if (!isset($dedupeRuleGroup['contact_type'])    
            || !isset($dedupeRuleGroup['id'])
            || !isset($dedupeRuleGroup['title'])
            ) {
                continue;
            }

            if ('Individual' == $dedupeRuleGroup['contact_type']) {
                $dedupeRuleGroupCollection[]=$dedupeRuleGroup;
            }

        }

        return $dedupeRuleGroupCollection;
   
    }

    /** @inheritDoc */
    public function processSubmissionData(): void
    {
        $this->extraDataHandler->setData($this->data);

        $this->processorKey = $this->submissionData['action_processor_key'];

        if ('' == $this->processorKey) {
            $this->processorKey = 0;
        }

        $subProcessorsCollection = $this->moduleProcessorFactory->getModuleProcessors();

        $isDupe = false;

        
        foreach ($subProcessorsCollection as $subProcessor) {
            /** @var ModuleProcessor $subProcessor */
            $subProcessor = $subProcessorsCollection->current();
            $subProcessor->setSubmissionData($this->submissionData);
            $subProcessor->setRecordIds($this->recordIds);
            $subProcessor->setIsDupe($isDupe);

            $subProcessor->process();

            $isDupe = $subProcessor->isDupe();
            
            $responses = $subProcessor->getResponses();

            foreach ($responses as $response) {
                $this->extraDataHandler->appendHandledResponse($response->toArray(), $this->processorKey);
            }

            $this->recordIds = $subProcessor->getRecordIds();
        }

        $disableDataStorage = $this->submissionData['disable_results_storage'];

        if (!$disableDataStorage) {
            $this->data = $this->extraDataHandler->getData();
        }
    }
}
