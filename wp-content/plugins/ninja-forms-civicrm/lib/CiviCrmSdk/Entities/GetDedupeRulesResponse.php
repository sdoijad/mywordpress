<?php

namespace NinjaForms\CiviCrmSdk\Entities;

use NinjaForms\CiviCrmSdk\Entities\GetRecordsResponse;

/**
 * Extend Records response with needed DedupeRule properties
 */
class GetDedupeRulesResponse extends GetRecordsResponse
{


    /** @var string */
    protected $rule_table;

    /** @var int */
    protected $dedupe_rule_group_id;

    /** @var string */
    protected $rule_field;

    /** @var int */
    protected $rule_length;

    /** @var int */
    protected $rule_weight;

    /**
     * Get the value of rule_table
     */ 
    public function getRuleTable()
    {
        return $this->rule_table;
    }

    /**
     * Get the value of dedupe_rule_group_id
     */ 
    public function getDedupeRuleGroupId()
    {
        return $this->dedupe_rule_group_id;
    }

    /**
     * Get the value of rule_field
     */ 
    public function getRuleField()
    {
        return $this->rule_field;
    }

    /**
     * Get the value of rule_length
     */ 
    public function getRuleLength()
    {
        return $this->rule_length;
    }

    /**
     * Get the value of rule_weight
     */ 
    public function getRuleWeight()
    {
        return $this->rule_weight;
    }
}
