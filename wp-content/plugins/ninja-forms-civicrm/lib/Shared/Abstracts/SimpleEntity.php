<?php

namespace NinjaForms\CiviCrmShared\Abstracts;

/**
 * Simple entity abstract upon which all entities are built
 *
 * Entities are classes that pass well defined data honoring contracts.
 * Single parameters and arrays, when passed into an entity, can be relied
 * upon to provide the data defined by the entity, even if the original data
 * did not fully define values.
 */
class SimpleEntity implements \JsonSerializable
{

	/**
	 * Constructs an array representation
	 */
	public function toArray(): array
	{
		$vars = get_object_vars($this);
		$array = [];
		foreach ($vars as $property => $value) {
			if (is_object($value) && is_callable([$value, 'toArray'])) {
				$value = $value->toArray();
			}
			$array[$property] = $value;
		}
		return $array;
	}

	/**
	 * Sets data for json_encode
	 *
	 * @return void
	 */
	public function jsonSerialize()
	{
		return $this->toArray();
	}

}
