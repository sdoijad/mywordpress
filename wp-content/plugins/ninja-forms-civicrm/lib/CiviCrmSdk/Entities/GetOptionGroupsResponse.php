<?php

namespace NinjaForms\CiviCrmSdk\Entities;

use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

/**
 * Extend Records response with needed OptionGroups properties
 */
class GetOptionGroupsResponse extends GetRecordsResponse
{


    /** @var string */
    protected $name;

    /** @var string */
    protected $title;
    
    /** @var string */
    protected $description;

    /** @var string */
    protected $data_type;

    /** @var string */
    protected $parent_id;

    /** @var string */
    protected $is_active;

    /** @var string */
    protected $is_reserved;

    /** @var string */
    protected $is_locked;


    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }
    

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the value of data_type
     */ 
    public function getDataType()
    {
        return $this->data_type;
    }

    /**
     * Get the value of parent_id
     */ 
    public function getParent_id()
    {
        return $this->parent_id;
    }

    /**
     * Get the value of is_active
     */ 
    public function getIs_active()
    {
        return $this->is_active;
    }

    /**
     * Get the value of is_reserved
     */ 
    public function getIs_reserved()
    {
        return $this->is_reserved;
    }

    /**
     * Get the value of is_locked
     */ 
    public function getIs_locked()
    {
        return $this->is_locked;
    }
}
