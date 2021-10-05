<?php

// Subpackage namespace
namespace RISE\DisableEmbeds\Core;

// Aliased namespaces
use \RISE\DisableEmbeds\Helpers;

/**
 * Core class
 *
 * @package Disable Embeds
 * @subpackage Core
 */
final class Core extends Helpers\Singleton {



	// Initialization
	// ---------------------------------------------------------------------------------------------------



	/**
	 * Face constructor
	 */
	protected function onConstruct() {

		// Init factory object
		$this->plugin->factory = new Factory($this->plugin);

		// Create registrar object and set hooks handler
		$this->plugin->factory->registrar->setHandler($this);

		// Start the hooks object
		$this->plugin->factory->hooks();
	}



	// Registrar events
	// ---------------------------------------------------------------------------------------------------



	/**
	 * Plugin activation
	 */
	public function onActivation() {
		add_filter('rewrite_rules_array', [$this->plugin->factory->cleaner, 'rules']);
		flush_rewrite_rules();
	}



	/**
	 * Plugin deactivation
	 */
	public function onDeactivation() {
		add_filter('rewrite_rules_array', [$this->plugin->factory->cleaner, 'rules']);
		flush_rewrite_rules();
	}



}