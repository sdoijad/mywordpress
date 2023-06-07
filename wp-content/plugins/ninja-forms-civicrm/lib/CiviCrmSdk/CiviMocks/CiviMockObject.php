<?php

namespace NinjaForms\CiviCrmSdk\CiviMocks;

use NinjaForms\CiviCrmSdk\Contracts\Activity as ContractsActivity;
use NinjaForms\CiviCrmSdk\Contracts\Address as ContractsAddress;
use NinjaForms\CiviCrmSdk\Contracts\Contact as ContractsContact;
use NinjaForms\CiviCrmSdk\Contracts\ContactType as ContractsContactType;
use NinjaForms\CiviCrmSdk\Contracts\OptionGroup as ContractsOptionGroup;
use NinjaForms\CiviCrmSdk\Contracts\OptionValue as ContractsOptionValue;
use NinjaForms\CiviCrmSdk\Contracts\DedupeRuleGroup as ContractsDedupeRuleGroup;
use NinjaForms\CiviCrmSdk\Contracts\DedupeRule as ContractsDedupeRule;
use NinjaForms\CiviCrmSdk\Contracts\Email as ContractsEmail;
use NinjaForms\CiviCrmSdk\Contracts\Phone as ContractsPhone;
use NinjaForms\CiviCrmSdk\Contracts\Im as ContractsIm;
use NinjaForms\CiviCrmSdk\Contracts\Website as ContractsWebsite;
use NinjaForms\CiviCrmSdk\Contracts\Note as ContractsNote;
use NinjaForms\CiviCrmSdk\Contracts\Event as ContractsEvent;
use NinjaForms\CiviCrmSdk\Contracts\Group as ContractsGroup;
use NinjaForms\CiviCrmSdk\Contracts\GroupContact as ContractsGroupContact;
use NinjaForms\CiviCrmSdk\Contracts\TagEntity as ContractsTagEntity;
use NinjaForms\CiviCrmSdk\Contracts\Country as ContractsCountry;
use NinjaForms\CiviCrmSdk\Contracts\Tag as ContractsTag;
use NinjaForms\CiviCrmSdk\Contracts\Participant as ContractsParticipant;
use NinjaForms\CiviCrmSdk\Entities\CreateObjectResponse;

/**
 * Generic Civi Entity object that can be used as stand-in
 *
 * If CiviCrm plugin is not installed, Ninja Form's form action would stall as
 * it relies on Civi's entity objects for setup.  By providing an option to use
 * a mock object, Ninja Form's form action can be set up to a certain extent
 * without Civi being installed.  
 * This class honors the contracts of all the implemented contracts specified by
 * returning empty values of all requests.
 * 
 * @see \NinjaForms\CiviCrmSdk\Factories\CiviObjectsFactory
 */
class CiviMockObject implements
    ContractsActivity,
    ContractsAddress,
    ContractsContact,
    ContractsContactType,
    ContractsOptionGroup,
    ContractsOptionValue,
    ContractsDedupeRuleGroup,
    ContractsDedupeRule,
    ContractsEmail,
    ContractsPhone,
    ContractsIm,
    ContractsWebsite,
    ContractsNote,
    ContractsEvent,
    ContractsParticipant,
    ContractsGroup,
    ContractsGroupContact,
    ContractsTagEntity,
    ContractsCountry,
    ContractsTag
{

    /** @inheritDoc */
    public function getFields(): array
    {
        $return = [];
        return $return;
    }

    /** @inheritDoc */
    public function create(array $values, ?array $parentIds = []): CreateObjectResponse
    {
        $response = new CreateObjectResponse();
        return $response;
    }

    /** @inheritDoc */
    public function getRecords(): array
    {
        $return = [];
        return $return;
    }

    /** @inheritDoc  */
    public function hasMatch(): bool
    {
        return false;
    }

    /** @inheritDoc  */
    public function getMatchingId(): int
    {
        return 0;
    }

    /** @inheritDoc  */
    public function getResponse(): CreateObjectResponse
    {
        return new CreateObjectResponse();
    }

    /** @inheritDoc */
    public function filterRecordsWhere(string $where, $value): array{
        return [];
    }
}
