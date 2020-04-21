<?php
	$user = wp_get_current_user();
	if ($_POST['user_info_hidden'] == 'Y'){
		save_extra_user_profile_fields($user->ID);
	}	
?>

<style type="text/css">
	.required-mark, .error-text{
		color: red;
	}
	#fullname.error-text{
		display: none;
	} 
</style>


<div class="wrap">  
    <form class="personal_profile" name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="user_info_hidden" value="Y">
		<table class="form-table">
		<tr>
			<td><h3><?php _e("Thông tin cá nhân", "blank"); ?></h3> </td>
		</tr>

<tr valign="top">
<th scope="row">Ảnh đại diện</th>
<td><label for="upload_image">
<input type="hidden" id="profile_picture_url" name="profile_picture_url" value="<?php echo esc_attr( get_the_author_meta( 'profile_picture_url', $user->ID ) ); ?>" />
<input id="upload_image" type="text" size="36" name="upload_image" value="" />
<input id="upload_image_button" type="button" value="Upload Image" />
<br />Enter an URL or upload an image for the banner.
</label></td>

</tr>
<tr>
<th>
</th>
<td>
<img id="profile_picture" src="<?php echo esc_attr( get_the_author_meta( 'profile_picture_url', $user->ID ) ); ?>" />
</td>
</tr>

		<tr>
		<th><label for="fullname"><?php _e("Họ và tên"); ?> <span class="required-mark">*</span></label></th>
		<td>
		<input type="text" name="fullname" id="fullname" value="<?php echo esc_attr( get_the_author_meta( 'fullname', $user->ID ) ); ?>" class="regular-text" /><br />
		<span id="fullname" class="error-text"><?php _e("Bạn chưa nhập họ và tên."); ?></span>
		</td>
		</tr>
		<tr>
		<th><label for="birthday"><?php _e("Ngày tháng năm sinh"); ?></label></th>
		<td>
		<input type="text" name="birthday" id="birthday" value="<?php echo esc_attr( get_the_author_meta( 'birthday', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Nhập ngày tháng năm sinh."); ?></span>
		</td>
		</tr>
		<tr>
		<th><label for="home_address"><?php _e("Địa chỉ nhà"); ?></label></th>
		<td>
		<input type="text" name="home_address" id="home_address" value="<?php echo esc_attr( get_the_author_meta( 'home_address', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Nhập địa chỉ nhà riêng."); ?></span>
		</td>
		</tr>
		<tr>
		<th><label for="mobilephone"><?php _e("Điện thoại di động"); ?></label></th>
		<td>
		<input type="text" name="mobilephone" id="mobilephone" value="<?php echo esc_attr( get_the_author_meta( 'mobilephone', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Nhập số điện thoại di động."); ?></span>
		</td>
		</tr>
		<tr>
		<th><label for="mobilephone"><?php _e("Điện thoại bàn"); ?></label></th>
		<td>
		<input type="text" name="homephone" id="homephone" value="<?php echo esc_attr( get_the_author_meta( 'homephone', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Nhập số điện thoại bàn."); ?></span>
		</td>
		</tr>
		<tr>
		<th><label for="mobilephone"><?php _e("Địa chỉ email"); ?></label></th>
		<td>
		<input type="text" name="personal_email" id="personal_email" value="<?php echo esc_attr( get_the_author_meta( 'personal_email', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Nhập địa chỉ email cá nhân"); ?></span>
		</td>
		</tr>
		<tr>
		<th><label for="mobilephone"><?php _e("Website cá nhân"); ?></label></th>
		<td>
		<input type="text" name="personal_web" id="personal_email" value="<?php echo esc_attr( get_the_author_meta( 'personal_web', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Nhập địa chỉ website cá nhân"); ?></span>
		</td>
		</tr>


		<tr>
			<td><h3><?php _e("Văn phòng", "blank"); ?></h3> </td>
		</tr>
		<tr>
		<th><label for="fullname"><?php _e("Địa chỉ"); ?></label></th>
		<td>
		<input type="text" name="office_address" id="office_address" value="<?php echo esc_attr( get_the_author_meta( 'office_address', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Nhập địa chỉ cơ quan"); ?></span>
		</td>
		</tr>
		<tr>
		<th><label for="birthday"><?php _e("Điện thoại"); ?></label></th>
		<td>
		<input type="text" name="office_phone" id="office_phone" value="<?php echo esc_attr( get_the_author_meta( 'office_phone', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Nhập số điện thoại cơ quan"); ?></span>
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
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {

$continue = 1;
if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }

if (!isset($_POST['fullname']) || (isset($_POST['fullname']) && ('' == $_POST['fullname']))){
	$continue = 0;
?>
<style type="text/css">
	#fullname.error-text{
		display: normal;
	} 
</style>	
<?php
}

if (0 == $continue){
	return false;
}
update_user_meta( $user_id, 'fullname', $_POST['fullname'] );
update_user_meta( $user_id, 'birthday', $_POST['birthday'] );
update_user_meta( $user_id, 'home_address', $_POST['home_address'] );
update_user_meta( $user_id, 'mobilephone', $_POST['mobilephone'] );

//wp_editor( $study_background,'study_background');
update_user_meta( $user_id, 'homephone', html_entity_decode($_POST['homephone']));
update_user_meta( $user_id, 'office_address', html_entity_decode($_POST['office_address']));
update_user_meta( $user_id, 'office_phone', html_entity_decode($_POST['office_phone']));
update_user_meta( $user_id, 'personal_email', html_entity_decode($_POST['personal_email']));
update_user_meta( $user_id, 'personal_web', html_entity_decode($_POST['personal_web']));
update_user_meta( $user_id, 'profile_picture_url', $_POST['profile_picture_url']);

update_usermeta( $user_id, 'pic', $_POST['pic'] );
}


?>
