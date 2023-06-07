<?php

namespace NinjaForms\CiviCrmShared\Abstracts;

use NinjaForms\CiviCrmShared\Contracts\FormActionProcessor as ContractsFormActionProcessor;

/**
 * Extracts form submisson data to parallel form action's configuration array
 * 
 * Holds children accountable for a single method to initiate any processing
 * required with optional ability to modify NF's form process $data.
 * Child can optionally have a public method `registerCustomBuilderTemplates` to
 * load custom builder templates.  This is only necessary if the template is neither
 * in the Shared\Templates directory nor the plugin's Template directory, as templates
 * stored in either of those locations are automatically registered by the action registrar
 * 
 * @package FormProcessing
 */
abstract class FormActionProcessor implements ContractsFormActionProcessor
{

    /**
     * Configured action settingss
     *
     * @var array
     */
    protected $actionConfiguration;

    /**
     * Submission data array matching form action setting configuration
     *
     * @var array
     */
    protected $submissionData;

    /**
     * Form id
     *
     * @var string
     */
    protected $formId;

    /**
     * Form process data array
     *
     * Data passed to actions by the `process($action_settings, $form_id,
     * $data)` method at submission time. Any extra data to be stored with the
     * form submission is added to this property under the 'extra' key.
     * @see NinjaForms\CiviCrmShared\Handlers\ExtraDataHandler

     * @var array
     */
    protected $data;

    /**
     * Construct with action configuration array
     *
     * @param array $actionConfiguration Action configuration array
     */
    public function __construct(array $actionConfiguration)
    {
        $this->actionConfiguration = $actionConfiguration;

        if (\method_exists($this, 'registerCustomBuilderTemplates')) {
            add_action('ninja_forms_builder_templates', [$this, 'registerCustomBuilderTemplates']);
        }
    }
    /**
     * Return the action configuration array
     */
    public function getActionConfiguration(): array
    {
        return $this->actionConfiguration;
    }

    /** @inheritDoc */
    public function process($action_settings, $form_id, $data): array
    {

        $this->extractSubmissionData($action_settings);

        $this->formId = $form_id;

        $this->data = $data;

        $this->processSubmissionData();

        return $this->data;
    }

    /**
     * Modify and return the action settings at run time
     * 
     * If this method appears in a child object, then the default functionality
     * is being overridden, in which the action configuraion settings are being
     * modified at run time
     * @return void
     */
    public function finalizeActionSettings(): array
    {
        return $this->actionConfiguration['actionSettings'];
    }

    /**
     * Process the submission data, (optionally) update NF form process $data as $this->data
     *
     * @return void
     */
    abstract function processSubmissionData(): void;

    /**
     * Extract submission data as defined by the action configuration
     *
     * Stores value in $this->submissionData
     * 
     * @param array $action_settings
     * @return FormActionProcessor
     */
    protected function extractSubmissionData(array $action_settings): void
    {
        $submissionData = [];

        foreach ($this->actionConfiguration['actionSettings'] as $actionSetting) {
            $key = $actionSetting['name'];

            switch ($actionSetting['type']) {
                    // indexed array `column`=>subValue key value pairs
                case 'option-repeater':
                    $valuesToExtract = \array_keys($this->actionConfiguration['actionSettings'][$key]['columns']);

                    if(!isset($action_settings[$key])){
                        break;
                    }

                    foreach ($action_settings[$key] as $submittedValues) {
                        $repeatedSubmission = [];

                        foreach ($valuesToExtract as $submittedValueKey) {
                            if(isset($submittedValues[$submittedValueKey])){
                                $repeatedSubmission[$submittedValueKey] = $submittedValues[$submittedValueKey];
                            }
                        }
                        $submissionData[$key][] = $repeatedSubmission;
                    }

                    break;
                case 'textbox':
                default:
                    if(isset($action_settings[$key])){
                        $submissionData[$key] = $action_settings[$key];
                    }
                    break;
            }
        }
        $this->submissionData = $submissionData;
    }

    /** @inheritDoc     */
    public function save($action_settings): array
    {
        // default is to do nothing upon form save
        return $action_settings;
    }
}
