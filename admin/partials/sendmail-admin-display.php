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
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php

function sb_sendmail_submenu_page_content(){

    if (!current_user_can('manage_options')) return;
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
                settings_fields('sb_sendmail_options');
                do_settings_sections( 'sb_sendmail' );
                submit_button();
            ?>
        </form>
    </div>
    <?php
    
}
    
