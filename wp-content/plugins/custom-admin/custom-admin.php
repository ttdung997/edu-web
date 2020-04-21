<?php
/*
Plugin Name: Custom Admin
Plugin URI: http://ideatree-website-design.com/
Description: Creating a Better Looking WordPress Admin Screen
Version: 1.0
Author: Jeremy Jared
Author URI: http://ideatree-website-design.com/
*/

function hide_personal_options(){
?>
<script type="text/javascript">jQuery(document).ready(function($) {
	$('form#your-profile > h3:first').remove();//.hide();
	$('form#your-profile > table:first').remove();//.hide();
	$('form#your-profile').show(); });
</script>
<?php
}
add_action('admin_head','hide_personal_options');

! defined( 'ABSPATH' ) and exit;
 
add_action( 'personal_options', array ( 'T5_Hide_Profile_Bio_Box', 'start' ) );
 
/**
* Captures the part with the biobox in an output buffer and removes it.
*
* @author Thomas Scholz, <info@toscho.de>
*
*/
class T5_Hide_Profile_Bio_Box
{
	/**
	* Called on 'personal_options'.
	*
	* @return void
	*/
	public static function start()
	{
		$action = ( IS_PROFILE_PAGE ? 'show' : 'edit' ) . '_user_profile';
		add_action( $action, array ( __CLASS__, 'stop' ) );
		ob_start();
	}
	 
	/**
	* Strips the bio box from the buffered content.
	*
	* @return void
	*/
	public static function stop()
	{
		$html = ob_get_contents();
		ob_end_clean();
		 
		// remove the headline
		$headline = __( IS_PROFILE_PAGE ? 'About Yourself' : 'About the user' );
		$html = str_replace( '<h3>' . $headline . '</h3>', '<h3>Đổi mật khẩu</h3>', $html );
		 
		// remove the table row
		$html = preg_replace( '~<tr>\s*<th><label for="description".*</tr>~imsUu', '', $html );
		
 
		// remove the row "Display name publicly as"
		$html = preg_replace( '~<tr>\s*<th><label for="display_name".*</tr>~imsUu', '', $html );

		// remove the row "Nickname"
		$html = preg_replace( '~<tr>\s*<th><label for="nickname".*</tr>~imsUu', '', $html );
		
		// remove the row "Nickname"
		//$html = preg_replace( '~<tr>\s*<th><label for="last_name".*</tr>~imsUu', '', $html );
				
		// remove the row "Website"
		$html = preg_replace( '~<tr>\s*<th><label for="url".*</tr>~imsUu', '', $html );
		
		
		// remove the row "Contact info"
		$headline = __( 'Contact Info' );
		//$html = str_replace( '<h3>' . $headline . '</h3>', '', $html );		
					
		print $html;
	}
}

//add_filter('additional_capabilities_display', 'remove_additional_capabilities_func');
 
function remove_additional_capabilities_func()
{
    return false;
}

/* Disable default dashboard widgets */

function spiffy_disable_default_dashboard_widgets() {

	if ( !is_super_admin() ) {
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'core' );
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' );
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'core' );
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );
	}

}

add_action('admin_menu', 'spiffy_disable_default_dashboard_widgets');

// remove nickname
function prefix_hide_personal_options() {
        //if (current_user_can('manage_options')) return false;
?>
<script type="text/javascript">
  jQuery(document).ready(function( $ ){
    $("#display_name,#description").parent().parent().remove();
    $( "tr.user-profile-picture" ).remove();
  });
</script>
<?php
}
if (is_admin()) add_action('personal_options', 'prefix_hide_personal_options');
// $("#nickname,#display_name,#description").parent().parent().remove();

?>
