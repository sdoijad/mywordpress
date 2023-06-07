<?php

    namespace NinjaForms\CiviCrmShared\Abstracts;

    /**
     * Add SubmissionMetabox to output ExtraDataHandler data
     *
     * This class iterates through each each of the HandledResponses to output the
     * information into the submission metabox.
     * 
     * @see NinjaForms\CiviCrmShared\Handlers\ExtraDataHandler
     */
    abstract class SubmissionMetabox extends \NF_Abstracts_SubmissionMetabox
    {

        /**
         * Action Id
         *
         * This is the key under which the 'extra' data is stored.  Storage is
         * automatic when using the ExtraDataHandler class, and we know that the data
         * will be a multidimensional array that stores HandledResponses
         * @see NinjaForms\CiviCrmShared\Handlers\ExtraDataHandler
         * @var string
         */
        protected $actionKey = '';

        /**
         * Metabox Title
         *
         * @var string
         */
        protected $metaboxTitle;

        /**
         * HTML markup to output Response Data
         * @var string
         */
        protected $markup = '';

        /**
         * Collection of HandledResponses
         *
         * The ExtraDataHandler stores response data as a multi-dimensional array of
         * HandledResponses. Each instance of the given action key is an array
         * element and can be either indexed or keyed.  Within that key is an
         * indexed array of all the individual responses made for that single
         * instance of the action. 
         * @var array
         */
        protected $handledResponses = [];

        /**
         * Number of instances for the action
         *
         * There can be more than one action added to the form. Knowing this ahead
         * of time lets us output more user friendly headings.
         *
         * @var integer
         */
        protected $actionInstanceCount = 0;

        /**
         * User-friendly heading preceding each action instance's output
         *
         * A single instance of an action can have multiple requests; also, one form
         * can have multiple instances of an action on it.  This property is the
         * unmarked-up text heading for each instance of the action
         *
         * @var string
         */
        protected $actionInstanceHeading = '';

        public function __construct(string $actionKey, string $metaboxTitle)
        {
            parent::__construct();

            $this->actionKey = $actionKey;
            $this->metaboxTitle = $metaboxTitle;

            $this->_title = $this->metaboxTitle;
        }

        /**
         * Output the metabox as called by NF Core
         *
         * @param [type] $post
         * @param [type] $metabox
         * @return void
         */
        public function render_metabox($post, $metabox)
        {
            $this->handledResponses = $this->sub->get_extra_value($this->actionKey);
            
            
            if (!$this->handledResponses || !\is_array($this->handledResponses)) {
                
                $this->markup = '<strong>'
                . $this->addNoResponseDataMarkup()
                . '</strong>';
            } else {
                $this->actionInstanceCount = count($this->handledResponses);

                $this->markup = '';

                foreach ($this->handledResponses as $actionInstanceKey => $handledResponseCollection) {

                    $this->markup .= '<strong>'
                        . $this->outputActionHeading($actionInstanceKey)
                        . '</strong><br />';

                    foreach ($handledResponseCollection as $handledResponse) {
                        $this->markup .= $this->outputHandledResponse($handledResponse);
                    }
                }
            }

            echo $this->markup;
        }

        /**
         * Output the pertinent handled response data for a given response
         *
         * @param array $handledResponse
         * @return string
         */
        abstract protected function outputHandledResponse(array $handledResponse): string;

        /**
         * Output the response heading for a single instance's responses
         *
         * @param string $actionInstanceKey
         * @return string
         */
        abstract protected function outputActionHeading(string $actionInstanceKey): string;

        /**
         * Add markup for no response data available
         */
        abstract protected function addNoResponseDataMarkup(): string;
    }
