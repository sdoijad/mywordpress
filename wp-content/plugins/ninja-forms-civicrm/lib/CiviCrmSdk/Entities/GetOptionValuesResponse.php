<?php

namespace NinjaForms\CiviCrmSdk\Entities;

use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

/**
 * Extend Records response with needed OptionValues properties
 */
class GetOptionValuesResponse extends GetRecordsResponse
{


    /** @var string */
    protected $name;

    /** @var string */
    protected $label;
    
    /** @var string */
    protected $description;

    /** @var string */
    protected $value;

    /** @var string */
    protected $option_group_id;

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
     * Get the value of value
     */ 
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the value of option_group_id
     */ 
    public function getOption_group_id()
    {
        return $this->option_group_id;
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
