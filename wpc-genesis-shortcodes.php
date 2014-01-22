<?php 
/**
 * Plugin Name:       Genesis Custom ShortCodes
 * Plugin URI:        http://IvanLopezDeveloper.com
 * Description:       ShortCodes for buttons, columns and elements
 * Version:           1.0.0
 * Author:            Ivan Lopez <ivanlopezvp@gmail.com.com>
 * Author URI:        http://IvanLopezDeveloper.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'WPC_GS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPC_GS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

class WPC_Shortcodes {

	/**
	* Initializes the plugin by loading shortcodes.
	*/
	public function __construct() {
	    add_action( 'init', array( $this, 'init_plugin' ) );
	  
	} // end constructor

	/**
	* Init Plugin
	*
	* @since 1.0
	*
	* @return void
	*/
	public function init_plugin() {
		//Load add_buttons
		require_once WPC_GS_PLUGIN_DIR . 'includes/column-shortcodes.php';
		require_once WPC_GS_PLUGIN_DIR . 'includes/elements-shortcodes.php';
		
		add_filter( "mce_external_plugins", array( $this, "add_buttons") );
	    	add_filter( 'mce_buttons', array( $this, 'register_buttons') );

	    	add_action( 'admin_enqueue_scripts', array( $this, 'load_css') );
	}
     
     /**
	* Add buttons to editor
	*
	* @since 1.0
	*
	* @return array
	*/
     public function add_buttons( $plugin_array ) {
		$plugin_array['wpcGenesis'] = 	WPC_GS_PLUGIN_URL . 'js/shortcodes.js';
    		return $plugin_array;
	}

	/**
	* Register buttons to editor
	*
	* @since 1.0
	*
	* @return array
	*/
	public function register_buttons( $buttons ) {
		array_push( $buttons, 'columns', 'wpc_buttons', 'wpc_notice-boxes' );
		return $buttons;
	}

	/**
	* load admin css
	*
	* @since 1.0
	*
	* @return voice
	*/
	public function load_css( ) {
		wp_enqueue_style( 'wpc-shortcodes', WPC_GS_PLUGIN_URL . 'css/wpc-shortcodes.css', array(), null, 'all');
	}


} // end class

// instantiate our plugin's class
$GLOBALS['wpc_shortcodes'] = new WPC_Shortcodes();