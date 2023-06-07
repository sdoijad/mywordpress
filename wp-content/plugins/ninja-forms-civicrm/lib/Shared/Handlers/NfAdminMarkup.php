<?php

namespace NinjaForms\CiviCrmShared\Handlers;

use NinjaForms\CiviCrmShared\Contracts\NfAdminMarkup as ContractsNfAdminMarkup;

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
 */
class NfAdminMarkup implements ContractsNfAdminMarkup
{
    /** @inheritDoc */
    public function keyValuePairs(?array $keyValues): string
    {
        $return = '';
        if (!\is_null($keyValues)) {
            foreach ($keyValues as $key => $value) {
                if ((!\is_string($key) && !\is_int($key)) || !\is_string($value)) {
                    continue;
                }

                $return .=
                    '<strong>' . $this->spanMarkup($key) . '</strong>'
                    . ' => '
                    . $this->spanMarkup($value)
                    . '<br />';
            }
        }

        return $return;
    }

    /** @inheritDoc */
    public function tableColumns(?array $array = []): string
    {

        $return = '';

        if (\is_array($array)) {

            $return .= '<table>';

            foreach ($array as  $arrayRow) {
                $rowMarkup = '<tr>';

                foreach ($arrayRow as  $arrayRowCell) {
                    $rowMarkup .= '<td>' . \esc_html($arrayRowCell) . '</td>';
                }

                $rowMarkup .= '</tr>';

                $return .= $rowMarkup;
            }

            $return .= '</table>';
        }

        return $return;
    }

    /** @inheritDoc */
    public function markupButton(string $buttonText, string $id): string
    {
        $markup = '<span id="' . $id . '" class="button">' . $buttonText . '</span>';

        return $markup;
    }


    /**
     * Wraps provided content with span tags, optional class and id
     *
     * @param string $data
     * @param string|null $elementId
     * @param string|null $class
     * @return string
     */
    protected function spanMarkup(string $data, ?string $elementId = '', ?string $class = ''): string
    {
        $return = '<span '
            . $this->idMarkup($elementId)
            . $this->classMarkup($class)
            . '>'
            . \esc_html($data)
            . '</span>';

        return $return;
    }

    /**
     * Markup id, when id is optional
     *
     * @param string|null $id
     * @return string
     */
    protected function idMarkup(?string $elementId = ''): string
    {
        $return = '';
        if ('' !== $elementId) {
            $return .= 'id="' . \esc_attr($elementId) . '"';
        }

        return $return;
    }
    /**
     * Markup class, when class is optional
     *
     * @param string|null $class
     * @return string
     */
    protected function classMarkup(?string $class = ''): string
    {
        $return = '';
        if ('' !== $class) {
            $return .= 'class="' . \esc_attr($class) . '"';
        }

        return $return;
    }
}
