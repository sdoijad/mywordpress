<?php

namespace NinjaForms\CiviCrmSdk\Contracts;

use NinjaForms\CiviCrmSdk\Contracts\CiviObjectCreateable;

/**
 * Defines required methods for Contact
 */
interface Contact extends CiviObjectCreateable
{
    /**
     * Does contact have a match
     */
    public function hasMatch( ): bool;

    /**
     * Return the matching contact id
     */
    public function getMatchingId( ): int;

}
