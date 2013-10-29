<?php
/*
 * Plugin Name: vk.com sharing for Jetpack
 * Plugin URI: http://wordpress.org/plugins/vk-sharing-jetpack/
 * Description: Add a vk.com button to the Jetpack Sharing module
 * Author: Jeremy Herve
 * Version: 1.0
 * Author URI: http://jeremyherve.com
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
		if ( class_exists( 'Jetpack' ) && Jetpack::init()->is_module_active( 'sharedaddy' ) )
			add_action( 'plugins_loaded', array( $this, 'setup' ) );
	}

	public function setup() {
		add_filter( 'sharing_services', 	array( 'Share_VKcom', 'inject_service' ) );
		add_action( 'wp_enqueue_scripts',   array( $this, 'enqueue_script' ) );
	}

	// Add Javascript in the head
	public function enqueue_script() {
		wp_enqueue_script( 'vkcom-js', ( is_ssl() ? 'https:' : 'http:' ) . '//vk.com/js/api/share.js?86', false, null );
	}
}

// Include Jetpack's sharing class, Sharing_Source
$share_plugin = wp_get_active_and_valid_plugins();
if ( is_multisite() ) {
	$share_plugin = array_unique( array_merge($share_plugin, wp_get_active_network_plugins() ) );
}
$share_plugin = preg_grep( '/\/jetpack\.php$/i', $share_plugin );
if ( ! class_exists( 'Sharing_Source' ) )
	include_once( preg_replace( '/jetpack\.php$/i', 'modules/sharedaddy/sharing-sources.php', reset( $share_plugin ) ) );

// Build button
class Share_VKcom extends Sharing_Source {
	var $shortname = 'vkcom';	
	public function __construct( $id, array $settings ) {
		parent::__construct( $id, $settings );
		$this->smart = 'official' == $this->button_style;
		$this->button_style = 'icon-text';
	}

	public function get_name() {
		return __( 'Vk.com', 'vkjp' );
	}


	public function get_display( $post ) {
		if ( $this->smart ) {
			return '
			<script type="text/javascript"><!--
			document.write(
				VK.Share.button(
					false,
					{url: "'. get_permalink( $post->ID ) .'",type: "round", text: "Share"}
				)
			);
			--></script>';
		} else {
			return '<a target="_blank" rel="nofollow" class="share-vkcom sd-button share-icon" href="http://vkontakte.ru/share.php?url='. get_permalink( $post->ID ) .'"><span>Vk.com</span></a>';
		}
	}

	// Add the Vk.com Button to the list of services in Sharedaddy
	public function inject_service ( array $services ) {
		if ( ! array_key_exists( 'vkcom', $services ) ) {
			$services['vkcom'] = 'Share_VKcom';
		}
		return $services;
	}
}

// And boom.
Vkcom_Button::get_instance();
