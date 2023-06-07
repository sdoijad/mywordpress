<?php

namespace NinjaForms\CiviCrmShared\Handlers;

use NinjaForms\CiviCrmShared\Contracts\TemplateAutobuilder as ContractsTemplateAutobuilder;

/** @inheritDoc */
class TemplateAutobuilder implements ContractsTemplateAutobuilder
{

    /**
     * Script markup for Action Template
     *
     * @var string
     */
    protected $scriptMarkup = '';

    /**
     * Name of the Template
     *
     * @var string
     */
    protected $templateName;

    /**
     * Columns to build into template
     * 
     * Must match NF option repeater action settings array structure
     *
     * @var array
     */
    protected $columns;

    /** @inheritDoc */
    public function handle(string $templateName, array $columns): string
    {
        $this->scriptMarkup = '';
        
        $this->templateName = $templateName;

        $this->columns = $columns;

        $this->openScript();

        $this->appendColumnScripts();

        $this->closeScript();

        return $this->scriptMarkup;
    }

    /**
     * Open script tag with icon for handle
     *
     * @return void
     */
    protected function openScript(): void
    {
        $this->scriptMarkup = '<script id="' . $this->templateName . '" type="text/template">
        <div class="autobuild-template-handle">
            <span class="dashicons dashicons-menu handle"></span>
        </div>
        <div class ="autobuild-template-delete-icon">
            <span class="dashicons dashicons-dismiss nf-delete"></span>
        </div>';
    }

    /**
     * Add each column as a template, based on column type
     *
     * Single column version; each column is on its own row with a line break in
     * between.  
     *
     * @return void
     */
    protected function appendColumnScripts(): void
    {
        foreach ($this->columns as $dataKey => $column) {

            if (!isset($column['type'])) {
                $column['type'] = '';
            }

            if (isset($column['autobuild_label'])) {
                $label = $column['autobuild_label'];
            } else {

                $label = '';
            }
            
            switch ($column['type']) {
                case 'select':
                    $this->scriptMarkup .= '
                    <div class=" autobuild-template-select">
                        <label class="nf-select">' . $label . '
                            <select class="setting" value="{{{ data.' . $dataKey . '}}}" data-id="' . $dataKey . '" list="' . $dataKey . '"  placeholder="' . $label . '">
                            {{{ data.renderOptions( "' . $dataKey . '", data.' . $dataKey . ' )}}}
                            </select>
                        </label>
                        <span class="nf-option-error"></span>
                    </div>
                        <br style="clear:both;" />
                    ';
                    break;
                case 'hidden':
                    $this->scriptMarkup .= '
                    <div class="autobuild-template-textbox">
                        <label class="has-merge-tags">' .  '
                            <input hidden type="text" class="setting" value="{{{ data.' . $dataKey . ' }}}" data-id="' . $dataKey . '" placeholder="' . $label . '">
                        </label>
                        <span class="nf-option-error"></span>
                    </div>
                    <br style="clear:both;"/>
                    ';
                    break;
                case 'textbox':
                default:
                    $this->scriptMarkup .= '
                    <div class="autobuild-template-textbox">
                        <label class="has-merge-tags">' . $label . '
                            <input type="text" class="setting" value="{{{ data.' . $dataKey . ' }}}" data-id="' . $dataKey . '" placeholder="' . $label . '">
                            <span class="dashicons dashicons-list-view merge-tags"></span>
                        </label>
                        <span class="nf-option-error"></span>
                    </div>
                    <br style="clear:both;"/>
                    ';
            }
        }
    }

    /**
     * Close script with delete icon and closing script tag
     *
     * @return void
     */
    protected function closeScript(): void
    {
        $this->scriptMarkup .= '
            <hr class="autobuild-template-divider"/>
        </script>';
    }
}
