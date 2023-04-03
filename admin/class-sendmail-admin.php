<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wisdmlabs.com
 * @since      1.0.0
 *
 * @package    Sendmail
 * @subpackage Sendmail/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sendmail
 * @subpackage Sendmail/admin
 * @author     Subhajit Bera <subhajit.bera@wisdmlabs.com>
 */
class Sendmail_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sendmail_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sendmail_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sendmail-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sendmail_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sendmail_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sendmail-admin.js', array( 'jquery' ), $this->version, false );

	}


	/* Add Sub Menu Field under settings section*/
	public function sb_sendmail_submenu_page() {
		include_once plugin_dir_path(__FILE__) .'partials/sendmail-admin-display.php';
		

		add_submenu_page(
			'options-general.php', 
			'SendMail',
			'Send Mail',
			'manage_options',
			'sb_sendmail',
			'sb_sendmail_submenu_page_content'
		);
	}

	public function sb_sendmail_register_settings(){
		include_once plugin_dir_path(__FILE__) . 'partials/sendmail-settings-callback.php';
		register_setting(
			'sb_sendmail_options',
			'sb_sendmail_options'
			//'subhajitplugin_callback_validate_options',
		);
	
		add_settings_section(
			'sendmail_section_noofposts',
			'Customize Number of Posts',
			'sendmail_callback_section_noofposts',
			'sb_sendmail'
		);

		add_settings_field(
			'no_of_posts',
			'No of Posts',
			'sb_sendmail_callback_field_text',
			'sb_sendmail',
			'sendmail_section_noofposts',
			[ 'id' => 'no-of-posts']
		);
	}
}