<?php

namespace NinjaForms\CiviCrmShared\Handlers;

/**
 * Standardized methods for adding "extra" submission data
 *
 * Actions, during the submission process, have the opportunity to add
 * additional data ("extra") to the submitted data, which can not only be
 * stored, but also used by downstream actions. This class provides a
 * standardized method for storing and retrieving such data. 
 * 
 * @package FormProcessing
 */
class ExtraDataHandler
{


    /**
     * NF Process Data passed to action
     * @var array
     */
    protected $data;

    /**
     * Action Id
     * @var string
     */
    protected $actionKey = '';

    /**
     * Construct with incoming data and an action key
     *
     * The action key is the id of the action.  All extra data for a given
     * action is stored under this key.
     * @param array $data Data array provided at process time
     * @param string $actionKey Action Id
     */
    public function __construct($actionKey)
    {
        $this->actionKey = $actionKey;
    }

    /**
     * Append HandledResponse array to form process data
     *
     * Data is stored as a _collection_ of HandledResponse arrays because any
     * given action can make multiple requests.  In addition, because there can
     * be more than one of the same action on a form, the option is given to key
     * each instance of the action.  Thus the data can store multiple instances
     * of actions under individual keys, and store a collection of
     * HandledResponses under those.
     *
     * Data is structured as a HandledResponse array.  By having a common entity
     * structure, the end user of the stored data can convert the data into an
     * entity and rely on known methods and data types.
     *
     *
     * @param array $handledResponse Entity as an array
     * @see NinjaForms\CiviCrmShared\Entities\HandledResponse
     */
    public function appendHandledResponse(array $handledResponse, ?string $instanceKey = ''): ExtraDataHandler
    {
        if ('' === $instanceKey) {
            $instanceKey = 0;
        }

        // Instance key holds a collection of handled responses
        $this->data['extra'][$this->actionKey][$instanceKey][] = $handledResponse;

        return $this;
    }

    /**
     * Completely re-write of the action key's extra data
     *
     * This can be used to write the action data in one request, or to complete
     * remove the extra data for the action key
     *
     * @param array|null $override
     * @return ExtraDataHandler
     */
    public function overrideExtraData(?array $override = []): ExtraDataHandler
    {
        if (empty($override)) {
            
            unset($this->data['extra'][$this->actionKey]);
        } else {

            $this->data['extra'][$this->actionKey] = $override;
        }

        return $this;
    }

    /**
     * Set nF Process Data passed to action
     *
     * @param  array  $data  NF Process Data passed to action
     *
     * @return  self
     */
    public function setData(array $data): ExtraDataHandler
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Return complete NF process `$data` for passing back to form processing
     * 
     * @return array Complete form processing data
     */
    public function getData( ): array
    {
        return $this->data;
    }
}
