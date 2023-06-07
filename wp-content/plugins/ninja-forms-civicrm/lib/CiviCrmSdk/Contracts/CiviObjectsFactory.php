<?php

namespace NinjaForms\CiviCrmSdk\Contracts;

use NinjaForms\CiviCrmSdk\Contracts\Contact as ContractsContact;
use NinjaForms\CiviCrmSdk\Contracts\ContactType as ContractsContactType;
use NinjaForms\CiviCrmSdk\Contracts\OptionGroup as ContractsOptionGroup;
use NinjaForms\CiviCrmSdk\Contracts\OptionValue as ContractsOptionValue;
use NinjaForms\CiviCrmSdk\Contracts\DedupeRuleGroup as ContractsDedupeRuleGroup;
use NinjaForms\CiviCrmSdk\Contracts\DedupeRule as ContractsDedupeRule;
use NinjaForms\CiviCrmSdk\Contracts\Activity as ContractsActivity;
use NinjaForms\CiviCrmSdk\Contracts\Event as ContractsEvent;
use NinjaForms\CiviCrmSdk\Contracts\Country as ContractsCountry;
use NinjaForms\CiviCrmSdk\Contracts\Tag as ContractsTag;
use NinjaForms\CiviCrmSdk\Contracts\Participant as ContractsParticipant;
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

/**
 * Provides entity objects for CiviCrm plugin requests
 *
 * CiviCrm object contracts decouple NF CiviCrm plugin from CiviCrm plugin by
 * enabling dependent requests to be made to a contract instead of a specific
 * CiviCrm plugin's object.  Implementors of this factory have the opportunity
 * to provide substitute versions of those entity objects when needed for
 * bypassing or mocking CiviCrm plugin's classes.
 */
interface CiviObjectsFactory
{

    /**
     * Make Contract\Contact object
     *
     * @return ContractsContact
     */
    public function contact(): ContractsContact;

    /**
     * Make Contract\ContactType object
     *
     * @return ContractsContactType
     */
    public function contactType(): ContractsContactType;

    /**
     * Make Contract\OptionGroup object
     *
     * @return ContractsOptionGroup
     */
    public function optionGroup(): ContractsOptionGroup;

    /**
     * Make Contract\DedupeRuleGroup object
     *
     * @return ContractsDedupeRuleGroup
     */
    public function dedupeRuleGroup(): ContractsDedupeRuleGroup;

    /**
     * Make Contract\OptionValue object
     *
     * @return ContractsOptionValue
     */
    public function optionValue(): ContractsOptionValue;

    /**
     * Make Contract\DedupeRule object
     *
     * @return ContractsDedupeRule
     */
    public function dedupeRule(): ContractsDedupeRule;

    /**
     * Make Contracts\Activity object
     *
     * @return ContractsActivity
     */
    public function activity(): ContractsActivity;

    /**
     * Make Contracts\Event object
     *
     * @return ContractsEvent
     */
    public function event(): ContractsEvent;

    /**
     * Make Contracts\Note object
     *
     * @return ContractsNote
     */
    public function note(): ContractsNote;

    /**
     * Make Contracts\Country object
     *
     * @return ContractsCountry
     */
    public function country(): ContractsCountry;

    /**
     * Make Contracts\Tag object
     *
     * @return ContractsTag
     */
    public function tag(): ContractsTag;

    /**
     * Make Contracts\Participant object
     *
     * @return ContractsParticipant
     */
    public function participant(): ContractsParticipant;

    /**
     * Make Contracts\Email object
     *
     * @return ContractsEmail
     */
    public function email(): ContractsEmail;

    /**
     * Make Contracts\Phone object
     *
     * @return ContractsPhone
     */
    public function phone(): ContractsPhone;

    /**
     * Make Contracts\Im object
     *
     * @return ContractsIm
     */
    public function iM(): ContractsIm;

    /**
     * Make Contracts\Website object
     *
     * @return ContractsWebsite
     */
    public function website(): ContractsWebsite;

    /**
     * Make Contracts\Address object
     *
     * @return ContractsAddress
     */
    public function address(): ContractsAddress;

    /**
     * Make Contracts\Group object
     *
     * @return ContractsGroup
     */
    public function group(): ContractsGroup;

    /**
     * Make Contract\GroupContact object
     *
     * @return ContractsGroupContact
     */
    public function groupContact(): ContractsGroupContact;

    /**
     * Make Contract\TagEntity object
     *
     * @return ContractsTagEntity
     */
    public function tagEntity(): ContractsTagEntity;

    /**
     * Make Contract\LineItem object
     * 
     * @return ContractsLineItem
     */
    public function lineItem( ): ContractsLineItem;

    /**
     * Make Contract\Order object
     * 
     * @return ContractsOrder
     */
    public function order( ): ContractsOrder;

    /**
     * Set boolean to bypass CiviCrm, using mocks
     *
     * @param  bool  $bypassCivi  Boolean to bypass CiviCrm, using mocks
     * @return  CiviObjectsFactory
     */
    public function setBypassCivi(bool $bypassCivi): CiviObjectsFactory;
}
