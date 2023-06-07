<?php

namespace NinjaForms\CiviCrmSdk\Entities;

use NinjaForms\CiviCrmShared\Abstracts\SimpleEntity;

/**
 * Define an entity for a getRecords response
 *
 * Each entity has field names specific to it, however they all have an id
 * field, which is defined here.  Specific entities extend this object with
 * properties and methods to get the fields.  
 */
class GetRecordsResponse extends SimpleEntity
{
    /**
     * Id of the retrieved object
     *
     * @var string
     */
    protected $id;



    /**
     * Get id of the retrieved object
     *
     * @return  string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Construct entity from array
     *
     * @param array $items
     * @return GetRecordsResponse
     */
    public static function fromArray(array $items):GetRecordsResponse
    {
        $obj = new static();
        foreach ($items as $property => $value) {
            $obj = $obj->__set($property, $value);
        }

        return $obj;
    }

    /**
     * Set defined properties
     * 
     * @return GetRecordsResponse
     */
    public function __set($name, $value)
    {
        $setter = 'set' . ucfirst($name);
        if (method_exists($this, $setter)) {
            return call_user_func([$this, $setter], $value);
        }
        if (property_exists($this, $name)) {
            $this->$name = $value;
            return $this;
        }

        return $this;
    }
}
