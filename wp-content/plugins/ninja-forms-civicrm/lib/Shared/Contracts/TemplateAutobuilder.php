<?php

namespace NinjaForms\CiviCrmShared\Contracts;

/**
 * Constructs script templates for action settings
 */
interface TemplateAutobuilder
{

   /**
    * Given template name and option repeater columns, constructs template script
    *
    * @param string $templateName
    * @param array $columns
    * @return string
    */
    public function handle(string $templateName, array $columns): string;
}
