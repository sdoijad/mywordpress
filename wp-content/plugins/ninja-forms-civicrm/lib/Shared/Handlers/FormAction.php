<?php

namespace NinjaForms\CiviCrmShared\Handlers;

use NinjaForms\CiviCrmShared\Contracts\FormActionProcessor;

/**
 * Form action object
 * 
 * Initialized with a configuration array and a Form Actions Processor.  The config defines parameters to 
 * initialize the form action.  The processor handles functionality unique to the action, such as modifying
 * the action settings, processing the submission, appending data to the form submissions' data
 */
class FormAction extends \NF_Abstracts_Action
{

    /**
     * Action configuration array
     *
     * @var array
     */
    public $actionConfiguration;

    /** @var FormActionProcessor */
    protected $formActionProcessor;

    public function __construct( FormActionProcessor $formActionProcessor)
    {
        $this->formActionProcessor = $formActionProcessor;
        $this->actionConfiguration = $this->formActionProcessor->getActionConfiguration();
        
        $this->_name = $this->actionConfiguration['name'];
        $this->_tags = $this->actionConfiguration['tags'];
        $this->_timing = $this->actionConfiguration['timing'];
        $this->_priority = $this->actionConfiguration['priority'];
        $this->_nicename = $this->actionConfiguration['nicename'];

        parent::__construct();

        // Deferred until admin_init so that all plugins are initialized
        add_action('admin_init',[$this,'finalizeSettings']);
    }

    /**
     * Adjust action settings at run time
     *
     * @return void
     */
    public function finalizeSettings(): void
    {
        $finalizedActionSettings = $this->formActionProcessor->finalizeActionSettings();

        $this->_settings = \array_merge($this->_settings, $finalizedActionSettings);
    }


    /** @inheritDoc */
    public function save($action_settings)
    {
        return $action_settings;
    }

    /**
     * Process the submitted form
     * @param array $action_settings
     * @param type $form_id
     * @param array $data
     */
    public function process($action_settings, $form_id, $data)
    {
        $dataAfterProcessing = $this->formActionProcessor->process($action_settings, $form_id, $data);

        return $dataAfterProcessing;
    }

    /**
     * Return action name
     * 
     * @return string
     */
    public function get_name(): string
    {
        return $this->_name;
    }

    /**
     * Returns custom form builder CSS filename relative to root
     * 
     * NOTE: full name including extension relative to the root directory
     * 
     * Returns empty string if not set
     * @return string
     */
    public function getActionCssFilename( ): string
    {
        $cssFilename = '';

        if(isset($this->actionConfiguration['actionCss'])){
            $cssFilename = $this->actionConfiguration['actionCss'];
        }

        return $cssFilename;
    }
}
