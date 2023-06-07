<?php

namespace NinjaForms\CiviCrm\Handlers;

use NinjaForms\CiviCrmSdk\Entities\CreateObjectResponse;

use NinjaForms\CiviCrmShared\Abstracts\SubmissionMetabox as AbstractsSubmissionMetabox;
use NinjaForms\CiviCrmShared\Contracts\NfAdminMarkup;

/**
 * Add SubmissionMetabox to output ExtraDataHandler data
 *
 * This class iterates through each each of the HandledResponses to output the
 * information into the submission metabox.
 * 
 * @see NinjaForms\CiviCrmShared\Handlers\ExtraDataHandler
 */
class SubmissionMetabox extends AbstractsSubmissionMetabox
{
    /** @var NfAdminMarkup */
    protected $adminMarkup;

    /** @inheritDoc */
    public function __construct(string $actionKey, string $metaboxTitle, NfAdminMarkup $adminMarkup)
    {
        parent::__construct($actionKey, $metaboxTitle);

        $this->adminMarkup = $adminMarkup;
    }

    /**
     * Output the pertinent handled response data for a given response
     *
     * @param array $handledResponse
     * @return string
     */
    protected function outputHandledResponse(array $handledResponseArray): string
    {
        $objectResponse = CreateObjectResponse::fromArray($handledResponseArray);

        $return = '';

        if ($objectResponse->isSuccessful()) {

            $return = $this->successfulResponseOutput($objectResponse);
        } elseif ($objectResponse->isException()) {
            // $return 
        } else {
            // not quite sure what to handle
            $return  = $objectResponse['responseBody'] . '<br />';
        }


        return $return;
    }

    /**
     * Markup HTML for a successful submission response
     *
     * @param HandledResponse $objectResponse
     * @return string
     */
    protected function successfulResponseOutput(CreateObjectResponse $objectResponse): string
    {

        $array = [
            [
                __('Request made:  ', 'ninja-forms-civicrm'),
                $objectResponse->getContext() . ' -> ' . $objectResponse->getEntity()
            ],
            [
                __('Result', 'ninja-forms-civicrm'),
                'Successful'
            ],
            [
                __('Record Id', 'ninja-forms-civicrm'),
                $objectResponse->getId()
            ],
        ];

        $return = $this->adminMarkup->tableColumns($array);

        return $return;
    }


    /**
     * Output the action heading, with plural text option
     * @return  string 
     */
    protected function outputActionHeading(string $actionInstanceKey): string
    {
        if (1 < $this->actionInstanceCount) {

            $outputActionHeading = __('Responses for CiviCRM request named: ', 'ninja-forms-civicrm')
                . $actionInstanceKey;
        } else {

            $outputActionHeading =  __('Responses for this CiviCRM request', 'ninja-forms-civicrm');
        }

        return $outputActionHeading;
    }


    /** @inheritDoc */
    protected function addNoResponseDataMarkup(): string
    {
        $markup = __('No response data available for this submission', 'ninja-forms-civicrm');

        return $markup;
    }
}
