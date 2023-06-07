<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\Contact as ContractsContact;

use NinjaForms\CiviCrmSdk\Api\AbstractCiviObjectCreateable;

use \Civi\Api4\Contact as CiviContact;
use \Civi\Api4\UFMatch;
use NinjaForms\CiviCrmSdk\Entities\CreateObjectResponse;

/**
 * Honors NinjaForms' Contracts contact using CiviCRM's API v4
 */
class Contact extends AbstractCiviObjectCreateable implements ContractsContact
{
    /**
     * Does this contact have a match
     *
     * @var boolean
     */
    protected $matched = false;

    /**
     * Id of matching contact
     *
     * @var int
     */
    protected $matchingId;

    /** @inheritDoc */
    protected function getCiviObject()
    {
        return new CiviContact();
    }


    /** @inheritDoc */
    public function hasMatch(): bool
    {
        $this->peformUfMatch();

        return $this->matched;
    }

    /** @inheritDoc */
    public function getMatchingId(): int
    {
        if(isset($this->matchingId)){
            return $this->matchingId;
        }else{
            throw new \InvalidArgumentException('Contact does not have matching Id');
        }
    }

    /**
     * Perform UfMatch check to determine logged in user match
     *
     * @return void
     */
    protected function peformUfMatch(): void
    {
        $result = UFMatch::get()
            ->setLimit(25)
            ->execute();

        // get the single response
        $singleResult = $result->single();

        if (isset($singleResult['contact_id'])) {

            $this->matchingId = $singleResult['contact_id'];
            
            $this->matched = true;

            $this->response = new CreateObjectResponse();

            $this->response
                ->setId($this->matchingId)
                ->setEntity('Contact')
                ->setContext('UFMatch');
        }
    }
}
