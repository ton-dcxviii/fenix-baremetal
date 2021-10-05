<?php

// Subpackage namespace
namespace RISE\DisableEmbeds\Core;

// Aliased namespaces
use \RISE\DisableEmbeds\Embeds;
use \RISE\DisableEmbeds\Helpers;

/**
 * Object Factory class
 *
 * @package Disable Embeds
 * @subpackage Core
 */
class Factory extends Helpers\Factory {



	/**
	 * Hooks object
	 */
	protected function createHooks() {
		return new Embeds\Hooks($this->plugin);
	}



	/**
	 * Cleaner object
	 */
	protected function createCleaner() {
		return Embeds\Cleaner::instance($this->plugin);
	}



	/**
	 * Allowed object
	 */
	protected function createAllowed() {
		return new Embeds\Allowed;
	}



	/**
	 * Registrar object
	 */
	protected function createRegistrar() {
		return new Helpers\Registrar($this->plugin);
	}



}