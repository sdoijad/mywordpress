<?php

namespace NinjaForms\CiviCrm\Handlers;

use NinjaForms\CiviCrmShared\Contracts\DataModelProvider;
use NinjaForms\CiviCrmShared\Contracts\NfAdminMarkup;
use NinjaForms\CiviCrmShared\Contracts\LoggerInterface;

use NinjaForms\CiviCrm\Contracts\DataAccessEvent;
use NinjaForms\CiviCrm\Contracts\DataAccessTag;
use NinjaForms\CiviCrm\Contracts\DataAccessGroup;
use NinjaForms\CiviCrmShared\Abstracts\AjaxHandler;
use NinjaForms\CiviCrm\Handlers\VerifyDbConnection;
use Throwable;

/**
 * Provide AJAX functionality for the plugin settings
 * 
 * Functionality provided includes:
 * 1. Button click to toggle diagnostics view
 * 2. Button click to verify DB connectivity
 * 3. Button click to display available events
 * 4. Button click to display available groups
 * 5. Button click to display available tags
 * 6. Button click to display log
 * 
 */
class NfPluginSettingsAjax extends AjaxHandler
{
    /**
     * AJAX script handle
     *
     * @var string
     */
    protected $handle = 'nf_civicrm_nfpluginsettings';

    /**
     * URL of script
     *
     * @var string
     */
    protected $scriptUrl = 'assets/js/nfpluginsettings.js';

    /**
     * Script version
     *
     * @var string
     */
    protected $version = '3.0.1';

    /**
     * Object name of the JS object
     *
     * @var string
     */
    protected $objectName = 'params';

    /** @var VerifyDbConnection  */
    protected $verifyDbConnection;

    /** @var DataAccessEvent */
    protected $dataAccessEvent;

    /** @var DataAccessTag */
    protected $dataAccessTag;

    /** @var DataAccessGroup */
    protected $dataAccessGroup;

    /** @var DataModelProvider */
    protected $dataModelProvider;

    /** @var NfAdminMarkup */
    protected $nfSettingsMarkup;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * Handle AJAX calls on NF Plugin Settings page
     *
     * @param string $rootDirectory
     * @param VerifyDbConnection $verifyDbConnection
     * @param DataAccessEvent $dataAccessEvent
     * @param DataModelProvider $dataModelProvider
     * @param NfAdminMarkup $nfSettingsMarkup
     * @param LoggerInterface $logger
     */
    public function __construct(
        string $rootDirectory,
        VerifyDbConnection $verifyDbConnection,
        DataAccessEvent $dataAccessEvent,
        DataAccessTag $dataAccessTag,
        DataAccessGroup $dataAccessGroup,
        DataModelProvider $dataModelProvider,
        NfAdminMarkup $nfSettingsMarkup,
        LoggerInterface $logger
    ) {
        parent::__construct($rootDirectory);

        $this->verifyDbConnection = $verifyDbConnection;
        $this->dataAccessEvent = $dataAccessEvent;
        $this->dataAccessTag = $dataAccessTag;
        $this->dataAccessGroup = $dataAccessGroup;
        $this->dataModelProvider = $dataModelProvider;
        $this->nfSettingsMarkup = $nfSettingsMarkup;
        $this->logger = $logger;
    }

    /**
     * Initialize data sent to JS with a nonce and current `showDiagnostics`
     * preference
     *
     * Generate and pass a nonce tagged with this class's (string) handle. Also,
     * this retrieves the stored NF setting of a boolean value on whether to
     * display or hide the diagnostics.
     */
    protected function initializeLocalizedArray(): void
    {
        $this->localizedArray['wpRestNonce'] = \wp_create_nonce($this->handle);
        $this->localizedArray['showDiagnosticsOnStartup'] = \Ninja_Forms()->get_setting('nf_civicrm_show_diagnostics_on_startup', 0);
    }

