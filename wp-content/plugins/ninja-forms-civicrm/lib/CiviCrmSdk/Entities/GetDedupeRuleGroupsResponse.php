<?php

namespace NinjaForms\CiviCrmSdk\Entities;

use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

/**
 * Extend Records response with needed DedupeRuleGroups properties
 */
class GetDedupeRuleGroupsResponse extends GetRecordsResponse
{


    /** @var string */
    protected $contact_type;

    /** @var int */
    protected $threshold;

    /** @var string */
    protected $used;

    /** @var string */
    protected $name;

    /** @var string */
    protected $title;
    


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
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }
    

    /**
     * Get the value of contact type
     */ 
    public function getContactType()
    {
        return $this->contact_type;
    }

    /**
     * Get the value of threshold
     */ 
    public function getThreshold()
    {
        return $this->threshold;
    }

    /**
     * Get the value of used
     */ 
    public function getUsed()
    {
        return $this->used;
    }

    /**
     * Get the value of is_reserved
     */ 
    public function getIs_reserved()
    {
        return $this->is_reserved;
    }


}
