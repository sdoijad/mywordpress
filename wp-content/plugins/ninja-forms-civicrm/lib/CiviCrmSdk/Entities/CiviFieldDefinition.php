<?php

namespace NinjaForms\CiviCrmSdk\Entities;

use NinjaForms\CiviCrmShared\Abstracts\SimpleEntity;

/**
 * Field definition for a CiviCRM field
 * 
 * Uses CiviCRM property names
 */
class CiviFieldDefinition extends SimpleEntity
{

	/** @var string */
	protected $name;

	/**  @var string */
	protected $label;

	/** @var string */
	protected $entity;

	/** @var bool */
	protected $required;

	/** @var string */
	protected $data_type;

	/** @var string */
	protected $input_type;


	/** @return string*/
	public function getName(): string
	{
		return isset($this->name) ? (string) $this->name : '';
	}

	/** @return string*/
	public function getLabel(): string
	{
		return isset($this->label) ? (string) $this->label : '';
	}

	/** @return string*/
	public function getEntity(): string
	{
		return isset($this->entity) ? (string) $this->entity : '';
	}

	/** @return bool*/
	public function isRequired(): bool
	{
		return isset($this->required) ?  $this->required : false;
	}

	/** @return string*/
	public function getDataType(): string
	{
		return isset($this->data_type) ? (string) $this->data_type : '';
	}

	/** @return string*/
	public function getInputType(): string
	{
		return isset($this->input_type) ? (string) $this->input_type : '';
	}

	/**
	 * Construct entity from array
	 *
	 * @param array $items
	 * @return CiviFieldDefinition
	 */
	public static function fromArray(array $items): CiviFieldDefinition
	{
		$obj = new static();
		foreach ($items as $property => $value) {
			$obj = $obj->__set($property, $value);
		}

		return $obj;
	}

	/**
	 * Set defined properties
	 */
	public function __set($name, $value)
	{
		$setter = 'set' . ucfirst($name);
		if (method_exists($this, $setter)) {
			return call_user_func([$this, $setter], $value);
		}
		if (property_exists($this, $name)) {
			$this->$name = $value;
			return $this;
		}

		return $this;
	}
}