    /**
     * Process the AJAX request, returning keyed array
     *
     * Expecting keyed values for wpRestNonce, context, and showDiagnostics.
     * After verifying nonce, this method uses the context to switch among the
     * allowed functionality; in this case, the options are to toggle the
     * diagnostics, verify the database connect, and retrieve events.
     * 
     */
    protected function processAjaxRequest(): array
    {
        $return = [];

        $keys = [
            'wpRestNonce',
            'context',
            'showDiagnostics'
        ];

        $postData = $this->getPostData($keys);

        \extract($postData);


        if (!wp_verify_nonce($wpRestNonce, $this->handle)) {
            $return['result'] = 'failed security';
        } else {
            $return['result'] = 'passed security';
        }

        switch ($context) {

            case 'toggleShowDiagnostics':
                \Ninja_Forms()->update_setting('nf_civicrm_show_diagnostics_on_startup', (string) $showDiagnostics);
                $return['result'] = 'success';
                $return['showDiagnostics'] = (string) $showDiagnostics;
                break;

            case 'verifyDbConnection':
                try {
                    $this->verifyDbConnection->handle();
                    if ($this->verifyDbConnection->verified()) {

                        $return['result'] = 'success';

                        $proof = $this->verifyDbConnection->getProof();
                        $return['proof'] = $this->nfSettingsMarkup->keyValuePairs($proof);

                        $return['verificationDescription'] = $this->verifyDbConnection->getVerificationDescription();
                    } else {
                        $return['result'] = 'failure';
                    }
                } catch (Throwable $e) {

                    $this->logger->warning($e->getMessage().' => NfPluginSettingsAjax.processAjaxRequest.verifyDbConnection');
                    $return['result'] = 'failure';
                }
                break;

            case 'retrieveEvents':
                try {

                    $events = $this->dataAccessEvent->getRecords();
                    if (!empty($events)) {
                        $markup = '';

                        $idValuePairs = $this->dataModelProvider
                            ->keyValuePairsFromCollection($events, 'id', 'title');

                        $markup = $this->nfSettingsMarkup->keyValuePairs($idValuePairs);

                        $return['markup'] = $markup;
                        $return['result'] = 'success';
                    } else {
                        $return['result'] = 'failure';
                    }
                } catch (Throwable $e) {
                    
                    $this->logger->warning($e->getMessage().' => NfPluginSettingsAjax.processAjaxRequest.retrieveEvents');
                    $return['result'] = 'failure';
                }
                break;

            case 'retrieveTags':
                try {

                    $tags = $this->dataAccessTag->getRecords();

                    if (!empty($tags)) {
                        $markup = '';

                        $idValuePairs = $this->dataModelProvider
                            ->keyValuePairsFromCollection($tags, 'id', 'name');

                        $markup = $this->nfSettingsMarkup->keyValuePairs($idValuePairs);

                        $return['markup'] = $markup;
                        $return['result'] = 'success';
                    } else {
                        $return['result'] = 'failure';
                    }
                } catch (Throwable $e) {
                    $this->logger->warning($e->getMessage().' => NfPluginSettingsAjax.processAjaxRequest.retrieveTags');
                    $return['result'] = 'failure';
                }
                break;

            case 'retrieveGroups':
                try {

                    $events = $this->dataAccessGroup->getRecords();
                    if (!empty($events)) {
                        $markup = '';

                        $idValuePairs = $this->dataModelProvider
                            ->keyValuePairsFromCollection($events, 'id', 'title');

                        $markup = $this->nfSettingsMarkup->keyValuePairs($idValuePairs);

                        $return['markup'] = $markup;
                        $return['result'] = 'success';
                    } else {
                        $return['result'] = 'failure';
                    }
                } catch (Throwable $e) {

                    $this->logger->warning($e->getMessage().' => NfPluginSettingsAjax.processAjaxRequest.retrieveGroups');
                    $return['result'] = 'failure';
                }
                break;

            case 'clearLog':
                $this->logger->clearLog();
                // Note that this case continues into viewLog without a `break`
            case 'viewLog':
                try {
                    $log = $this->logger->getLogCollection();
         
                    if(empty($log)){
                        $log = [
                           'timestamp'=> __('hooray','ninja-forms-civicrm'),
                           'message'=>__('No logged issues to address','ninja-forms-civicrm')
                        ];
                    }    
                    
                    $markup = $this->markupLog($log);

                    $return['markup'] = $markup;
                    $return['result'] = 'success';
                } catch (Throwable $e) {
                    $return['result'] = 'failure';
                }

                break;
        }
        return $return;
    }

    /**
     * Markup log for settings page output
     *
     * Because timestamp values are not unique, it cannot be used as a key for
     * the key->value standardized markup.  This method provides similar markup
     * and may get standardized into the Shared folder if it becomes use in
     * multiple locations.
     * 
     * @param array $log
     * @return string
     */
    protected function markupLog(array $log): string
    {
        $markup = '';

        foreach($log as $entry){
            if(isset($entry['timestamp']) && isset($entry['message'])){
                $markup.=  '<strong>' . $entry['timestamp'] . '</strong>'
                . ' => '
                . $entry['message']
                . '<br />';
            }
        }

        return $markup;
    }
}
