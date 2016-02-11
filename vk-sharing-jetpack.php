<?php
/*
 * Plugin Name: vk.com sharing for Jetpack
 * Plugin URI: http://wordpress.org/plugins/vk-sharing-jetpack/
 * Description: Add a vk.com button to the Jetpack Sharing module
 * Author: Jeremy Herve
 * Version: 1.2.3
 * Author URI: http://jeremy.hu
 * License: GPL2+
 * Text Domain: vkjp
 */

class Vkcom_Button {
	private static $instance;

	static function get_instance() {
		if ( ! self::$instance )
			self::$instance = new Vkcom_Button;

		return self::$instance;
	}

	private function __construct() {
		// Check if Jetpack and the sharing module is active
		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'sharedaddy' ) ) {
			add_action( 'plugins_loaded', array( $this, 'setup' ) );
		} else {
			add_action( 'admin_notices',  array( $this, 'install_jetpack' ) );
		}
	}

	public function setup() {
		add_filter( 'sharing_services', array( $this, 'inject_service' ) );
	}

	// Add the Vk.com Button to the list of services in Sharedaddy
	public function inject_service ( $services ) {
		include_once 'class.vk-sharing-jetpack.php';
		if ( class_exists( 'Share_VKcom' ) ) {
			$services['vkcom'] = 'Share_VKcom';
		}
		return $services;
	}

	// Prompt to install Jetpack
	public function install_jetpack() {
		echo '<div class="error"><p>';
		printf(__( 'To use the VK.com Sharing plugin, you\'ll need to install and activate <a href="%1$s">Jetpack</a> first, and <a href="%2$s">activate the Sharing module</a>.'),
		'plugin-install.php?tab=search&s=jetpack&plugin-search-input=Search+Plugins',
		'admin.php?page=jetpack_modules',
		'vkjp'
		);
		echo '</p></div>';
	}

}
// And boom.
Vkcom_Button::get_instance();
