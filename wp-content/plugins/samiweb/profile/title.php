<?php
	$user = wp_get_current_user();
	if ($_POST['user_info_hidden'] == 'Y'){
		save_extra_user_hocham_hocvi_fields($user->ID);
	}	
?>

<div class="wrap">  
    <form class="personal_profile" name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="user_info_hidden" value="Y">
		<table class="form-table">
		<tr>
			<td><h3><?php _e("Học hàm, học vị, chức danh, chức vụ", "blank"); ?></h3> </td>
		</tr>
		<tr>
		<th><label for="fullname"><?php _e("Học hàm"); ?></label></th>
		<td>
		<select name="hocham">
			<option value="None" <?php if (esc_attr( get_the_author_meta( 'hocham', $user->ID ) == "None")){echo 'selected="selected"';} ?>></option>
			<option value="GS" <?php if (esc_attr( get_the_author_meta( 'hocham', $user->ID ) == "GS")){echo 'selected="selected"';} ?>>Giáo sư</option>
			<option value="PGS" <?php if (esc_attr( get_the_author_meta( 'hocham', $user->ID ) == "PGS")){echo 'selected="selected"';} ?>>Phó giáo sư</option>
		</select>
		<!--input type="text" name="hocham" id="hocham" value="<?php echo esc_attr( get_the_author_meta( 'hocham', $user->ID ) ); ?>" class="regular-text" /--><br />
		<span class="description"><?php _e("Học hàm (GS, PGS)"); ?></span>
		</td>
		</tr>
		<tr>
		<th><label for="hocvi"><?php _e("Học vị"); ?></label></th>
		<td>
		<select name="hocvi">
			<option value="None" <?php if (esc_attr( get_the_author_meta( 'hocvi', $user->ID ) == "None")){echo 'selected="selected"';} ?>></option>
			<option value="TSKH" <?php if (esc_attr( get_the_author_meta( 'hocvi', $user->ID ) == "TSKH")){echo 'selected="selected"';} ?>>Tiến sỹ khoa học</option>
			<option value="TS" <?php if (esc_attr( get_the_author_meta( 'hocvi', $user->ID ) == "TS")){echo 'selected="selected"';} ?>>Tiến sỹ</option>
			<option value="ThS" <?php if (esc_attr( get_the_author_meta( 'hocvi', $user->ID ) == "ThS")){echo 'selected="selected"';} ?>>Thạc sỹ</option>
		</select>
		<!-- input type="text" name="hocvi" id="hocvi" value="<?php echo esc_attr( get_the_author_meta( 'hocvi', $user->ID ) ); ?>" class="regular-text" /--><br />
		<span class="description"><?php _e("Học vị (TS, ThS, KS, CN, ...)"); ?></span>
		</td>
		</tr>
		<tr>
		<th><label for="home_address"><?php _e("Chức danh"); ?></label></th>
		<td>
		<select name="chucdanh">
			<option value="None" <?php if (esc_attr( get_the_author_meta( 'chucdanh', $user->ID ) == "None")){echo 'selected="selected"';} ?>></option>
			<option value="GVCC" <?php if (esc_attr( get_the_author_meta( 'chucdanh', $user->ID ) == "GVCC")){echo 'selected="selected"';} ?>>Giảng viên cao cấp</option>
			<option value="GVC" <?php if (esc_attr( get_the_author_meta( 'chucdanh', $user->ID ) == "GVC")){echo 'selected="selected"';} ?>>Giảng viên chính</option>
			<option value="GV" <?php if (esc_attr( get_the_author_meta( 'chucdanh', $user->ID ) == "GV")){echo 'selected="selected"';} ?>>Giảng viên</option>
		</select>

		<!--input type="text" name="chucdanh" id="chucdanh" value="<?php echo esc_attr( get_the_author_meta( 'chucdanh', $user->ID ) ); ?>" class="regular-text" /--><br />
		<span class="description"><?php _e("Nhập chức danh (GVCC, GVC, GV)"); ?></span>
		</td>
		</tr>
		<tr>
		<th><label for="danhhieu"><?php _e("Danh hiệu"); ?></label></th>
		<td>
		<select name="danhhieu">
			<option value="None" <?php if (esc_attr( get_the_author_meta( 'danhhieu', $user->ID ) == "None")){echo 'selected="selected"';} ?>></option>
			<option value="NGND" <?php if (esc_attr( get_the_author_meta( 'danhhieu', $user->ID ) == "NGND")){echo 'selected="selected"';} ?>>Nhà giáo nhân dân</option>
			<option value="NGUT" <?php if (esc_attr( get_the_author_meta( 'danhhieu', $user->ID ) == "NGUT")){echo 'selected="selected"';} ?>>Nhà giáo ưu tú</option>
		</select>
		<!-- input type="text" name="danhhieu" id="danhhieu" value="<?php echo esc_attr( get_the_author_meta( 'danhhieu', $user->ID ) ); ?>" class="regular-text" /--><br />
		<span class="description"><?php _e("Nhập danh hiệu (NGND, NGƯT, ...)"); ?></span>
		</td>
		</tr>
		<tr>
		<th><label for="chucvu"><?php _e("Chức vụ"); ?></label></th>
		<td>
		<input type="text" name="chucvu" id="chucvu" value="<?php echo esc_attr( get_the_author_meta( 'chucvu', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Nhập chức vụ (Viện trưởng, viện phó, trưởng bộ môn, trưởng bộ phận, ...)"); ?></span>
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
add_action( 'personal_options_update', 'save_extra_user_hocham_hocvi_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_hocham_hocvi_fields' );

function save_extra_user_hocham_hocvi_fields( $user_id ) {

if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }

update_user_meta( $user_id, 'hocham', $_POST['hocham'] );
update_user_meta( $user_id, 'hocvi', $_POST['hocvi'] );
update_user_meta( $user_id, 'chucdanh', $_POST['chucdanh'] );
update_user_meta( $user_id, 'danhhieu', $_POST['danhhieu'] );
update_user_meta( $user_id, 'chucvu', $_POST['chucvu']);
}
?>
