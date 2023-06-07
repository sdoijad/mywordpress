<?php

namespace NinjaForms\CiviCrmSdk\Factories;

use NinjaForms\CiviCrmSdk\Contracts\CiviObjectsFactory as ContractsCiviObjectsFactory;
use NinjaForms\CiviCrmSdk\Contracts\Activity as ContractsActivity;
use NinjaForms\CiviCrmSdk\Contracts\Event as ContractsEvent;
use NinjaForms\CiviCrmSdk\Contracts\Country as ContractsCountry;
use NinjaForms\CiviCrmSdk\Contracts\ContactType as ContractsContactType;
use NinjaForms\CiviCrmSdk\Contracts\OptionGroup as ContractsOptionGroup;
use NinjaForms\CiviCrmSdk\Contracts\OptionValue as ContractsOptionValue;
use NinjaForms\CiviCrmSdk\Contracts\DedupeRuleGroup as ContractsDedupeRuleGroup;
use NinjaForms\CiviCrmSdk\Contracts\DedupeRule as ContractsDedupeRule;
use NinjaForms\CiviCrmSdk\Contracts\Tag as ContractsTag;
use NinjaForms\CiviCrmSdk\Contracts\Participant as ContractsParticipant;
use NinjaForms\CiviCrmSdk\Contracts\Contact as ContractsContact;
use NinjaForms\CiviCrmSdk\Contracts\Email as ContractsEmail;
use NinjaForms\CiviCrmSdk\Contracts\Phone as ContractsPhone;
use NinjaForms\CiviCrmSdk\Contracts\Im as ContractsIm;
use NinjaForms\CiviCrmSdk\Contracts\Website as ContractsWebsite;
use NinjaForms\CiviCrmSdk\Contracts\Note as ContractsNote;
use NinjaForms\CiviCrmSdk\Contracts\Address as ContractsAddress;
use NinjaForms\CiviCrmSdk\Contracts\Group as ContractsGroup;
use NinjaForms\CiviCrmSdk\Contracts\GroupContact as ContractsGroupContact;
use NinjaForms\CiviCrmSdk\Contracts\TagEntity as ContractsTagEntity;
use NinjaForms\CiviCrmSdk\Contracts\LineItem as ContractsLineItem;
use NinjaForms\CiviCrmSdk\Contracts\Order as ContractsOrder;

use NinjaForms\CiviCrmSdk\Api\Activity;
use NinjaForms\CiviCrmSdk\Api\Event;
use NinjaForms\CiviCrmSdk\Api\Country;
use NinjaForms\CiviCrmSdk\Api\ContactType;
use NinjaForms\CiviCrmSdk\Api\OptionGroup;
use NinjaForms\CiviCrmSdk\Api\OptionValue;
use NinjaForms\CiviCrmSdk\Api\DedupeRuleGroup;
use NinjaForms\CiviCrmSdk\Api\DedupeRule;
use NinjaForms\CiviCrmSdk\Api\Tag;
use NinjaForms\CiviCrmSdk\Api\Participant;
use NinjaForms\CiviCrmSdk\Api\Contact;
use NinjaForms\CiviCrmSdk\Api\Email;
use NinjaForms\CiviCrmSdk\Api\Phone;
use NinjaForms\CiviCrmSdk\Api\Im;
use NinjaForms\CiviCrmSdk\Api\Website;
use NinjaForms\CiviCrmSdk\Api\Note;
use NinjaForms\CiviCrmSdk\Api\Address;
use NinjaForms\CiviCrmSdk\Api\Group;
use NinjaForms\CiviCrmSdk\Api\GroupContact;
use NinjaForms\CiviCrmSdk\Api\TagEntity;
use NinjaForms\CiviCrmSdk\Api\LineItem;
use NinjaForms\CiviCrmSdk\Api\Order;
use NinjaForms\CiviCrmSdk\CiviMocks\CiviMockObject;

/**
 * Provides entity objects for CiviCrm plugin requests
 *
 * If a bypass is not requested, provides the entity objects used to make
 * requests of CiviCrm plugin.  If bypassing is requested, such as when CiviCrm
 * plugin is not active, this factory provides a mock version that returns empty
 * data.
 */
class CiviObjectsFactory implements ContractsCiviObjectsFactory
{

    /**
     * Boolean to bypass CiviCrm, using mocks
     *
     * @var bool
     */
    protected $bypassCivi;

    /** @inheritDoc */
    public function activity(): ContractsActivity
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {

            return new Activity();
        }
    }

    /** @inheritDoc */
    public function event(): ContractsEvent
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new Event();
        }
    }
    
    /** @inheritDoc */
    public function note(): ContractsNote
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new Note();
        }
    }
  
    /** @inheritDoc */
    public function country(): ContractsCountry
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new Country();
        }
    }

    /** @inheritDoc */
    public function contactType(): ContractsContactType
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new ContactType();
        }
    }

    /** @inheritDoc */
    public function optionGroup(): ContractsOptionGroup
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new OptionGroup();
        }
    }

    /** @inheritDoc */
    public function dedupeRuleGroup(): ContractsDedupeRuleGroup
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new DedupeRuleGroup();
        }
    }

    /** @inheritDoc */
    public function optionValue(): ContractsOptionValue
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new OptionValue();
        }
    }

    /** @inheritDoc */
    public function dedupeRule(): ContractsDedupeRule
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new DedupeRule();
        }
    }


    /** @inheritDoc */
    public function tag(): ContractsTag
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new Tag();
        }
    }

    /** @inheritDoc */
    public function contact(): ContractsContact
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new Contact();
        }
    }

    /** @inheritDoc */
    public function email(): ContractsEmail
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new Email();
        }
    }

    /** @inheritDoc */
    public function phone(): ContractsPhone
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new Phone();
        }
    }

    /** @inheritDoc */
    public function iM(): ContractsIm
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new Im();
        }
    }

    /** @inheritDoc */
    public function website(): ContractsWebsite
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new Website();
        }
    }

    /** @inheritDoc */
    public function address(): ContractsAddress
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new Address();
        }
    }

    /** @inheritDoc */
    public function participant(): ContractsParticipant
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new Participant();
        }
    }

    /** @inheritDoc */
    public function group(): ContractsGroup
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new Group();
        }
    }

    /** @inheritDoc     */
    public function groupContact(): ContractsGroupContact
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new GroupContact();
        }
    }

    /** @inheritDoc     */
    public function tagEntity(): ContractsTagEntity
    {
        if ($this->bypassCivi) {

            return new CiviMockObject();
        } else {
            return new TagEntity();
        }
    }

    /** @inheritDoc  */
    public function lineItem(): ContractsLineItem
    {
        return new LineItem();
    }

    /** @inheritDoc  */
    public function order(): ContractsOrder
    {
        return new Order();
    }

    /**
     * Set boolean to bypass CiviCrm, using mocks
     *
     * @param  bool  $bypassCivi  Boolean to bypass CiviCrm, using mocks
     *
     * @return  ContractsCiviObjectsFactory
     */
    public function setBypassCivi(bool $bypassCivi): ContractsCiviObjectsFactory
    {
        $this->bypassCivi = $bypassCivi;

        return $this;
    }
}
