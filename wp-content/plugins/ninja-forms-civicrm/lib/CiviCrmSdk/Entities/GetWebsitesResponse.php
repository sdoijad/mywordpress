<?php

namespace NinjaForms\CiviCrmSdk\Entities;

use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

class GetWebsitesResponse extends GetRecordsResponse
{


    /** @var integer */
    protected $website_type_id;

    /** @var bool */
    protected $is_primary;

    /** @var bool */
    protected $is_billing;

    /** @var string */
    protected $url;


    public function getWebsiteTypeId( ): int
    {
        return $this->website_type_id;
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
        return $this->url;
    }
    
}
