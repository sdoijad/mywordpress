<?php

namespace NinjaForms\CiviCrmShared\Handlers;

use NinjaForms\CiviCrmShared\Contracts\DataModelProvider as ContractsDataModelProvider;

/**
 * Provides standard data model structures
 * 
 * API requests have some common structures when delivering data,
 * and NF diagnostics have common structures for presenting that
 * data for support.  This class enables standardization by taking
 * known data inputs and structuring them for known data outputs.
 */
class DataModelProvider implements ContractsDataModelProvider
{
    /** @inheritDoc */
    public function columnsFromCollection(?array $collection, array $keys): array
    {
        $return = [];

        if (\is_array($collection)) {
            foreach ($collection as $element) {
                $newIndexedElement = [];

                foreach ($keys as $key) {
                    if (isset($element[$key])) {
                        $newIndexedElement[$key] = $element[$key];
                    } else {
                        $newIndexedElement[$key] = null;
                    }
                }
                $return[] = $newIndexedElement;
            }
        }

        return $return;
    }

    /** @inheritDoc */
    public function keyValuePairsFromCollection(?array $collection, string $key, string $value): array
    {
        $return = [];

        $columnsFromCollection = $this->columnsFromCollection($collection, [$key, $value]);

        foreach ($columnsFromCollection as $element) {

            if (isset($element[$value])) {
                $return[$element[$key]] = $element[$value];
            }
        }

        return $return;
    }

    /** @inheritDoc */
    public function labelValuePairsFromCollection(?array $collection, string $label, string $value): array
    {
        $return = [];

        $columnsFromCollection = $this->columnsFromCollection($collection, [$label, $value]);

        foreach ($columnsFromCollection as $element) {
            $returnedLabel = isset($element[$label]) ? $element[$label] : '';
            $returnedValue = isset($element[$value]) ? $element[$value] : '';

            $return[] = [
                'label' => $returnedLabel,
                'value' => $returnedValue
            ];
        }

        return $return;
    }
}
