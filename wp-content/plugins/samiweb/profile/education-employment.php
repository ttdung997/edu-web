﻿<?php
	$user = wp_get_current_user();
	if ($_POST['user_info_hidden'] == 'Y'){
		save_extra_education_employment_fields($user->ID);
	}	
?>

<div class="wrap">  
    <form class="personal_profile" name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="user_info_hidden" value="Y">
		<table class="form-table">
		<tr>
			<td><h3><?php _e("Quá trình học tập và công tác", "blank"); ?></h3> </td>
		</tr>
		<tr>
			<td>
				<!-- input type="text" name="nghiencuu" id="nghiencuu" value="<?php echo esc_attr( get_the_author_meta( 'nghiencuu', $user->ID ) ); ?>" class="regular-text" style="width: 100%"/><br / -->
			<?php
			
			    $editor_id='education_employment';
                $content=esc_attr( get_the_author_meta( 'education_employment', $user->ID ) );
				if ($content == ''){
					$content = html_entity_decode(stripcslashes(esc_attr( get_the_author_meta( 'education', $user->ID ) )));
					update_user_meta( $user->ID, 'education_employment', $content );
				}				
				$settings = array('quicktags' => true);

			    wp_editor( html_entity_decode(stripcslashes($content)), $editor_id, $settings );
			
			?>
			    <span class="description"><?php _e('Nhập quá trình học tập.'); ?></span>
			</td>
		</tr>

		<tr>
		<td>
			<p class="submit">  
			<input type="submit" name="Submit" value="<?php _e('Lưu', 'oscimp_trdom' ) ?>" class="button button-primary"/>  
			</p>  
		</td>
		</tr>
		</table>
    </form>  
</div>


<?php
add_action( 'personal_options_update', 'save_extra_education_employment_fields' );
add_action( 'edit_user_profile_update', 'save_extra_education_employment_fields' );

function save_extra_education_employment_fields( $user_id ) {

if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
update_user_meta( $user_id, 'education_employment', $_POST['education_employment'] );
}
?>
