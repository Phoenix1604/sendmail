<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://wisdmlabs.com
 * @since      1.0.0
 *
 * @package    Sendmail
 * @subpackage Sendmail/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Sendmail
 * @subpackage Sendmail/public
 * @author     Subhajit Bera <subhajit.bera@wisdmlabs.com>
 */
class Sendmail_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sendmail-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sendmail-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script($this->plugin_name, 'my_email_form_ajax', array('ajaxurl' => admin_url('admin-ajax.php')));

	}

	function my_form_shortcode() {
		$output = 
		'<form id="my-email-form" method="post">
        	<input type="email" name="email" placeholder="Enter your email address" required>
        	<button type="submit" name="submit">Subscribe</button>
    	</form>
		<div id="form-response"></div>';
		return $output;
	}

	function my_email_form_submit() {

		if (isset($_POST['email'])) {
			$email = sanitize_email($_POST['email']);
			$pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
			if (preg_match($pattern, $email)) {
				$subscribed_mails = get_option('sendmail_subscribed_mails', array());
				if (in_array($email, $subscribed_mails)) {
					echo json_encode(array("message" => "Already Subscribed"));
					wp_die();
				}
				$subscribed_mails[] = $email;
				update_option('sendmail_subscribed_mails', $subscribed_mails);

				include_once plugin_dir_path(__FILE__) . 'partials/sendmail-mail-to-subscriber.php';
				sb_sendmail_mailsend($email);

				echo json_encode(array("message" => "Successfully Subscribed"));
				wp_die();
			}

			echo json_encode(array("message" => "Please enter a valid email"));
			wp_die();
		}
		
		
		echo json_encode(array("response" => "Please enter a valid email"));
		wp_die();
	}
	

}
