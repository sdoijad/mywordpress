<?php

namespace NinjaForms\CiviCrm\Factories;

use NinjaForms\CiviCrmSdk\Contracts\CiviObjectsFactory;
use NinjaForms\CiviCrm\Contracts\DataAccessFactory as ContractsDataAccessFactory;

use NinjaForms\CiviCrmShared\Contracts\LoggerInterface;

use NinjaForms\CiviCrm\Factories\DataAccessFactory;
use NinjaForms\CiviCrm\Factories\ModuleProcessorFactory;

use NinjaForms\CiviCrmShared\Handlers\NfAdminMarkup;
use NinjaForms\CiviCrmShared\Handlers\Configure;
use NinjaForms\CiviCrmShared\Handlers\FormAction;
use NinjaForms\CiviCrmShared\Handlers\DataModelProvider;
use NinjaForms\CiviCrmShared\Handlers\ExtraDataHandler;

use NinjaForms\CiviCrm\Handlers\SubmissionMetabox;
use NinjaForms\CiviCrm\Handlers\VerifyDbConnection;
use NinjaForms\CiviCrm\Processors\CreateChainedContact as CreateChainedContact;
use NinjaForms\CiviCrm\Processors\CreateOrder;

/**
 * Instantiates and provides requested objects
 *
 * Primarily this factory is used for objects that require complex construction
 * dependent on other classes, or require runtime-only construction.
 */
class MasterFactory
{
    /** @var Configure */
    protected $configure;

    /** @var CiviObjectsFactory */
    protected $civiObjectsFactory;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * Construct with a configure object and CiviCrm Factory
     * 
     * @param Configure $configure
     * @param CiviObjectsFactory $civiObjectsFactory
     */
    public function __construct(Configure $configure, LoggerInterface $logger, CiviObjectsFactory $civiObjectsFactory)
    {
        $this->configure = $configure;

        $this->logger = $logger;

        $this->civiObjectsFactory = $civiObjectsFactory;
    }

    /**
     * Construct CreateChainedContacts form action
     *
     * @return FormAction
     */
    public function createContactFormAction(): FormAction
    {
        $actionConfiguration = $this->constructCreateContactActionConfiguration();

        $action = new FormAction(
            new CreateChainedContact(
                $actionConfiguration,
                $this->civiObjectsFactory,
                new DataModelProvider(),
                new ExtraDataHandler($actionConfiguration['name']),
                $this->moduleProcesorFactory(),
                $this->logger
            )
        );

        return $action;
    }



    /**
     * Construct CreateOrder form action
     *
     * @return FormAction
     */
    public function createOrderAction(): FormAction
    {
        $actionConfiguration = $this->constructCreateOrderActionSettings();

        $action = new FormAction(
            new CreateOrder(
                $actionConfiguration,
                $this->civiObjectsFactory,
                new DataModelProvider(),
                new ExtraDataHandler($actionConfiguration['name'])
            )
        );

        return $action;
    }

    /**
     * Constructs object that outputs submission metabox
     *
     * @return SubmissionMetabox
     */
    public function submissionMetaboxCreateEntries(): SubmissionMetabox
    {
        $actionConfiguration = $this->constructCreateContactActionConfiguration();

        $return = new SubmissionMetabox(
            $actionConfiguration['name'],
            $actionConfiguration['nicename'],
            new NfAdminMarkup()
        );

        return $return;
    }

    /**
     * Provide DataAccessFactory
     *
     * @return ContractsDataAccessFactory
     */
    public function dataAccessFactory(): ContractsDataAccessFactory
    {
        return new DataAccessFactory($this->civiObjectsFactory);
    }

    /**
     * Construct VerifyDbConnection object
     *
     * @return VerifyDbConnection
     */
    public function verifyDbConnection(): VerifyDbConnection
    {
        $contact = $this->civiObjectsFactory->contact();

        return new VerifyDbConnection($contact);
    }

    
    /**
     * Construct ModuleProcessorFactory
     *
     * @return ModuleProcessorFactory
     */
    protected function moduleProcesorFactory(): ModuleProcessorFactory
    {
        return  new ModuleProcessorFactory(
            $this->civiObjectsFactory,
            new DataModelProvider(),
            $this->logger
        );
    }
    /**
     * Consolidate the action settings required for the CreateChainedContact action
     * 
     * Each 
     */
    protected function constructCreateContactActionConfiguration(): array
    {
        $return = $this->configure->configure('create-contact-primary-action-settings');

        $return['actionSettings'] = array_merge(
            $this->configure->configure('contact-action-settings'),
            $this->configure->configure('email-action-settings'),
            $this->configure->configure('phone-action-settings'),
            $this->configure->configure('im-action-settings'),
            $this->configure->configure('website-action-settings'),
            $this->configure->configure('address-action-settings'),
            $this->configure->configure('activity-action-settings'),
            $this->configure->configure('group-contact-action-settings'),
            $this->configure->configure('tag-contact-action-settings'),
            $this->configure->configure('participant-action-settings'),
            $this->configure->configure('note-action-settings'),
            $this->configure->configure('action-processor-key-action-setting'),
            $this->configure->configure('results-storage-action-settings')
        );

        return $return;
    }

    /**
     * Merge CreateOrder settings into single ActionSettings configuration
     */
    protected function constructCreateOrderActionSettings(): array
    {
        $return = $this->configure->configure('create-order-primary-action-settings');

        $return['actionSettings'] = array_merge(
            $this->configure->configure('financial-type-id-action-setting'),
            $this->configure->configure('order-responsibility-key-action-setting'),
            $this->configure->configure('results-storage-action-settings')
        );

        return $return;
    }



    /**
     * Set boolean to bypass CiviCrm, using mocks
     *
     * @param  bool  $bypassCivi  Boolean to bypass CiviCrm, using mocks
     *
     * @return  MasterFactory
     */
    public function setBypassCivi(bool $bypassCivi): MasterFactory
    {
        $this->civiObjectsFactory->setBypassCivi($bypassCivi);
        return $this;
    }
}
