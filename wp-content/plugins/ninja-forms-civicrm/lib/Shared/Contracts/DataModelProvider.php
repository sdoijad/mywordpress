<?php

namespace NinjaForms\CiviCrmShared\Contracts;

/**
 * Provides standard data model structures
 * 
 * API requests have some common structures when delivering data,
 * and NF diagnostics have common structures for presenting that
 * data for support.  This class enables standardization by taking
 * known data inputs and structuring them for known data outputs.
 */
interface DataModelProvider
{

    /**
     * Provide multi-dim array - indexed=>keyed
     * 
     * Given an indexed array of associative arrays, returns indexed array
     * of associative arrays containing only the specified keys.
     * 
     * Collection requests often include full entity definitions, but we may
     * need only a couple of keys within that full definition.
     * 
     * This method iterates through each item in the collection to validate the
     * data in process rather than some more powerful array functions because
     * this method cannot be certain of the data's validity.
     * 
     * [
     *  {key1=>val1a, key2=>val2a, key3=>val3a },
     *  {key1=>val1b, key2=>val2b, key3=>val3b }
     *  ...
     * ]
     *
     * @param array $collection
     * @param array $keys
     * @return array
     */
    public function columnsFromCollection(array $collection, array $keys): array;

    /**
     * Provide key value pair from a multidimentional array
     * 
     * Given an indexed array of associative arrays, returns key value pairs
     * of data within each element
     * 
     *
     * @param array $collection
     * @param array $keys
     * @return array
     */
    public function keyValuePairsFromCollection(array $collection, string $key, string $value): array;

    /**
     * Provide label-value pairs as indexed arrays
     * 
     * This is the structure used by NF core to construct such features as select options.
     * Given an indexed array of associative arrays, returns indexed array of label-value pairs.
     *
     * @param array $collection
     * @param string $label Key containing the indended label
     * @param string $value Key containing the intended value
     * @return array
     */
    public function labelValuePairsFromCollection(array $collection, string $label, string $value): array;
}
