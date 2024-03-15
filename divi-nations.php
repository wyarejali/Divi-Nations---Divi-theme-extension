<?php
/*
Plugin Name: Divi Nations
Plugin URI:  https://wordpress.org/plugins/divi-nations/
Description: Divi extension to create powerful websites with useful modules
Version:     1.0.0
Author:      Divi-Nations
Author URI:  https://divi-nations.com
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
Text Domain: dne-divi-nations
Domain Path: /languages
*/


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * The plugin main class
 */
if( ! class_exists( 'DNE_DIVI_NATIONS_PLUGIN' ) ) :

	final class dne_divi_nations_plugin {

		/**
		 * Plugin version
		 *
		 * @var string
		 */
		const version = '1.0';

		/**
		 * Plugin documentation
		 * 
		 * @var string
		 */
		const DOCUMENTATION_LINK = 'https://docs.divi-nations.com';

		/**
		 * Get Premium plugin link
		 * 
		 * @var string
		 */
		const GET_PREMIUM_LINK = 'https://divi-nations.com/pricing';

		/**
		 * Plugin only instance
		 */
		private static $instance;
	
		/**
		 * Class construcotr
		 */
		private function __construct() {
			$this->define_constants();
	
			register_activation_hook( __FILE__, [ $this, 'activate' ] );
	
			add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
			add_action('divi_extensions_init', [ $this, 'dne_extension_initialize']);
			add_filter( 'plugin_action_links_' . DNE_DIVI_NATIONS_PLUGIN_BASE, [ $this, 'add_plugin_action_links' ] );
		}
	
		/**
		 * Initializes a singleton instance
		 *
		 * @return \dne_divi_nations_plugin
		 */
		public static function init() {
	
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof dne_divi_nations_plugin ) ) {
				$instance = new self();
			}
	
			return $instance;
		}
	
		/**
		 * Define the required plugin constants
		 *
		 * @return void
		 */
		public function define_constants() {
			define( 'DNE_DIVI_NATIONS_PLUGIN_VERSION', self::version );
			define( 'DNE_DIVI_NATIONS_PLUGIN_DIR', plugin_dir_path(__FILE__) );
			define( 'DNE_DIVI_NATIONS_PLUGIN_URL', plugin_dir_url(__FILE__) );
			define( 'DNE_DIVI_NATIONS_PLUGIN_ASSETS', trailingslashit( DNE_DIVI_NATIONS_PLUGIN_URL . 'assets' ) );
			define( 'DNE_DIVI_NATIONS_PLUGIN_FILE', __FILE__ );
			define( 'DNE_DIVI_NATIONS_PLUGIN_BASE', plugin_basename(__FILE__) );
		}
	
		/**
		 * Initialize the plugin
		 *
		 * @return void
		 */
		public function init_plugin() {
	
			// if ( is_admin() ) {
			// 	new WeDevs\Academy\Admin();
			// } else {
			// 	new WeDevs\Academy\Frontend();
			// }
	
		}

		public function dne_extension_initialize() {			
			require_once DNE_DIVI_NATIONS_PLUGIN_DIR . 'includes/DiviNations.php';
		}
	
		/**
		 * Do stuff upon plugin activation
		 *
		 * @return void
		 */
		public function activate() {
			$installed = get_option( 'dne_divi_nation_installed' );
	
			if ( ! $installed ) {
				update_option( 'dne_divi_nation_installed', time() );
			}
	
			update_option( 'dne_divi_nation_version', DNE_DIVI_NATIONS_PLUGIN_VERSION );
		}

		/**
		 * Add Pluign actions links
		 * 
		 * @param mixed $links
		 * 
		 * @return mixed $links
		 */
		public function add_plugin_action_links($links) {

			$links[] = sprintf(
				'<a href="%1$s" target="_blank" style="color: #197efb;font-weight: 600;">
					%2$s
				</a>',
				self::GET_PREMIUM_LINK,
				esc_html__( 'Settings', 'dne-divi-nations' )
			);

			$links[] = sprintf(
				'<a href="%1$s" target="_blank" style="color: #197efb;font-weight: 600;">
					%2$s
				</a>',
				self::DOCUMENTATION_LINK,
				esc_html__( 'Docs', 'dne-divi-nations' )
			);

			$links[] = sprintf(
				'<a href="%1$s" target="_blank" style="color: #dc2f02;font-weight: 700;">
					%2$s
				</a>',
				self::GET_PREMIUM_LINK,
				esc_html__( 'Get Pro', 'dne-divi-nations' )
			);

			return $links;
		}
	}
	
endif;


/**
 * Initializes the main plugin
 * 
 * @return void
 */
function dne_divi_nation_plugin() {
	return DNE_DIVI_NATIONS_PLUGIN::init();
}

// Kick-off the plugin
dne_divi_nation_plugin();