<?php

namespace Civi\ActionProvider\Parameter;

use \Civi\ActionProvider\Parameter\ParameterBagInterface;

class ParameterBag implements ParameterBagInterface, \IteratorAggregate {

	protected $parameters = array();

	/**
	 * Get the parameter.
	 */
	public function getParameter($name) {
		if (isset($this->parameters[$name])) {
			return $this->parameters[$name];
		}
		return null;
	}
	/**
	 * Tests whether the parameter with the name exists.
	 */
	public function doesParameterExists($name) {
		if (isset($this->parameters[$name])) {
			return true;
		}
		return false;
	}

	/**
	 * Sets parameter.
	 */
	public function setParameter($name, $value) {
		$this->parameters[$name] = $value;
	}

	public function getIterator(): \Traversable {
    return new \ArrayIterator($this->parameters);
  }

	/**
	 * Converts the object to an array.
	 *
	 * @return array
	 */
	public function toArray() {
		return $this->parameters;
	}

  /**
   * @param array $data
   *
   * @return \Civi\ActionProvider\Parameter\ParameterBag
   */
	public function fromArray($data, SpecificationBag $specificationBag=null) {
	  foreach($data as $key => $val) {
      $spec = null;
      if ($specificationBag) {
        $spec = $specificationBag->getSpecificationByName($key);
      }
      if ($spec && $spec->isMultiple() && !is_array($val)) {
        $val = explode(",", $val);
      }
	    $this->setParameter($key, $val);
    }
	  return $this;
  }

}
