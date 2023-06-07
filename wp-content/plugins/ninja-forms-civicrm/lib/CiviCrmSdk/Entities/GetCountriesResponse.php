<?php

namespace NinjaForms\CiviCrmSdk\Entities;

use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

/**
 * Extend Records response with needed Country properties
 */
class GetCountriesResponse extends GetRecordsResponse
{


    /** @var string */
    protected $name;

    /** @var string */
    protected $iso_code;

    /** @var string */
    protected $country_code;

    /** @var string */
    protected $address_format_id;
   
    /** @var string */
    protected $idd_prefix;
   
    /** @var string */
    protected $ndd_prefix;
   
    /** @var string */
    protected $region_id;

    /** @var string */
    protected $is_province_abbreviated;

    /** @var string */
    protected $is_active;

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of iso_code
     */ 
    public function getIso_code()
    {
        return $this->iso_code;
    }

    /**
     * Get the value of country_code
     */ 
    public function getCountry_code()
    {
        return $this->country_code;
    }

    /**
     * Get the value of address_format_id
     */ 
    public function getAddress_format_id()
    {
        return $this->address_format_id;
    }

    /**
     * Get the value of idd_prefix
     */ 
    public function getIdd_prefix()
    {
        return $this->idd_prefix;
    }

    /**
     * Get the value of ndd_prefix
     */ 
    public function getNdd_prefix()
    {
        return $this->ndd_prefix;
    }

    /**
     * Get the value of region_id
     */ 
    public function getRegion_id()
    {
        return $this->region_id;
    }

    /**
     * Get the value of is_province_abbreviated
     */ 
    public function getIs_province_abbreviated()
    {
        return $this->is_province_abbreviated;
    }

    /**
     * Get the value of is_active
     */ 
    public function getIs_active()
    {
        return $this->is_active;
    }
}
