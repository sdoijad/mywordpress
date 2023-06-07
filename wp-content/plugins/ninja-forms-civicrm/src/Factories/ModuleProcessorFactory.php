<?php

namespace NinjaForms\CiviCrm\Factories;

use NinjaForms\CiviCrmShared\Contracts\LoggerInterface;
use NinjaForms\CiviCrm\Contracts\ModuleProcessorFactory as ContractsModuleProcessorFactory;
use NinjaForms\CiviCrmSdk\Contracts\CiviObjectsFactory;
use NinjaForms\CiviCrm\Contracts\ModuleProcessorCollection as ContractsModuleProcessorCollection;

use NinjaForms\CiviCrm\Processors\ContactProcessor;
use NinjaForms\CiviCrm\Processors\EmailProcessor;
use NinjaForms\CiviCrm\Processors\PhoneProcessor;
use NinjaForms\CiviCrm\Processors\ImProcessor;
use NinjaForms\CiviCrm\Processors\WebsiteProcessor;
use NinjaForms\CiviCrm\Processors\AddressProcessor;
use NinjaForms\CiviCrm\Processors\ActivityProcessor;
use NinjaForms\CiviCrm\Processors\GroupContactProcessor;
use NinjaForms\CiviCrm\Processors\TagEntityProcessor;
use NinjaForms\CiviCrm\Processors\ParticipantProcessor;
use NinjaForms\CiviCrm\Processors\NoteProcessor;
use NinjaForms\CiviCrm\Processors\LineItemProcessor;

use NinjaForms\CiviCrm\Handlers\ModuleProcessorCollection;
use NinjaForms\CiviCrmShared\Contracts\DataModelProvider;

class ModuleProcessorFactory implements ContractsModuleProcessorFactory
{

    /** @var CiviObjectsFactory */
    protected $civiObjectsFactory;

    /** @var DataModelProvider */
    protected $dataModelProvider;

    /** @var LoggerInterface */
    protected $logger;

    public function __construct(CiviObjectsFactory $civiObjectsFactory, DataModelProvider $dataModelProvider, LoggerInterface $logger)
    {
        $this->civiObjectsFactory = $civiObjectsFactory;

        $this->dataModelProvider = $dataModelProvider;

        $this->logger = $logger;
    }

    /**
     * Provide a collection of Module Processors
     * 
     * Constructs required form processors in processing order
     *
     * @return ContractsModuleProcessorCollection
     */
    public function getModuleProcessors(): ContractsModuleProcessorCollection
    {
        $subProcessorCollection = new ModuleProcessorCollection();

        $subProcessorCollection->addObject(new ContactProcessor(
            $this->civiObjectsFactory->contact(),
            $this->dataModelProvider,
            $this->logger
        ));

        $subProcessorCollection->addObject(new EmailProcessor(
            $this->civiObjectsFactory->email(),
            $this->logger
        ));

        $subProcessorCollection->addObject(new PhoneProcessor(
            $this->civiObjectsFactory->phone(),
            $this->logger
        ));

        $subProcessorCollection->addObject(new ImProcessor(
            $this->civiObjectsFactory->iM(),
            $this->logger
        ));

        $subProcessorCollection->addObject(new WebsiteProcessor(
            $this->civiObjectsFactory->website(),
            $this->logger
        ));

        $subProcessorCollection->addObject(new AddressProcessor(
            $this->civiObjectsFactory->address(),
            $this->logger
        ));

        $subProcessorCollection->addObject(new ActivityProcessor(
            $this->civiObjectsFactory->activity(),
            $this->dataModelProvider,
            $this->logger
        ));

        $subProcessorCollection->addObject(new GroupContactProcessor(
            $this->civiObjectsFactory->groupContact(),
            $this->logger
        ));

        $subProcessorCollection->addObject(new TagEntityProcessor(
            $this->civiObjectsFactory->tagEntity(),
            $this->logger
        ));

        $subProcessorCollection->addObject(new ParticipantProcessor(
            $this->civiObjectsFactory->participant(),
            $this->logger
        ));

        $subProcessorCollection->addObject(new NoteProcessor(
            $this->civiObjectsFactory->note(),
            $this->logger
        ));

        $subProcessorCollection->addObject(new LineItemProcessor(
            $this->civiObjectsFactory->lineItem(),
            $this->logger
        ));

        $subProcessorCollection->rewind();

        return $subProcessorCollection;
    }
}
