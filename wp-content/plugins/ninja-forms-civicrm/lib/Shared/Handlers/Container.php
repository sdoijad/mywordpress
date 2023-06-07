<?php

namespace NinjaForms\CiviCrmShared\Handlers;

/**
 * Basic service container
 *
 */
class Container
{

	/*** @var array Singletons */
	protected $unBoundSingletons = [];

	/** @var array Services */
	protected $services = [];

	/** @inheritdoc */
	public function doesProvide($serviceName)
	{
		if (!is_array($this->services)) {
			$this->services = [];
		}

		return !empty($this->services) && array_key_exists($serviceName, $this->services);
	}

	/** @inheritdoc */
	public function bind($alias, $concrete)
	{
		$this->services[$alias] = $concrete;
	}

	/** @inheritdoc */
	public function make($alias)
	{
		if ($this->isUnBoundSingleton($alias)) {
			$binding = $this->unBoundSingletons[$alias];
			$this->singleton($alias, $binding());
		}

		if (!isset($this->services[$alias])) {
			return $this->resolve($alias);
		}

		if (is_callable($this->services[$alias])) {
			return call_user_func_array($this->services[$alias], array($this));
		}

		if (is_object($this->services[$alias])) {
			return $this->services[$alias];
		}

		if (class_exists($this->services[$alias])) {
			return $this->resolve($this->services[$alias]);
		}

		return $this->resolve($alias);
	}

	private function isUnBoundSingleton($alias)
	{

		return  !empty($this->unBoundSingletons) && array_key_exists($alias, $this->unBoundSingletons);
	}


	public function singleton($alias, $binding)
	{
		if (is_callable($binding)) {
			$this->unBoundSingletons[$alias] = $binding;
		} else {
			if ($this->isUnBoundSingleton($alias)) {
				unset($this->unBoundSingletons[$alias]);
			}
			$this->services[$alias] = $binding;
		}
	}


	/**
	 * Resolve dependencies.
	 *
	 * @param $class
	 * @return object
	 */
	private function resolve($class)
	{
		$reflection = new \ReflectionClass($class);

		$constructor = $reflection->getConstructor();

		// Constructor is null
		if (!$constructor) {
			return new $class;
		}

		// Constructor with no parameters
		$params = $constructor->getParameters();

		if (count($params) === 0) {
			return new $class;
		}

		$newInstanceParams = array();

		foreach ($params as $param) {
			if (is_null($param->getClass())) {
				$newInstanceParams[] = null;
				continue;
			}

			$newInstanceParams[] = $this->make(
				$param->getClass()->getName()
			);
		}

		return $reflection->newInstanceArgs(
			$newInstanceParams
		);
	}

	public function has($id)
	{
		return $this->bound($id);
	}

	/**
	 * Determine if the given abstract type has been bound.
	 *
	 * @param  string  $abstract
	 * @return bool
	 */
	public function bound($abstract)
	{
		return isset($this->services[$abstract]) ||
			isset($this->unBoundSingletons[$abstract]) ||
			$this->isAlias($abstract);
	}

	/**
	 * Determine if a given string is an alias.
	 *
	 * @param  string  $name
	 * @return bool
	 */
	public function isAlias($name)
	{
		return isset($this->aliases[$name]);
	}
}
