<?php

// Subpackage namespace
namespace RISE\DisableEmojis\Helpers;

/**
 * Object Factory base class
 *
 * @package Disable Emojis
 * @subpackage Core
 */
class Factory {



	// Properties
	// ---------------------------------------------------------------------------------------------------



	/**
	 * Plugin object
	 */
	private $plugin;



	// Initialization
	// ---------------------------------------------------------------------------------------------------



	/**
	 * Constructor
	 */
	public function __construct($plugin) {
		$this->plugin = $plugin;
	}



	// Methods
	// ---------------------------------------------------------------------------------------------------



	/**
	 * Magic GET method
	 */
	public function __get($name) {
		$method = 'create'.ucfirst($name);
		return method_exists($this, $method)? $this->{$method}() : null;
	}



	/**
	 * Magic CALL method
	 */
	public function __call($name, $args = null) {
		$method = 'create'.ucfirst($name);
		$args = (!empty($args) && is_array($args))? $args[0] : null;
		return method_exists($this, $method)? $this->{$method}($args) : null;
	}



}