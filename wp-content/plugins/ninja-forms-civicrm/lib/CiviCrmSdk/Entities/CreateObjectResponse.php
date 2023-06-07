<?php

namespace NinjaForms\CiviCrmSdk\Entities;

use NinjaForms\CiviCrmShared\Entities\HandledResponse;
class CreateObjectResponse extends HandledResponse
{
    /**
     * Id of the created object
     *
     * @var string
     */
    protected $id;

    /**
     * Entity of the created object
     *
     * @var string
     */
    protected $entity;

    /**
     * Get id of the created object
     *
     * @return  string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id of the created object
     *
     * @param  string  $id  Id of the created object
     *
     * @return  self
     */
    public function setId(?string $id): CreateObjectResponse
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get entity of the created object
     *
     * @return  string
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set entity of the created object
     *
     * @param  string  $entity  Entity of the created object
     *
     * @return  self
     */
    public function setEntity(?string $entity): CreateObjectResponse
    {
        $this->entity = $entity;

        return $this;
    }
}
