<?php

namespace NinjaForms\CiviCrmShared\Entities;

use NinjaForms\CiviCrmShared\Entities\AdvancedSetting;
use NinjaForms\CiviCrmShared\Abstracts\SimpleEntity;

/**
 * Describes a collection of Advanced Setting entities
 * @package Settings
 */
class AdvancedSettings extends SimpleEntity
{

	/**
	 * Id of the Plugin settings collection
	 * @var string
	 */
	protected $id;

	/**
	 * Nicename of the Advanced settings collection
	 * @var string
	 */
	protected $nicename;

	/**
	 * @var AdvancedSetting[]
	 */
	protected $advancedSettings = [];


	/**
	 * Return Advanced settings Id
	 * @return string
	 */
	public function getId(): string
	{
		return isset($this->id) ? (string) $this->id : '';
	}

	/**
	 * Return Advanced setting nicename
	 * @return string
	 */
	public function getNicename(): string
	{
		return isset($this->nicename) ? (string) $this->nicename : '';
	}

	/**
	 * Set Advanced setting Id
	 * @param string $stringValue
	 * @return AdvancedSettings
	 */
	public function setId(string $stringValue): AdvancedSettings
	{
		$this->id = $stringValue;

		return $this;
	}

	/**
	 * Set Advanced setting label
	 * @param string $stringValue
	 * @return AdvancedSettings
	 */
	public function setLabel(string $stringValue): AdvancedSettings
	{
		$this->label = $stringValue;

		return $this;
	}

	/**
	 * Construct entity from array
	 */
	public static function fromArray(array $items): AdvancedSettings
	{
		$obj = new static();

		foreach ($items as $property => $value) {
			// if string, set property value
			if ('advancedSettings' !== $property) {
				$obj = $obj->__set($property, $value);
				continue;
			}
			// Add entities stored in array

			foreach ((array) $value as $list) {
				if (!is_array($list)) {
					if (is_a($list, AdvancedSetting::class)) {
						$obj->addAdvancedSetting($list);
						continue;
					} else {
						$list = (array) $list;
					}
				}

				$obj->addAdvancedSetting(AdvancedSetting::fromArray($list));
			}
		}

		return $obj;
	}

	/**
	 * Convert AdvancedEttings object into associative array
	 *
	 * @return array
	 */
	public function toArray(): array
	{
		$vars = get_object_vars($this);

		$array = [];

		foreach ($vars as $property => $value) {
			if ('advancedSettings' === $property) {
				$advancedSettings = [];

				if (!is_array($value)) {
					$array['advancedSettings'] = [];
					continue;
				}

				foreach ($value as $key => $advancedSetting) {
					if (is_a($advancedSetting, AdvancedSetting::class)) {
						$advancedSettings[$key] = $advancedSetting->toArray();
					}
				}

				$value = $advancedSettings;
			} elseif (is_object($value) && is_callable([$value, 'toArray'])) {
				$value = $value->toArray();
			}

			$array[$property] = $value;
		}

		return $array;
	}

	/**
	 * Add an Advanced Setting to collection
	 *
	 * @param AdvancedSetting $advancedSetting
	 *
	 * @return AdvancedSettings
	 */
	public function addAdvancedSetting(AdvancedSetting $advancedSetting): AdvancedSettings
	{
		$this->advancedSettings[$advancedSetting->getName()] = $advancedSetting;

		return $this;
	}

	/**
	 * Get a Plugin Setting from collection
	 *
	 * @param string $key
	 *
	 * @return AdvancedSetting
	 * @throws Exception
	 */
	public function getAdvancedSetting(string $key): AdvancedSetting
	{
		if (!isset($this->advancedSettings[$key])) {
			throw new \Exception();
		}
		return $this->advancedSettings[$key];
	}

	/**
	 * Get all Plugin Settings in collection
	 *
	 * @return AdvancedSetting[]
	 */
	public function getAdvancedSettings(): array
	{
		return $this->advancedSettings;
	}

	/**
	 * Get all Plugin Settings as keyed array of AdvancedSetting arrays
	 *
	 * @return array
	 */
	public function getAdvancedSettingsArray(): array
	{
		$toArray = $this->toArray();

		$return = $toArray['advancedSettings'];

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
