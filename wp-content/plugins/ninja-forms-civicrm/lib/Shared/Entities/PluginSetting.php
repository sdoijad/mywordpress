<?php

namespace NinjaForms\CiviCrmShared\Entities;

use NinjaForms\CiviCrmShared\Abstracts\SimpleEntity;

/**
 * Single plugin setting in NF Settings
 * 
 * This entity describes a piece of data that the plugin requires.  NF
 * is responsible for storing and delivering this entity.
 * 
 * @package Settings
 */
class PluginSetting extends SimpleEntity
{

	/**
	 * Id for setting entity
	 * @var string
	 */
	protected $id;

	/**
	 * Label for setting entity
	 * @var string
	 */
	protected $label;

	/**
	 * 
	 * NF setting 'type'
	 *
	 * 'textbox' is default value for PluginSetting, and can be overridden by children
	 * @var string
	 */
	protected $type = 'textbox';

	/**
	 * HTML output when type is `html`
	 *
	 * @var string
	 */
	protected $html;
	/**
	 * Stored value of the setting
	 *
	 * Upon initial configuration inside the ApiModule, this value is null.
	 * The Integrating Plugin manages the solicitation of  values from the
	 * user, storing of the values, and returning the values upon demand.
	 *
	 * @var mixed
	 */
	protected $value = null;

	/**
	 * Return Plugin setting Id
	 * @return string
	 */
	public function getId(): string
	{
		return isset($this->id) ? (string) $this->id : '';
	}

	/**
	 * Return Plugin setting label
	 * @return string
	 */
	public function getLabel(): string
	{
		return isset($this->label) ? (string) $this->label : '';
	}

	/**
	 * Return Plugin setting data type
	 * @return string
	 */
	public function getType(): string
	{
		return isset($this->type) ? (string) $this->type : '';
	}

	/**
	 * Return Plugin setting html
	 * @return string
	 */
	public function getHtml(): string
	{
		return isset($this->html) ? (string) $this->html : '';
	}

	/**
	 * Get the value for the PluginSetting
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Set Plugin setting Id
	 * @param string $stringValue
	 * @return PluginSetting
	 */
	public function setId(string $stringValue): PluginSetting
	{
		$this->id = $stringValue;

		return $this;
	}

	/**
	 * Set Plugin setting label
	 * @param string $stringValue
	 * @return PluginSetting
	 */
	public function setLabel(string $stringValue): PluginSetting
	{
		$this->label = $stringValue;

		return $this;
	}

	/**
	 * Set Plugin setting expected data type
	 *
	 * @param string $stringValue
	 * @return PluginSetting
	 */
	public function setType(string $stringValue): PluginSetting
	{
		$this->type = $stringValue;

		return $this;
	}

	/**
	 * Set Plugin setting HTML
	 * @param string $stringValue
	 * @return PluginSetting
	 */
	public function setHtml(string $stringValue): PluginSetting
	{
		$this->html = $stringValue;

		return $this;
	}

	/**
	 * Set the value for the PluginSetting
	 *
	 * @param type $param
	 */
	public function setValue($param): PluginSetting
	{
		$this->value = $param;

		return $this;
	}

	public static function fromArray(array $items): PluginSetting
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
