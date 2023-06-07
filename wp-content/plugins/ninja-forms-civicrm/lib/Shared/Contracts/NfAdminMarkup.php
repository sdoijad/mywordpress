<?php

namespace NinjaForms\CiviCrmShared\Contracts;

/**
 * Provide standardized markup for settings output
 * 
 * Many integrating plugins share common data structures that can
 * be presented to the form designer for effective form setup.  This
 * class provides standard markup for display on the NF Settings
 * page. 
 * 
 * Ultimately this could be replaced with a template or migrated
 * to React JS, but this will help define the UX we need for
 * effective customer guidance towards the form design they wish.
 * 
 * @package Settings
 */
interface NfAdminMarkup
{

    /**
     * Provide Key => Value pairs markup
     *
     * Used when integration requires a programmatic key instead of
     * the human-readable form, this output highlights the key such that
     * the user can readily get the needed value; the value is
     * not highlighted because that is not the intended data, although
     * eyes will be naturally drawn to it as it is recognizable.
     *
     * @param array $idValues
     * @return string
     */
    public function keyValuePairs(?array $keyValues): string;

    /**
     * Output a table of multidimensional array
     *
     * Given indexed array of arrays, outputs a table, a row for each
     * indexed array, a cell for each element within that array
     *
     * @param array $array
     * @param integer|null $columnCount
     * @return string
     */
    public function tableColumns(array $array): string;

    /**
     * Markup button with id and button text
     *
     * @param string $buttonText
     * @return string
     */
    public function markupButton(string $buttonText, string $id): string;
}
