<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wisdmlabs.com
 * @since      1.0.0
 *
 * @package    Sendmail
 * @subpackage Sendmail/admin/partials
 */

use function PHPSTORM_META\type;

?>
<?php 
    function sb_sendmail_options_default() {
    return array(
        'no_of_posts' => 5
    );
}
function sendmail_callback_section_noofposts(){
    echo '<p>These settings enable you to no of posts summary sends to the subcribers</p>';
}

function sb_sendmail_callback_field_text($args) {
    $options = get_option('sb_sendmail_options', sb_sendmail_options_default());
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	
	$allowed_tags = wp_kses_allowed_html( 'post' );
	
	$value = isset( $options[$id] ) ? wp_kses( stripslashes_deep( $options[$id] ), $allowed_tags ) : '';
	
	echo '<input id="myplugin_options_'. $id .'" name="myplugin_options['. $id .']" type="number" >'. $value . '</input><br />';
}
?>