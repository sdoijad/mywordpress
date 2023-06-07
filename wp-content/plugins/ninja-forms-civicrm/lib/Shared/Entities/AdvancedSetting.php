<?php

namespace NinjaForms\CiviCrmShared\Entities;

use NinjaForms\CiviCrmShared\Abstracts\SimpleEntity;

/**
 * Single plugin setting in form design's Advanced section
 *
 * @package Settings
 */
class AdvancedSetting extends SimpleEntity
{

	/**
	 * Name for setting entity
	 * @var string
	 */
	protected $name;

	/**
	 * Label for setting entity
	 * @var string
	 */
	protected $label;

	/**
	 * 
	 * NF setting 'type'
	 *
	 * 'textbox' is default value for AdvancedSetting, and can be overridden by children
	 * @var string
	 */
	protected $type = 'textbox';

	/**
	 * Template row
	 *
	 * Uses pre-existing property name
	 * @var string
	 */
	protected $tmpl_row;

	/**
	 * Columns for option repeater
	 *
	 * @var array
	 */
	protected $columns;

	/**
	 * Width
	 *
	 * @var string
	 */
	protected $width;
	/**
	 * Group in which advanced setting belongs
	 *
	 * @var string
	 */
	protected $group;

	/**
	 * Stored value of the setting
	 *
	 * 
	 * @var mixed
	 */
	protected $value = null;

	/**
	 * Return Advanced setting Name
	 * @return string
	 */
	public function getName(): string
	{
		return isset($this->name) ? (string) $this->name : '';
	}

	/**
	 * Return Advanced setting label
	 * @return string
	 */
	public function getLabel(): string
	{
		return isset($this->label) ? (string) $this->label : '';
	}

	/**
	 * Return Advanced setting data type
	 * @return string
	 */
	public function getType(): string
	{
		return isset($this->type) ? (string) $this->type : '';
	}

	/**
	 * Return Advanced setting width
	 * @return string
	 */
	public function getWidth(): string
	{
		return isset($this->width) ? (string) $this->width : '';
	}
	/**
	 * Return Advanced setting group
	 * @return string
	 */
	public function getGroup(): string
	{
		return isset($this->group) ? (string) $this->group : '';
	}
	/**
	 * Return Advanced setting template row
	 * @return string
	 */
	public function getTemplateRow(): string
	{
		return isset($this->tmpl_row) ? (string) $this->tmpl_row : '';
	}
	/**
	 * Return Advanced setting columns
	 * @return string
	 */
	public function getColumns(): array
	{
		return isset($this->columns) ?  $this->columns : [];
	}

	/**
	 * Get the value for the AdvancedSetting
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Set Advanced setting Name
	 * @param string $stringValue
	 * @return AdvancedSetting
	 */
	public function setName(string $stringValue): AdvancedSetting
	{
		$this->name = $stringValue;

		return $this;
	}

	/**
	 * Set Advanced setting label
	 * @param string $stringValue
	 * @return AdvancedSetting
	 */
	public function setLabel(string $stringValue): AdvancedSetting
	{
		$this->label = $stringValue;

		return $this;
	}

	/**
	 * Set Advanced setting expected data type
	 *
	 * @param string $stringValue
	 * @return AdvancedSetting
	 */
	public function setType(string $stringValue): AdvancedSetting
	{
		$this->type = $stringValue;

		return $this;
	}

	/**
	 * Set Advanced setting width
	 * @param string $stringValue
	 * @return AdvancedSetting
	 */
	public function setWidth(string $stringValue): AdvancedSetting
	{
		$this->width = $stringValue;

		return $this;
	}
	/**
	 * Set Advanced setting Group
	 * @param string $stringValue
	 * @return AdvancedSetting
	 */
	public function setGroup(string $stringValue): AdvancedSetting
	{
		$this->group = $stringValue;

		return $this;
	}
	/**
	 * Set Advanced setting template row
	 * @param string $stringValue
	 * @return AdvancedSetting
	 */
	public function setTemplateRow(string $stringValue): AdvancedSetting
	{
		$this->tmpl_row = $stringValue;

		return $this;
	}
	/**
	 * Set Advanced setting column
	 * @param array $arrayValue
	 * @return AdvancedSetting
	 */
	public function setColumns(array $arrayValue): AdvancedSetting
	{
		$this->columns = $arrayValue;

		return $this;
	}

	/**
	 * Set the value for the AdvancedSetting
	 *
	 * @param type $param
	 */
	public function setValue($param): AdvancedSetting
	{
		$this->value = $param;

		return $this;
	}

	public static function fromArray(array $items): AdvancedSetting
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
