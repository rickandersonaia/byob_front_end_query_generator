<?php

/*
Plugin Name: BYOB Front End Query Generator
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: This plugin creates an interactive query on the front end allowing query by post type, taxonomy terms and post meta.
Version: 0.1
Author: Rick Anderson
Author URI: https://www.byobwebsite.com
 * License:     GPLv2
 * Text Domain: byobfeqg - BYOB (f)ront (e)nd (q)uery (g)enerator
 * Domain Path: /languages
 *
 * @link    https://github.com/rickandersonaia/damson_homes_property_report_printer
 *
 * @package BYOB_Front_End_Query_Generator
 * @version 0.1
 *
 */

/**
 * Copyright (c) 2017 Rick Anderson (email : rick@byobwebsite.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

class BYOB_Front_End_Query_Generator{


	const VERSION = '0.1';
	protected static $single_instance = null;
	public $post_id = 0;
	protected $url = '';
	protected $path = '';
	protected $basename = '';
	protected $activation_errors = array();

	protected function __construct() {
		$this->basename = plugin_basename( __FILE__ );
		$this->url      = plugin_dir_url( __FILE__ );
		$this->path     = plugin_dir_path( __FILE__ );

		define( 'VENDOR_PATH', $this->path . 'vendor/' );
		define( 'INC_PATH', $this->path . 'includes/' );
		
		if ( file_exists( VENDOR_PATH . 'webdevstudios/cmb2/init.php' ) ) {
			require_once VENDOR_PATH . 'webdevstudios/cmb2/init.php';
		}

		require_once( INC_PATH . 'dhprg_assemble_report_from_data.php' );
		require_once( VENDOR_PATH . 'autoload.php' );
	}



	/**
	 * Creates or returns an instance of this class.
	 *
	 * @since   0.1
	 * @return  BYOB_Front_End_Query_Generator A single instance of this class.
	 */
	public static function get_instance() {
		if ( null === self::$single_instance ) {
			self::$single_instance = new self();
		}

		return self::$single_instance;
	}
	/**
	 * Activate the plugin.
	 *
	 * @since  0.1
	 */

	public function _activate() {
	}


	/**
	 * Deactivate the plugin.
	 * Uninstall routines should be in uninstall.php.
	 *
	 * @since  0.1
	 */
	public function _deactivate() {
		// Add deactivation cleanup functionality here.
	}

	/**
	 * Init hooks
	 *
	 * @since  0.1
	 */
	public function init() {

		// Load translated strings for plugin.
		load_plugin_textdomain( 'dhprg', false, dirname( $this->basename ) . '/languages/' );

	}

}

/**
 * Grab the BYOB_Front_End_Query_Generator object and return it.
 * Wrapper for BYOB_Front_End_Query_Generator::get_instance().
 *
 * @since  0.1
 * @return BYOB_Front_End_Query_Generator  Singleton instance of plugin class.
 */
function byobfeqg() {
	return BYOB_Front_End_Query_Generator::get_instance();
}

// Kick it off.
add_action( 'plugins_loaded', 'byobfeqg' );

// Activation and deactivation.
register_activation_hook( __FILE__, array( byobfeqg(), '_activate' ) );
register_deactivation_hook( __FILE__, array( byobfeqg(), '_deactivate' ) );

