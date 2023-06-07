<?php

namespace NinjaForms\CiviCrmShared\Handlers;

use NinjaForms\CiviCrmShared\Contracts\TemplateAutobuilder;
use NinjaForms\CiviCrmShared\Handlers\FormAction;

/**
 * Registers a form action, given a FormAction class
 * 
 * Also calls standard builder templates
 */
class ActionRegistrar
{

    /**
     * Root directory
     *
     * @var string
     */
    protected $rootDirectory = '';

    /**
     * Template Autobuilder
     *
     * @var TemplateAutobuilder
     */
    protected $templateAutobuilder;

    /**
     * Collection of template names
     *
     * Indexed array in which each element is the string name of a template.
     * This class registers a method with NF core's template action hook to
     * iterate through each template name.  It will first look in a shared
     * location for the template, then in the master class's root template
     * directory to load the template.
     * 
     * @var string[]
     */
    protected $templateCollection = [];

    /**
     * Collection of templates to be autobuilt
     *
     * Some templates, option-repeaters for example, may choose to be
     * automatically built based on their repeater columns.  This indexed array
     * of action setting keys indicates which settings to be autobuilt.
     * 
     * @var array
     */
    protected $autoBuildTemplateCollection = [];

    /**
     * Filename including extension of formbuilder CSS relative to root
     *
     * @var string
     */
    protected $cssFilename = '';

    /**
     * Registers a new plugin action
     *
     * @return void
     */
    public function handle(FormAction $formAction): void
    {
        add_filter('ninja_forms_register_actions', function ($incomingActions) use ($formAction) {
            $outgoingActions = $incomingActions;
            $outgoingActions[$formAction->get_name()] = $formAction;

            return $outgoingActions;
        });

        $actionConfiguration = $formAction->actionConfiguration;

        foreach ($actionConfiguration['actionSettings'] as $actionSetting) {

            if (!isset($actionSetting['tmpl_row']) || '' === $actionSetting['tmpl_row']) {
                continue;
            }

            // Add to autobuild collection, keyed on template name
            if (isset($actionSetting['autobuild']) && $actionSetting['autobuild']) {

                $this->autoBuildTemplateCollection[$actionSetting['tmpl_row']] = $actionSetting['columns'];

                continue;
            }

            $this->templateCollection[] = $actionSetting['tmpl_row'];
        }

        add_action('ninja_forms_builder_templates', [$this, 'builderTemplates']);

        $this->cssFilename = $formAction->getActionCssFilename();

        if ('' !== $this->cssFilename) {
            add_action('admin_init', [$this, 'registerCss']);
        }
    }

    /**
     * Register CSS for form builder if on form builder page
     *
     * Caller verifies that cssFilename is set before calling because this
     * method is hooked into admin_init and there is no need to hook if no CSS
     * is specified for loading.  Check for admin page is done here because
     * admin_init ensures that page URl is established.
     *
     * @return void
     */
    public function registerCss(): void
    {
        $page = \filter_input(\INPUT_GET, 'page');
        $formId = \filter_input(\INPUT_GET, 'form_id');

        if ('ninja-forms' === $page && !is_null($formId)) {
            $cssUrl = plugin_dir_url($this->rootDirectory) . $this->cssFilename;

            $handle  = \str_replace('.css','',basename($cssUrl));

            \wp_enqueue_style(
                $handle,
                $cssUrl
            );
        }
    }


    /**
     * Loads a template for admin display
     *
     * @return void
     */
    public function builderTemplates()
    {

        foreach ($this->templateCollection as $template) {

            $sharedFilename = \dirname(__DIR__, 1) . '/Templates/' . $template . '.html';

            $pluginSpecificTemplateFilename = $this->rootDirectory . '/Templates/' . $template . '.html';

            if (\file_exists($sharedFilename)) {

                include_once($sharedFilename);
            } elseif (\file_exists($pluginSpecificTemplateFilename)) {

                include_once($pluginSpecificTemplateFilename);
            }
        }

        foreach ($this->autoBuildTemplateCollection as $templateName => $autobuildTemplateColumns) {

            $script = $this->templateAutobuilder->handle($templateName, $autobuildTemplateColumns);

            echo $script;
        }
    }

    /**
     * Set root directory
     *
     * @param string $rootDirectory
     * @return ActionRegistrar
     */
    public function setRootDirectory(string $rootDirectory): ActionRegistrar
    {
        $this->rootDirectory = $rootDirectory;

        return $this;
    }

    /**
     * Set template Autobuilder
     *
     * @param  TemplateAutobuilder  $templateAutobuilder
     *
     * @return  ActionRegistrar
     */
    public function setTemplateAutobuilder(TemplateAutobuilder $templateAutobuilder): ActionRegistrar
    {
        $this->templateAutobuilder = $templateAutobuilder;

        return $this;
    }
}
