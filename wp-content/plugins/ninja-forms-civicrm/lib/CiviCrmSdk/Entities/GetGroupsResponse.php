<?php

namespace NinjaForms\CiviCrmSdk\Entities;

use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

/**
 * Entity describing a collection of 'Group' records
 */
class GetGroupsResponse extends GetRecordsResponse
{


    /** @var string */
    protected $name;

    /** @var string */
    protected $title;


    /** @var string */
    protected $description;


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
}
