<?php

// Subpackage namespace
namespace RISE\DashboardCleanup\Core;

// Aliased namespaces
use \RISE\DashboardCleanup\Helpers;

/**
 * Core class
 *
 * @package Dashboard Cleanup
 * @subpackage Core
 */
final class Core extends Helpers\Singleton {



	/**
	 * Pseudo constructor
	 */
	protected function onConstruct() {

		// Check admin area
		if ($this->plugin->context()->admin()) {

			// Factory object
			$factory = new Factory($this->plugin);

			// Elements
			add_filter('admin_footer_text', [$factory->elements(), 'footerText']);
			add_action('admin_init', [$factory->elements(), 'WPORGShortcutLinks']);
			add_action('admin_init', [$factory->elements(), 'linkManagerMenu']);
			add_filter('install_plugins_tabs', [$factory->elements(), 'addPluginTabs']);
			add_action('current_screen', [$factory->elements(), 'addThemeTabs']);
			add_action('admin_menu', [$factory->elements(), 'adminMenu'], PHP_INT_MAX);
			add_action('current_screen', [$factory->elements(), 'themeEditor']);

			// Dashboard
			add_action('admin_init', [$factory->dashboard(), 'quickDraft']);
			add_action('admin_init', [$factory->dashboard(), 'welcomePanel']);
			add_action('admin_init', [$factory->dashboard(), 'eventsAndNews']);

			// WooCommerce
			add_filter('woocommerce_helper_suppress_connect_notice', [$factory->woocommerce(), 'connectStore']);
			add_filter('woocommerce_show_admin_notice', [$factory->woocommerce(), 'productsBlock'], 10, 2);
			add_filter('woocommerce_display_admin_footer_text', [$factory->woocommerce(), 'footerText']);
			add_filter('woocommerce_allow_marketplace_suggestions', [$factory->woocommerce(), 'marketplaceSuggestions']);
			add_action('current_screen', [$factory->woocommerce(), 'grayedoutSuggestions']);
			add_filter('woocommerce_tracker_last_send_time', [$factory->woocommerce(), 'trackerSendTime'], PHP_INT_MAX);

// WC debug point
//wp_schedule_single_event( time() + 10, 'woocommerce_tracker_send_event', array( true ) );

		// Check frontend execution
		} elseif ($this->plugin->context()->front()) {

			// Factory object
			$factory = new Factory($this->plugin);

			// Remove WP.org logo and shortcut links before template load
			add_action('template_redirect', [$factory->elements(), 'WPORGShortcutLinks']);

			// Removes front search icon/field before template load
			add_action('template_redirect', [$factory->elements(), 'removeAdminTopSearch'], PHP_INT_MAX);

		// Check cron execution
		} elseif ($this->plugin->context()->cron()) {

			// Factory object
			$factory = new Factory($this->plugin);

			// Add also here the last_send_time filter
			add_filter('woocommerce_tracker_last_send_time', [$factory->woocommerce(), 'trackerSendTime'], PHP_INT_MAX);
		}
	}



}