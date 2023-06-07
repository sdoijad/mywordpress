<?php

namespace NinjaForms\CiviCrm\Factories;

use NinjaForms\CiviCrm\Contracts\DataAccessFactory as ContractsDataAccessFactory;
use NinjaForms\CiviCrmSdk\Contracts\CiviObjectsFactory;
use NinjaForms\CiviCrm\Contracts\DataAccessContact as ContractsDataAccessContact;
use NinjaForms\CiviCrm\Contracts\DataAccessActivity as ContractsDataAccessActivity;
use NinjaForms\CiviCrm\Contracts\DataAccessEvent as ContractsDataAccessEvent;
use NinjaForms\CiviCrm\Contracts\DataAccessTag as ContractsDataAccessTag;
use NinjaForms\CiviCrm\Contracts\DataAccessParticipant as ContractsDataAccessParticipant;
use NinjaForms\CiviCrm\Contracts\DataAccessEmail as ContractsDataAccessEmail;
use NinjaForms\CiviCrm\Contracts\DataAccessPhone as ContractsDataAccessPhone;
use NinjaForms\CiviCrm\Contracts\DataAccessIm as ContractsDataAccessIm;
use NinjaForms\CiviCrm\Contracts\DataAccessWebsite as ContractsDataAccessWebsite;
use NinjaForms\CiviCrm\Contracts\DataAccessNote as ContractsDataAccessNote;
use NinjaForms\CiviCrm\Contracts\DataAccessAddress as ContractsDataAccessAddress;
use NinjaForms\CiviCrm\Contracts\DataAccessGroup as ContractsDataAccessGroup;
use NinjaForms\CiviCrm\Contracts\DataAccessGroupContact as ContractsDataAccessGroupContact;

use NinjaForms\CiviCrmSdk\Entities\CiviFieldDefinition;

use NinjaForms\CiviCrm\DataAccess\Activity;
use NinjaForms\CiviCrm\DataAccess\Event;
use NinjaForms\CiviCrm\DataAccess\Tag;
use NinjaForms\CiviCrm\DataAccess\Participant;
use NinjaForms\CiviCrm\DataAccess\Contact;
use NinjaForms\CiviCrm\DataAccess\Email;
use NinjaForms\CiviCrm\DataAccess\Phone;
use NinjaForms\CiviCrm\DataAccess\Im;
use NinjaForms\CiviCrm\DataAccess\Website;
use NinjaForms\CiviCrm\DataAccess\Note;
use NinjaForms\CiviCrm\DataAccess\Address;
use NinjaForms\CiviCrm\DataAccess\Group;
use NinjaForms\CiviCrm\DataAccess\GroupContact;

/**
 * Provide DataAccess objects per Contract
 */
class DataAccessFactory implements ContractsDataAccessFactory
{
    /** @var CiviObjectsFactory */
    protected $civiObjectsFactory;

    public function __construct(CiviObjectsFactory $civiObjectsFactory)
    {
        $this->civiObjectsFactory = $civiObjectsFactory;
    }

    /** @inheritDoc */
    public function contact(): ContractsDataAccessContact
    {
        $object = $this->civiObjectsFactory->contact();

        $fieldDefinition = new CiviFieldDefinition();

        $return = new Contact($object, $fieldDefinition);

        return $return;
    }

    /** @inheritDoc */
    public function activity(): ContractsDataAccessActivity
    {

        $object = $this->civiObjectsFactory->activity();

        $fieldDefinition = new CiviFieldDefinition();

        $return = new Activity($object, $fieldDefinition);

        return $return;
    }

    /** @inheritDoc */
    public function event(): ContractsDataAccessEvent
    {

        $object = $this->civiObjectsFactory->event();

        $fieldDefinition = new CiviFieldDefinition();

        $return = new Event($object, $fieldDefinition);

        return $return;
    }

    /** @inheritDoc */
    public function tag(): ContractsDataAccessTag
    {
        $object = $this->civiObjectsFactory->tag();

        $fieldDefinition = new CiviFieldDefinition();

        $return = new Tag($object, $fieldDefinition);

        return $return;
    }

    /** @inheritDoc */
    public function participant(): ContractsDataAccessParticipant
    {

        $object = $this->civiObjectsFactory->participant();

        $fieldDefinition = new CiviFieldDefinition();

        $return = new Participant($object, $fieldDefinition);

        return $return;
    }

    /** @inheritDoc */
    public function email(): ContractsDataAccessEmail
    {

        $object = $this->civiObjectsFactory->email();

        $fieldDefinition = new CiviFieldDefinition();

        $return = new Email($object, $fieldDefinition);

        return $return;
    }

    /** @inheritDoc */
    public function phone(): ContractsDataAccessPhone
    {

        $object = $this->civiObjectsFactory->phone();

        $fieldDefinition = new CiviFieldDefinition();

        $return = new Phone($object, $fieldDefinition);

        return $return;
    }

    /** @inheritDoc */
    public function iM(): ContractsDataAccessIm
    {

        $object = $this->civiObjectsFactory->iM();

        $fieldDefinition = new CiviFieldDefinition();

        $return = new Im($object, $fieldDefinition);

        return $return;
    }

    /** @inheritDoc */
    public function website(): ContractsDataAccessWebsite
    {

        $object = $this->civiObjectsFactory->website();

        $fieldDefinition = new CiviFieldDefinition();

        $return = new Website($object, $fieldDefinition);

        return $return;
    }

    /** @inheritDoc */
    public function note(): ContractsDataAccessNote
    {

        $object = $this->civiObjectsFactory->note();

        $fieldDefinition = new CiviFieldDefinition();

        $return = new Note($object, $fieldDefinition);

        return $return;
    }

    /** @inheritDoc */
    public function address(): ContractsDataAccessAddress
    {

        $object = $this->civiObjectsFactory->address();

        $fieldDefinition = new CiviFieldDefinition();

        $return = new Address($object, $fieldDefinition);

        return $return;
    }

    /** @inheritDoc */
    public function group(): ContractsDataAccessGroup
    {

        $object = $this->civiObjectsFactory->group();

        $fieldDefinition = new CiviFieldDefinition();

        $return = new Group($object, $fieldDefinition);

        return $return;
    }

    /** @inheritDoc */
    public function groupContact(): ContractsDataAccessGroupContact
    {
        $object = $this->civiObjectsFactory->groupContact();

        $fieldDefinition = new CiviFieldDefinition();

        $return = new GroupContact($object, $fieldDefinition);

        return $return;
    }
}
