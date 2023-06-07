<?php

namespace NinjaForms\CiviCrmShared\Contracts;

/**
 * Contract for processing a form action
 * 
 * Form processor is injected into FormAction to honor contracted methods
 * 
 * @package FormProcessing
 */
interface FormActionProcessor
{

    /**
     * Return the action configuration array
     */
    public function getActionConfiguration(): array;

    /**
     * Modify and return the action settings at run time
     * @return void
     */
    public function finalizeActionSettings(): array;

    /**
     * Process the submitted form, returning updated $data
     * 
     * @param array $action_settings
     * @param type $form_id
     * @param array $data
     */
    public function process($action_settings, $form_id, $data): array;

    /** 
     * Modify the action settings at time of form save
     * 
     * @var array $action_settings Form action settings before save
     * @return array Form action settings modified for saving
     */
    public function save($action_settings): array;
}
