<?php

namespace NinjaForms\CiviCrmSdk\Api;

use NinjaForms\CiviCrmSdk\Contracts\CiviObjectCreateable;
use NinjaForms\CiviCrmSdk\Api\AbstractCiviObject;

use NinjaForms\CiviCrmSdk\Entities\CreateObjectResponse;


/**
 * Honors CiviObjectCreateable contract
 * 
 * Children implement method to provide response object
 */
abstract class AbstractCiviObjectCreateable extends AbstractCiviObject implements CiviObjectCreateable
{
    /** @var CreateObjectResponse */
    protected $response;

    /**
     * Construct with calls to protected methods defining required objects
     *
     * The CiviCrm and CreateObjectResponse objects are instantiated in protected
     * methods required by this parent class.
     */
    public function __construct()
    {
        parent::__construct();
    }


    /** @inheritDoc */
    public function create(array $values, ?array $parentIds = []): CreateObjectResponse
    {
        $object = $this->civiObject::create();

        $parentNameValuePairs = $this->constructParentNameValuePairs($parentIds);

        $values = \array_merge($values, $parentNameValuePairs);

        foreach ($values as $name => $value) {
            $object->addValue($name, $value);
        }

        try {
            // execute the request
            $result = $object
                ->setCheckPermissions(FALSE)
                ->execute();

            // get the single response
            $singleResult = $result->single();
            $singleResultEncoded = \json_encode($singleResult);

            $this->response = new CreateObjectResponse();

            $this->response
                ->setEntity($result->entity)
                ->setContext('createRecord')
                ->setResponseBody($singleResultEncoded);

            if (isset($singleResult['id'])) {
                $this->response
                    ->setId($singleResult['id'])
                    ->setIsSuccessful(true)
                    ->setRecordCount(1)
                    ->appendRecord(\json_encode($singleResult));
            } else {
                $this->response->setIsSuccessful(false);
            }
        } catch (\Exception $e) {
            $this->response = new CreateObjectResponse();
            $this->response
                ->setIsSuccessful(false)
                ->setIsException(true)
                ->appendErrorMessage($e->getMessage());
        }

        return $this->response;
    }

    /**
     * Construct name=>value pairs given parent ids keyed on entity name
     *
     * This method is a function hook that can be overridden by concrete
     * implementations.  By default, there are no links provided for
     * parent/child record linking.  A concrete implementation can override this
     * default behavior by providing such key-value pairs.
     *
     * An array of entity=>recordId pairs are passed in.  Should any of the
     * given keys be parents of this class's entity, this method should return
     * the fieldKey=>recordId that links this class's entity to that parent.
     *
     * @param array $parentIds Array of parent ids keyed on entity e.g.
     * 'Contact'=>'000'
     * @return array Name value pairs of parent ids for the object 
     */
    protected function constructParentNameValuePairs(array $parentIds): array
    {
        return [];
    }

    /**
     * Return the CreateObjectResponse
     * 
     * @return CreateObjectResponse
     */
    public function getResponse(): CreateObjectResponse
    {
        if (isset($this->response)) {
            return $this->response;
        } else {
            throw new \InvalidArgumentException('CreateObjectResponse does not exist');
        }
    }
}
