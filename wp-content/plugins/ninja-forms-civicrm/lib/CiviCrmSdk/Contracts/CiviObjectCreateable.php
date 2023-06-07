<?php

namespace NinjaForms\CiviCrmSdk\Contracts;
use NinjaForms\CiviCrmSdk\Contracts\CiviObject;
use NinjaForms\CiviCrmSdk\Entities\CreateObjectResponse;
/**
 * Required methods for Createable CiviObjects
 *
 * Createable CiviObjects are those for which the SDK enables the creation of
 * new records of the given CiviObject.
 */
interface CiviObjectCreateable extends CiviObject
{

    /**
     * Create a new record of the object
     * 
     * @param array $values Civi field 'name' => form value pairs
     * @param array $parentIds Array keyed on entity=> (string) id
     * @return CreateObjectResponse CreateObjectResponse
     */
    public function create(array $values, ?array $parentIds=[]):CreateObjectResponse;

    /**
     * Return the CreateObjectResponse
     * 
     * @return CreateObjectResponse
     */
    public function getResponse( ): CreateObjectResponse;
}
