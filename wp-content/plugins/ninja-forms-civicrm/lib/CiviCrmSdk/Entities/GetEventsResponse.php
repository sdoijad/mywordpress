<?php

namespace NinjaForms\CiviCrmSdk\Entities;

use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

class GetEventsResponse extends GetRecordsResponse
{


    /** @var string */
    protected $title;

    /** @var string */
    protected $summary;

    /** @var string */
    protected $description;


    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the value of summary
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }
    
}
