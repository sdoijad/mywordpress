<?php

namespace NinjaForms\CiviCrm\Contracts;

use NinjaForms\CiviCrm\Contracts\DataAccessContact;
use NinjaForms\CiviCrm\Contracts\DataAccessActivity;
use NinjaForms\CiviCrm\Contracts\DataAccessEvent;
use NinjaForms\CiviCrm\Contracts\DataAccessTag;
use NinjaForms\CiviCrm\Contracts\DataAccessEmail;
use NinjaForms\CiviCrm\Contracts\DataAccessPhone;
use NinjaForms\CiviCrm\Contracts\DataAccessIm;
use NinjaForms\CiviCrm\Contracts\DataAccessNote;
use NinjaForms\CiviCrm\Contracts\DataAccessParticipant;
use NinjaForms\CiviCrm\Contracts\DataAccessAddress;
use NinjaForms\CiviCrm\Contracts\DataAccessGroup;
use NinjaForms\CiviCrm\Contracts\DataAccessGroupContact;

/**
 * Contract for providing DataAccess objects
 */
interface DataAccessFactory
{

    /**
     * Provide Contact Data Access object
     *
     * @return DataAccessContact
     */
    public function contact(): DataAccessContact;

    /**
     * Provide Activity Data Access object
     *
     * @return DataAccessActivity
     */
    public function activity(): DataAccessActivity;

    /**
     * Provide Event Data Access object
     *
     * @return DataAccessEvent
     */
    public function event(): DataAccessEvent;

    /**
     * Provide Note Data Access object
     *
     * @return DataAccessNote
     */
    public function note(): DataAccessNote;

    /**
     * Provide Tag Data Access object
     *
     * @return DataAccessTag
     */
    public function tag(): DataAccessTag;

    /**
     * Provide Email Data Access object
     *
     * @return DataAccessEmail
     */
    public function email(): DataAccessEmail;

    /**
     * Provide Phone Data Access object
     *
     * @return DataAccessPhone
     */
    public function phone(): DataAccessPhone;

    /**
     * Provide Im Data Access object
     *
     * @return DataAccessIm
     */
    public function iM(): DataAccessIm;

    /**
     * Provide Participant Data Access object
     *
     * @return DataAccessParticipant
     */
    public function participant(): DataAccessParticipant;

    /**
     * Provide Address Data Access object
     *
     * @return DataAccessAddress
     */
    public function address(): DataAccessAddress;

    /**
     * Provide Group Data Access object
     *
     * @return DataAccessGroup
     */
    public function group(): DataAccessGroup;

    /**
     * Provide GroupContact Data Access object
     *
     * @return DataAccessGroupContact
     */
    public function groupContact(): DataAccessGroupContact;
}
