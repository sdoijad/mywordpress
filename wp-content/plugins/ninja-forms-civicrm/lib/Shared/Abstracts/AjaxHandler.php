<?php

namespace NinjaForms\CiviCrmShared\Abstracts;

use NinjaForms\CiviCrmShared\Contracts\AjaxHandler as SharedContractsAjaxHandler;

/**
 * Defines an object to be registered by the AJAX Registrar
 * 
 * Children define the handle, scriptURL, version, and object name explicitly.
 * Then, when passed into the AjaxRegistrar, the two classes register 
 * the AJAX script and callbacks.  This abstract class handles shared functionality
 * such as extracting the POSTed data.  The child class provides initial values
 * sent to the script and also returns an associative array in response to the 
 * POSTed data.
 * 
 * @package Settings
 */
abstract class AjaxHandler implements SharedContractsAjaxHandler
{
    /**
     * AJAX script handle
     *
     * Match this value to the 'action' parameter when posting to
     * the ajaxurl in the JS script
     * 
     * @var string
     */
    protected $handle = '';

    /**
     * URL of script
     *
     * Use full path relative to root directory, typically starting
     * with 'assets/js/' and ending with JS filename.extension
     * @var string
     */
    protected $scriptUrl = '';

    /**
     * Script version
     *
     * Typically the plugin version number
     * @var string
     */
    protected $version = '';

    /**
     * Object name of the JS object
     *
     * Object name as passed into the scriptURL; localized properties
     * are accessed in JS by [objectName].[propertyName]
     * @var string
     */
    protected $objectName = '';

    /**
     * Key value pairs of data passed into JS object    
     *
     * Set as [propertyName]=>[value] such that in JS, the value is
     * accessed by [objectName].[propertyName] = [value]
     * @var array
     */
    protected $localizedArray;


    /**
     * Root Directory
     *
     * @var string
     */
    protected $rootDirectory;

    /**
     * Construct with rootDirectory
     *
     * @param string $rootDirectory
     */
    public function __construct(string $rootDirectory)
    {
        $this->rootDirectory = $rootDirectory;

        $this->setScriptUrl();

        $this->initializeLocalizedArray();
    }

    /**
     * Receive request and return response
     * 
     * @inheritDoc This abstract requires child methods to process the request and return a
     * keyed array of response values, which this parent structures and returns
     * to the JS script. 
     *
     * @return void
     */
    public function handle(): void
    {
        $returnParams = $this->processAjaxRequest();

        $this->end($returnParams);
    }

    /**
     * Process the AJAX request, returning keyed array
     * 
     * Call getPostData to get values POSTed by AJAX, then
     * process the request and return a response to the script
     * via key-value pairs
     *
     * @return array
     */
    abstract protected function processAjaxRequest(): array;

    /**
     * Initialize localizedArray with a keyed array
     * 
     * Sets up initializing properties in the script
     */
    abstract protected function initializeLocalizedArray(): void;


    /**
     * Set the script URL
     *
     * Script URL is defined by the child class and is given as a relative
     * directory and includes file extension; usually we store such JS files in
     * assets/js.  This protected method constructs the full URL on ->handle()
     * and is done by the parent class.
     *
     * (*ex: 'assets/js/nfpluginsettings.js'*)
     *
     */
    protected function setScriptUrl(): void
    {
        $this->scriptUrl = plugins_url($this->scriptUrl, $this->rootDirectory);
    }

    /**
     * End AJAX handler per WP's requirements
     *
     * Passing data back to the JS script ends with echoing a JSON string and
     * calling the die() function.  This is handled automatically by the parent
     * class, leaving the child to focus on constructing and return an
     * associative array of the returned values.
     *
     * @param array $returnParams
     * @return void
     */
    protected function end(array $returnParams): void
    {
        echo \json_encode($returnParams);

        die();
    }

    /**
     * Filter and return POST data for supplied keys
     *
     * An AJAX request is triggered by a POST call.  This class extracts the
     * requested data from that POST call.  A child class can put the following
     * code in its implementation of the processAjaxRequest() method to easily
     * extract the data it wants:
     * 
     * ```    
     * $keys = [
     *   'wpRestNonce',
     *   'context'
     * ];
     *
     * $postData = $this->getPostData($keys);
     *
     * \extract($postData);
     * ```
     *
     * 
     * The data will now be available as `$wpRestNonce` and `$context`
     * 
     * @param array $keys
     * @return array
     */
    protected function getPostData(array $keys): array
    {
        $options = array_map(function ($key) {
            return \INPUT_POST;
        }, array_flip($keys));

        $return = \filter_input_array(\INPUT_POST, $options);

        return $return;
    }

    /** @inheritDoc */
    public function getHandle(): string
    {
        return $this->handle;
    }

    /** @inheritDoc */
    public function getScriptUrl(): string
    {
        return $this->scriptUrl;
    }

    /** @inheritDoc */
    public function getVersion(): string
    {
        return $this->version;
    }

    /** @inheritDoc */
    public function getObjectName(): string
    {
        return $this->objectName;
    }

    /** @inheritDoc */
    public function getLocalizedArray(): array
    {
        return $this->localizedArray;
    }
}
