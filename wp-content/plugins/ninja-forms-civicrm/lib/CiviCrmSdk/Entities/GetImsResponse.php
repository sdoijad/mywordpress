<?php

namespace NinjaForms\CiviCrmSdk\Entities;

use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

class GetImsResponse extends GetRecordsResponse
{


    /** @var integer */
    protected $location_type_id;

    /** @var bool */
    protected $is_primary;

    /** @var bool */
    protected $is_billing;

    /** @var string */
    protected $name;


    public function getLocationTypeId( ): int
    {
        return $this->location_type_id;
    }

    public function getIsPrimary( ): bool
    {
        return $this->is_primary;
    }

    public function getIsBilling( ): bool
    {
        return $this->is_billing;
    }

    public function getName( ): string
    {
        return $this->name;
    }
    
}
