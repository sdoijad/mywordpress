<?php

namespace NinjaForms\CiviCrmSdk\Entities;

use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

/**
 * Extend Records response with needed ContactTypes properties
 */
class GetContactTypesResponse extends GetRecordsResponse
{


    /** @var string */
    protected $name;

    /** @var string */
    protected $label;
    
    /** @var string */
    protected $description;

    /** @var string */
    protected $image_URL;

    /** @var string */
    protected $parent_id;

    /** @var string */
    protected $is_active;

    /** @var string */
    protected $is_reserved;


    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of label
     */
    public function getLabel()
    {
        return $this->label;
    }
    

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the value of image_URL
     */ 
    public function getImage_URL()
    {
        return $this->image_URL;
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
}
