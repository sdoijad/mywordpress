<?php

namespace NinjaForms\CiviCrmShared\Entities;

use NinjaForms\CiviCrmShared\Entities\PluginSetting;
use NinjaForms\CiviCrmShared\Abstracts\SimpleEntity;

/**
 * Describes a collection of Plugin Setting entities
 * 
 * @package Settings
 */
class PluginSettings extends SimpleEntity
{

	/**
	 * Id of the Plugin settings collection
	 * @var string
	 */
	protected $id;

	/**
	 * Label of the Plugin settings collection
	 * @var string
	 */
	protected $label;

	/**
	 * @var PluginSetting[]
	 */
	protected $pluginSettings = [];


	/**
	 * Return Plugin settings Id
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
	 * Set Plugin setting Id
	 * @param string $stringValue
	 * @return PluginSettings
	 */
	public function setId(string $stringValue): PluginSettings
	{
		$this->id = $stringValue;

		return $this;
	}

	/**
	 * Set Plugin setting label
	 * @param string $stringValue
	 * @return PluginSettings
	 */
	public function setLabel(string $stringValue): PluginSettings
	{
		$this->label = $stringValue;

		return $this;
	}

	/** @inheritDoc */
	public static function fromArray(array $items): PluginSettings
	{
		$obj = new static();

		foreach ($items as $property => $value) {
			// if string, set property value
			if ('pluginSettings' !== $property) {
				$obj = $obj->__set($property, $value);
				continue;
			}
			// Add entities stored in array

			foreach ((array) $value as $list) {
				if (!is_array($list)) {
					if (is_a($list, PluginSetting::class)) {
						$obj->addPluginSetting($list);
						continue;
					} else {
						$list = (array) $list;
					}
				}

				$obj->addPluginSetting(PluginSetting::fromArray($list));
			}
		}

		return $obj;
	}

	/**
	 * Convert PluginSettings object into associative array
	 *
	 * @return array
	 */
	public function toArray(): array
	{
		$vars = get_object_vars($this);

		$array = [];

		foreach ($vars as $property => $value) {
			if ('pluginSettings' === $property) {
				$pluginSettings = [];

				if (!is_array($value)) {
					$array['pluginSettings'] = [];
					continue;
				}

				foreach ($value as $key => $pluginSetting) {
					if (is_a($pluginSetting, PluginSetting::class)) {
						$pluginSettings[$key] = $pluginSetting->toArray();
					}
				}

				$value = $pluginSettings;
			} elseif (is_object($value) && is_callable([$value, 'toArray'])) {
				$value = $value->toArray();
			}

			$array[$property] = $value;
		}

		return $array;
	}

	/**
	 * Add an Plugin Setting to collection
	 *
	 * @param PluginSetting $pluginSetting
	 *
	 * @return PluginSettings
	 */
	public function addPluginSetting(PluginSetting $pluginSetting): PluginSettings
	{
		$this->pluginSettings[$pluginSetting->getId()] = $pluginSetting;

		return $this;
	}

	/**
	 * Get a Plugin Setting from collection
	 *
	 * @param string $key
	 *
	 * @return PluginSetting
	 * @throws Exception
	 */
	public function getPluginSetting(string $key): PluginSetting
	{
		if (!isset($this->pluginSettings[$key])) {
			throw new \Exception();
		}
		return $this->pluginSettings[$key];
	}

	/**
	 * Get all Plugin Settings in collection
	 *
	 * @return PluginSetting[]
	 */
	public function getPluginSettings(): array
	{
		return $this->pluginSettings;
	}

	/**
	 * Get all Plugin Settings as keyed array of PluginSetting arrays
	 *
	 * @return array
	 */
	public function getPluginSettingsArray(): array
	{
		$toArray = $this->toArray();

		$return = $toArray['pluginSettings'];

		return $return;
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
