<?php

namespace NinjaForms\CiviCrmShared\Handlers;

use NinjaForms\CiviCrmShared\Contracts\AjaxHandler;

class AjaxRegistrar
{

    /**
     * AJAX script handle
     *
     * @var string
     */
    protected $handle;

    /**
     * URL of script
     *
     * @var string
     */
    protected $scriptUrl;

    /**
     * Script version
     *
     * @var string
     */
    protected $version;

    /**
     * Object name of the JS object
     *
     * @var string
     */
    protected $objectName;

    /**
     * AJAX handler
     *
     * @var AjaxHandler
     */
    protected $ajaxHandler;

    /**
     * Key value pairs of data passed into JS object    
     *
     * @var $params
     */
    protected $localizedArray;

    public function __construct(AjaxHandler $ajaxHandler)
    {
        $this->ajaxHandler = $ajaxHandler;

        $this->handle = $this->ajaxHandler->getHandle();

        $this->scriptUrl = $this->ajaxHandler->getScriptUrl();

        $this->version = $this->ajaxHandler->getVersion();

        $this->objectName = $this->ajaxHandler->getObjectName();

        $this->localizedArray = $this->ajaxHandler->getLocalizedArray();

        add_action('admin_init', [$this, 'initializeScripts']);

        add_action('wp_ajax_'.$this->handle, array($this->ajaxHandler, 'handle'));
    }

    /**
     * Load, enqueue, localize scripts
     */
    public function initializeScripts(): void
    {

        //Register asset 
        \wp_register_script(
            $this->handle,
            $this->scriptUrl,
            [],
            $this->version
        );


        \wp_localize_script(
            $this->handle,
            $this->objectName,
            $this->localizedArray
        );

        \wp_enqueue_script($this->handle);
    }
}
