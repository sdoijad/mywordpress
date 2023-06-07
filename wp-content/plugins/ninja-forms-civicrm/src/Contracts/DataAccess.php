<?php

namespace NinjaForms\CiviCrm\Contracts;

interface DataAccess
{


    /**
     * Get Id Label pairs for the entity
     *
     * Id-label pairs can be  id=>label associative array by default, 
     * or as an indexed array
     * [                    
     *  'value'=>$id,
     *  'label'=>$label
     * ],
     * 
     * The indexed array is the construct used when create NF select options
     * 
     * @return array
     */
    public function getFieldDefinitionIdLabelPairs(?bool $associative = true): array;
}
