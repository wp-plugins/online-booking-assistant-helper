<?php

/**
 * Plugin Name: Online Booking Assistant Helper
 * Plugin URI:  http://www.onlinebookingassistant.com
 * Description: This plugin allows you to easily place the required code from your account into your wordpress powered website.
 * Author:      Gordon Drayson (Online Booking Assistant)
 * Author URI:  http://www.onlinebookingassistant.com
 * Version:     1.0
 */

add_action('admin_menu', 'obs_create_menu');
add_filter('widget_text', 'do_shortcode');
add_shortcode('OBAFirstContactSmall', 'obs_shortcode_handler');
add_shortcode('OBAFirstContactMedium', 'obs_shortcode_handler');
add_shortcode('OBAFirstContactLarge', 'obs_shortcode_handler');
add_shortcode('OBAReserveADate', 'obs_shortcode_handler');
add_shortcode('OBAFeedback', 'obs_shortcode_handler');

function obs_shortcode_handler($atts, $content, $tag) {
    return get_option($tag);
}

function obs_create_menu() {

	//create new top-level menu
	add_menu_page('Online Booking Assistant Helper', 'Online Booking Assistant', 'administrator', __FILE__, 'obs_settings_page');

	//call register settings function
	add_action( 'admin_init', 'obs_register_mysettings' );
}

function obs_register_mysettings() {
	//register our settings
	register_setting( 'obs-settings-group', 'OBAFirstContactSmall' );
	register_setting( 'obs-settings-group', 'OBAFirstContactMedium' );
	register_setting( 'obs-settings-group', 'OBAFirstContactLarge' );
	register_setting( 'obs-settings-group', 'OBAReserveADate' );
	register_setting( 'obs-settings-group', 'OBAFeedback' );
}

function obs_settings_page() {
?>
<div class="wrap">
    
<?php
echo '<img src="' . trailingslashit(plugin_dir_url(__FILE__)) . 'settings-header.png" alt="Logo" />';
?>

<h2>Online Booking Assistant Helper</h2>

<p>This plugin works exclusively with Online Booking Assistant</p>

<p>It allows you to easily place the required code from your account into your wordpress powered website. To get your own account, or to find out more, please visit: <a href="http://www.onlinebookingassistant.com" target="_blank">http://www.onlinebookingassistant.com</a></p>

<p><strong>Usage:</strong></p>
<p>Log in to your account and go to Settings > Forms (<a href="http://my.onlinebookingassistant.com/settings-forms.html" target="_blank">http://my.onlinebookingassistant.com/settings-forms.html</a>)<br />
Copy and Paste the code given into this plugin. Please note that the First Contact Code comes in Small, Medium and Large sizes.</p>

<form method="post" action="options.php">
        
<?php

settings_fields('obs-settings-group');
$style = 'width: 400px; height: 200px; padding: 5px;';
?>
    
<h2>First Contact Code<h2>

<h3>Small</h3>
<div><small>Shortcode to use: [OBAFirstContactSmall]</small></div>
<textarea style="<?php echo $style; ?>" name="OBAFirstContactSmall"><?php echo get_option('OBAFirstContactSmall'); ?></textarea>

<h3>Medium</h3>
<div><small>Shortcode to use: [OBAFirstContactMedium]</small></div>
<textarea style="<?php echo $style; ?>" name="OBAFirstContactMedium"><?php echo get_option('OBAFirstContactMedium'); ?></textarea>

<h3>Large</h3>
<div><small>Shortcode to use: [OBAFirstContactLarge]</small></div>
<textarea style="<?php echo $style; ?>" name="OBAFirstContactLarge"><?php echo get_option('OBAFirstContactLarge'); ?></textarea>

<h2>Reserve A Date Code</h2>
<div><small>Shortcode to use: [OBAReserveADate]</small></div>
<textarea style="<?php echo $style; ?>" name="OBAReserveADate"><?php echo get_option('OBAReserveADate'); ?></textarea>

<h2>Feedback Code</h2>
<div><div><small>Shortcode to use: [OBAFeedback]</small></div>
<textarea style="<?php echo $style; ?>" name="OBAFeedback"><?php echo get_option('OBAFeedback'); ?></textarea>
    
<p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>
<?php }

?>