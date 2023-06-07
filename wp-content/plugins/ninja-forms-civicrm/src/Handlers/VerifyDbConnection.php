<?php

namespace NinjaForms\CiviCrm\Handlers;

use NinjaForms\CiviCrmSdk\Contracts\Contact;

/**
 * Verifies DB connection by retrieving a contact field definition
 */
class VerifyDbConnection
{
    /** @var Contact */
    protected $contact;

    /**
     * Boolean - is plugin connected to DB?
     *
     * @var bool
     */
    protected $isConnected = false;

    /**
     * Retrieve single field definition proving connection
     *
     * @var array
     */
    protected $proof = [];

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Run verification process
     *
     * @return VerifyDbConnection
     */
    public function handle(): VerifyDbConnection
    {
        $results = $this->contact->getFields();

        $count = count($results);

        if (0 < $count) {

            $this->isConnected = true;

            $randomIndex = rand(0, $count - 1);

            $this->proof = $results[$randomIndex];
        }

        return $this;
    }
    /**
     * Return boolean - is connection verified?
     *
     * @return boolean
     */
    public function verified(): bool
    {
        return $this->isConnected;
    }

    /**
     * Get connection proof - key value pairs
     * 
     * Returns key-value pairs of a contact field definition
     *
     * @return  array
     */
    public function getProof()
    {
        return $this->proof;
    }

    public function getVerificationDescription(): string
    {
        $return = __('Successfully connected to DB. A random contact field description is provided as proof.', 'ninja-forms-civicrm');

        return $return;
    }
}
