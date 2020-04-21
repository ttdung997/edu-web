<?php
function custom_colors() {
   echo '<style type="text/css">
			form h4.label{
				margin-bottom: 2px;
			}
			form.contact_info input.long_text_box{
				width: 300px;
			}
			form.contact_info input.short_text_box{
				width: 200px;
			}
			#adminmenuback, #adminmenuwrap, #adminmenu, #adminmenu .wp-submenu {
				width: 220px;
			}
			#adminmenu div.separator {
				background: #aaa;
			}
			#wpwrap{
				background-color: #fff;
			}
			#wpcontent, #wpfooter {
				margin-left: 220px;
				padding-left: 20px;
			}
			#wpcontent{
				background-color: #fff;
			}
			#wpfooter{
				margin-right: 0px;
				padding-right: 20px;
				background-color: #303030;
			}
			#adminmenu  li.menu-top{
				border-bottom: 1px solid #4c4c4c !important;
			}
			#adminmenuback, #adminmenuwrap, #adminmenu{
				background-color: #303030;
			}
			#adminmenu li:hover, #adminmenu li.menu-top:hover, #adminmenu li.opensub,  #adminmenu li.opensub:hover{
			//	background-color: #303030 !important;
			}
			div.wp-menu-name{
				//font-family: Arial, "Open Sans", Arial;
				font-size: 13px;
				color: #efefef;
			}
			#adminmenu .wp-submenu{
				left: 220px;
				width: auto !important;
			}
			#adminmenu .wp-submenu a{
				//font-family: Arial, "Open Sans", Arial;
				font-size: 13px;
			}
			#adminmenu .wp-submenu li:hover{
				background-color: #474747!important;
			}
			#adminmenu .wp-submenu li a:hover{
				color: #efefef !important;
			}
			.wrap h2 {
				/*font-family: Arial, "Open Sans", sans-serif !important;*/
				font-size: 23px;
				font-weight: 100;
				padding: 9px 15px 4px 0;
				line-height: 29px;
			}
			textarea, input, select {
				font-size: inherit;
			}
			.row-title {
				font-size: 14px!important;
				font-weight: 700;
			}
			span.post-state{
				color: #fff;
				background-color: #d54e21;
				padding: 1px 5px 1px 5px;
				border-radius: 2px;
				font-size: 12px;
				font-weight: normal;
			}
			
			.row-actions {
				font-size: 12px;
			}
			#wpadminbar *{
				/*font-family: Arial !important;*/
			}
			.form-table, .form-table td, .form-table th, .form-table td p, .form-wrap label{
				font-size: 13px;
			}
			.form-table td{
				padding-left: 0px;
			}
			.postbox h3, .wp-list-table thead, .wp-list-table tfoot{
				background-color: #efefef;
			}
			.wp-list-table th{
				font-size: 13px;
			}
			*{
				/*font-family: Arial;*/
			}
			
			h2 .nav-tab{
				font-size: 13px;
				font-weight: normal;
				padding-left: 3px;
				padding-right: 3px;
			}
			
			@media (max-width: 1024px){
				h2 .nav-tab{
					font-size: 12px;
				}
			}
			span.description{
				display: block;
			}
			body.wp-admin select {
				height: 2.1em;
			}
			#_lecturer_image .attachment-preview:before{
				content: none;
			}
			.column-avatar{
				width: 65px;
			}
			
			.riv_post_thumbs img{
				border: 1px solid #ccc;
				border-radius: 4px;
			}
			.column-year, .column-avatar{
				width: 40px !important;
			}
			.ui-datepicker{width: 21em;}
			.login form .input, .login input[type=text]{font-size: 14px !important;}
		</style>';
}

add_action('admin_head', 'custom_colors');

add_action( 'admin_menu', 'remove_meta_boxes' );
function remove_meta_boxes() {
	remove_meta_box( 'project-typediv', 'project', 'side' ); // Post tags meta box
	remove_meta_box( 'project_rolediv', 'project', 'side' ); // Post tags meta box
	remove_meta_box( 'seminarsdiv', 'seminar', 'side' ); // Post tags meta box

    // Only proceed if user does not have admin role.
    if (!current_user_can('manage_options')) { 	
	remove_meta_box( 'commentsdiv', 'post', 'normal' ); // Comments meta box
	remove_meta_box( 'revisionsdiv', 'post', 'normal' ); // Revisions meta box	
	remove_meta_box( 'slugdiv', 'post', 'normal' );	// Slug meta box
	remove_meta_box( 'tagsdiv-post_tag', 'post', 'side' ); // Post tags meta box
	//remove_meta_box( 'categorydiv', 'post', 'side' ); // Category meta box
	remove_meta_box( 'postexcerpt', 'post', 'normal' ); // Excerpt meta box
	remove_meta_box( 'formatdiv', 'post', 'normal' ); // Post format meta box
	remove_meta_box( 'trackbacksdiv', 'post', 'normal' ); // Trackbacks meta box
	remove_meta_box( 'postcustom', 'post', 'normal' ); // Custom fields meta box
	remove_meta_box( 'commentstatusdiv', 'post', 'normal' ); // Comment status meta box
	remove_meta_box( 'postimagediv', 'post', 'side' ); // Featured image meta box	
	remove_meta_box( 'pageparentdiv', 'page', 'side' ); // Page attributes meta box
	}	
}

//add_filter( 'gettext', 'change_publish_button', 10, 2 );

function change_publish_button( $translation, $text ) {
	$post_type = get_post_type();
	if ( 'tin-tuc' != $post_type && 'thong-bao' != $post_type)
	if ( $text == 'Publish' )
		return 'Lưu';
		
	if ( $text == 'Submit for Review' )
		return 'Đăng để chờ duyệt';	
		
	if ( $text == 'Featured Image' )
		return 'Ảnh đại diện';

	if ( $text == 'Set featured image' )
		return 'Upload ảnh đại diện';		

	return $translation;
}

add_action('pre_get_posts', 'set_column_actions' );
function set_column_actions( $wp_query ) {
    $post_types = get_post_types();

	foreach ($post_types as $post_type){
		add_filter("manage_$post_type" . '_posts_columns', 'bs_publication_table_head');
		add_action("manage_$post_type" . '_posts_custom_column', 'posts_custom_columns', 10, 2);
	}
}
/*
add_filter('manage_publication_posts_columns', 'bs_publication_table_head');
add_filter('manage_project_posts_columns', 'bs_publication_table_head');
add_filter('manage_conference_posts_columns', 'bs_publication_table_head');
add_filter('manage_bieu-mau_posts_columns', 'bs_publication_table_head');
add_filter('manage_mau-don_posts_columns', 'bs_publication_table_head');
add_filter('manage_syllabus_posts_columns', 'bs_publication_table_head');
add_filter('manage_seminar_posts_columns', 'bs_publication_table_head');
add_filter('manage_document_posts_columns', 'bs_publication_table_head');
add_filter('manage_student_posts_columns', 'bs_publication_table_head');
add_filter('manage_diemthi_posts_columns', 'bs_publication_table_head');
add_filter('manage_dethi_posts_columns', 'bs_publication_table_head');
add_filter('manage_event_posts_columns', 'bs_publication_table_head');
add_filter('manage_tin-tuc_posts_columns', 'bs_publication_table_head');
add_filter('manage_tin-tuyen-dung_posts_columns', 'bs_publication_table_head');
add_filter('manage_thong-bao_posts_columns', 'bs_publication_table_head');
add_filter('manage_phd_posts_columns', 'bs_publication_table_head');
add_filter('manage_master_posts_columns', 'bs_publication_table_head');
add_filter('manage_alumni_posts_columns', 'bs_publication_table_head');
add_filter('manage_qa_faqs_posts_columns', 'bs_publication_table_head');
*/
 function bs_publication_table_head( $defaults ) {
	$screen = get_current_screen();
	$post_type = $screen->post_type;
	
    $defaults['author'] = 'Người đăng';
	$defaults['date'] = 'Ngày đăng';
	
	$customOrder = array();
	
	switch ($post_type){
		case 'thong-bao':
			$customOrder = array('cb', 'title', 'taxonomy-loai-thong-bao', 'author', 'date');
			$columns = $defaults;
			unset($defaults);
			foreach ($customOrder as $colname)
				$defaults[$colname] = $columns[$colname];		
		break;
		case 'tin-tuc':
			$defaults['riv_post_thumbs'] = __('Ảnh đại diện');
			break;
		case 'seminar':
			$defaults['title'] = 'Tên báo cáo';
			$defaults['date_time'] = __('Ngày giờ');
			$defaults['reporter'] = 'Người báo cáo';
			$defaults['location'] = 'Địa điểm';
			$customOrder = array('cb', 'title', 'reporter', 'date_time', 'location', 'author', 'date');
			$columns = $defaults;
			unset($defaults);
			foreach ($customOrder as $colname)
				$defaults[$colname] = $columns[$colname]; 			
			break;
		case 'event':
			$defaults['title'] = 'Tên sự kiện';
			$defaults['date_time'] = __('Ngày giờ');
			$defaults['location'] = 'Địa điểm';
			$defaults['organizer'] = 'Đơn vị  tổ chức';
			$customOrder = array('cb', 'title', 'date_time', 'location', 'organizer', 'author', 'date');
			$columns = $defaults;
			unset($defaults);
			foreach ($customOrder as $colname)
				$defaults[$colname] = $columns[$colname]; 			
		break;
		case 'project':
			$defaults['title'] = 'Tên đề tài';
			$defaults['project_year'] = 'Năm thực hiện';
			$customOrder = array('cb', 'title', 'taxonomy-project-type', 'author', 'taxonomy-project_role', 'project_year', 'date');
			$columns = $defaults;
			unset($defaults);
			foreach ($customOrder as $colname)
				$defaults[$colname] = $columns[$colname]; 
			break;
		case 'tin-tuyen-dung':
		case 'student':
		case 'alumni':
			$customOrder = array('cb', 'title', 'author', 'date');
			$columns = $defaults;
			unset($defaults);
			foreach ($customOrder as $colname)
				$defaults[$colname] = $columns[$colname]; 		
		break;
		case 'publication':
			$defaults['title'] = 'Tên bài báo';
			$defaults['journal_name'] = 'Tên tạp chí';
			$defaults['year'] = 'Năm';
			$defaults['vol_name'] = 'Số, tập, trang';
			$defaults['tac_gia'] = 'Tác giả';
			$customOrder = array('cb', 'title', 'journal_name', 'year', 'vol_name', 'tac_gia', 'author', 'date');
			$columns = $defaults;
			unset($defaults);
			foreach ($customOrder as $colname)
				$defaults[$colname] = $columns[$colname]; 			
		break;
		case 'conference':
			$defaults['title'] = 'Tên báo cáo';
			$defaults['conference_name'] = 'Tên hội nghị';
			$defaults['year'] = 'Năm';
			$defaults['location'] = 'Địa điểm';
			$defaults['page'] = 'Trang kỷ yếu';
			$defaults['tac_gia'] = 'Tác giả';
			$customOrder = array('cb', 'title', 'conference_name', 'year', 'location', 'tac_gia', 'author', 'date');
			$columns = $defaults;
			unset($defaults);
			foreach ($customOrder as $colname)
				$defaults[$colname] = $columns[$colname]; 		
		break;
		default:
			$customOrder = array('cb', 'title', 'author', 'date');
			$columns = $defaults;
			unset($defaults);
			foreach ($customOrder as $colname)
				$defaults[$colname] = $columns[$colname]; 		
		break;		
	}
    return $defaults;
 }
 
//add_filter('manage_tin-tuc_posts_columns', 'posts_columns', 10);
//add_action('manage_tin-tuc_posts_custom_column', 'tin_tuc_thumbnail_custom_columns', 10, 2);

function tin_tuc_thumbnail_custom_columns($column_name, $id){
        if($column_name === 'riv_post_thumbs'){
			//$arr = get_the_post_thumbnail('thumbnail');
			//var_dump($arr);
        echo the_post_thumbnail( array(125,80) );
    }
}

$post_types = get_post_types();
foreach ($post_types as $post_type){
	add_action("manage_$post_type" . '_posts_custom_column', 'posts_custom_columns', 10, 2);
}

//add_action('manage_seminar_posts_custom_column', 'posts_custom_columns', 10, 2);
//add_action('manage_event_posts_custom_column', 'posts_custom_columns', 10, 2);

function posts_custom_columns($column_name, $id){
	$screen = get_current_screen();
	$post_type = $screen->post_type;

	global $post;
	
	switch ($post_type){
		case 'seminar':
		case 'event':
			$date = get_post_meta($post->ID, 'SAMI_EVENTS_date', true);
			$date = (string)$date;
			$weekday = vietnameseWeekday(date("l", strtotime(str_replace('/', '-', $date))));
			$event_date = date('d', strtotime(str_replace('/', '-', $date)));
			$month_year = date('m/Y', strtotime(str_replace('/', '-', $date)));
			$event_date = date('d/m/Y', strtotime(str_replace('/', '-', $date)));
			
			$time = get_post_meta(get_the_ID(), 'SAMI_EVENTS_start_time', true);
			$hour = date ('H', strtotime($time));
			$minute = date ('i', strtotime($time));		
			
			if($column_name === 'date_time'){
				echo "$hour:$minute $event_date ($weekday)";
			}elseif ('author' == $column_name){
				echo "Hello world";
			}elseif ('reporter' == $column_name){
				$reporter = get_post_meta($post->ID, 'SAMI_SEMINAR_reporter', true);
				echo $reporter;
			}elseif ('location' == $column_name){
				$location = get_post_meta($post->ID, 'SAMI_EVENTS_location', true);
				echo $location;
			}elseif ('organizer' == $column_name){
				$organizer = get_post_meta($post->ID, 'SAMI_EVENTS_organizer_name', true);
				echo $organizer;
			}
		break;
		case 'tin-tuc':
			if($column_name === 'riv_post_thumbs'){
				echo the_post_thumbnail( array(125,80) );
			}		
		break;
		case 'project':
			$start_year = get_post_meta($post->ID, 'SAMI_PROJECTS_start_year', true);
			$end_year = get_post_meta($post->ID, 'SAMI_PROJECTS_end_year', true);
			if ('project_year' == $column_name){
				echo "$start_year - $end_year";
			}
		break;
		case 'publication':
			$journal_name = get_post_meta($post->ID, 'SAMI_PUBLICATION_journal_title', true);
			$vol_name = get_post_meta($post->ID, 'SAMI_PUBLICATION_no_vol_page', true);
			$published_year = get_post_meta($post->ID, 'SAMI_PUBLICATION_published_year', true);
			$tac_gia = get_post_meta($post->ID, 'SAMI_PUBLICATION_authors', true);
			if ('year' == $column_name){
				echo $published_year;
			}elseif ('journal_name' == $column_name){
				echo $journal_name;
			}elseif ('vol_name' == $column_name){
				echo $vol_name;
			}elseif ('tac_gia' == $column_name){
				echo $tac_gia;
			}
		break;
		case 'conference':
			$conference_name = get_post_meta($post->ID, 'SAMI_CONFERENCE_conference_title', true);
			$conference_time = get_post_meta($post->ID, 'SAMI_CONFERENCE_held_year', true);
			$location = get_post_meta($post->ID, 'SAMI_CONFERENCE_location', true);
			$page = get_post_meta($post->ID, 'SAMI_CONFERENCE_pages', true);
			$tac_gia = get_post_meta($post->ID, 'SAMI_CONFERENCE_authors', true);
			if ('conference_name' == $column_name){
				echo $conference_name;
			}elseif ('year' == $column_name){
				echo $conference_time;
			}elseif ('location' == $column_name){
				echo $location;
			}elseif ('tac_gia' == $column_name){
				echo $tac_gia;
			}elseif ('page' == $column_name){
				echo $page;
			}
		break;		
		default:
		break;
	}
}
 
 function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.plugins_url( 'images/logos/hust_logo.png', dirname(__FILE__) ).') !important; background-size: 91px 130px !important; padding-bottom:50px !important;}
    </style>';
}

add_action('login_head', 'my_custom_login_logo');

function remove_avatar_from_users_list( $avatar ) {
    if (is_admin()) {
        global $current_screen; 
        if ( $current_screen->base == 'users' ) {
            $avatar = '';
        }
    }
    return $avatar;
}
add_filter( 'get_avatar', 'remove_avatar_from_users_list' );

function change_user_avatar_col( $column ) {
    $column['avatar'] = 'Ảnh';
	$column['full_name'] = 'Họ và tên';
	//$column['birthday'] = 'Ngày sinh';
	$column['date_of_birth'] = 'Ngày sinh';
	$column['permission'] = "Quyền";
	$column['hoc-ham-hoc-vi'] = "Học hàm - Học vị";
	$customOrder = array('cb', 'avatar', 'username', 'full_name', 'date_of_birth', 'hoc-ham-hoc-vi', 'permission');
	foreach ($customOrder as $colname)
		$new[$colname] = $column[$colname]; 

    return $new;
}
add_filter( 'manage_users_columns', 'change_user_avatar_col' );

function change_user_avatar( $val, $column_name, $user_id ) {
	global $wp_roles;
	$my_user = new WP_User($user_id);
    $user = get_userdata( $user_id );
	$user_meta = get_user_meta($user_id);
	$nsize = sizeof($user_meta['lecturer_image']);
	if ($nsize > 0){
		$attachment_id=$user_meta['lecturer_image'][$nsize - 1];
	}
	//$attachment_id=$user_meta['lecturer_image'][0];
	$image_attributes = wp_get_attachment_image_src( $attachment_id ); // returns an array
	$image_url=$image_attributes[0];
	
    switch ($column_name) {
        case 'avatar' :
			if ('' != $image_url){
				return '<img src="' . $image_url . '" width="40" style="border: 1px solid #aaa; border-radius: 3px;" />'; //userphoto_thumbnail($user);
			}
        break;
		case 'birthday':
			$meta_value = get_user_meta($user_id, 'birthday', true);
			$birthday = date('d/m/Y', strtotime(str_replace('/', '-', $meta_value)));
			return $birthday;
		break;
		case 'full_name':
			$fullname = $user->first_name . ' ' . $user->last_name;
			return $fullname;
		break;
		case 'date_of_birth':
			$meta_value = get_user_meta($user_id, 'date_of_birth', false);
			$birthday = $meta_value[0];
			$b_day = $birthday['day_of_birth'];
			$b_month = $birthday['month_of_birth'];
			$b_year = $birthday['year_of_birth'];
			
			$b_str = '';
			if ('' != $b_day || '' != $b_month || '' != $b_year){
				$b_day = ('' != $b_day) ? $b_day : '--';
				$b_month = ('' != $b_month) ? $b_month : '--';
				$b_year = ('' != $b_year) ? $b_year : '----';
				$b_str = "$b_day/$b_month/$b_year";
			}
			return $b_str;
		break;
		case 'permission':
			$user_roles = $my_user->roles;
			$str_roles = '';
			foreach ($user_roles as $role){
				$role_name = $wp_roles->role_names[$role];
				//$current_role = get_role( $role );
				//var_dump($current_role);
				if ('' == $str_roles){
					$str_roles = '<a href="users.php?role=' . $role . '">' . $role_name . "</a>";
				}else{
					$str_roles = "$str_roles, ". '<a href="users.php?role=' . $role . '">' . $role_name . "</a>";
				}
			}
			return $str_roles;
			//return "Hello world";
		break;
		case 'hoc-ham-hoc-vi':
			$hocham = get_user_meta($user_id, 'select_hocham', true);
			$hocvi = get_user_meta($user_id, 'select_hocvi', true);
			$title = '';
			if ($hocham != "" && strtoupper($hocham) != "NONE"){
				$title=$title . $hocham . ". ";
			}

			if ($hocvi != "" && strtoupper($hocvi) != "NONE"){
				$title=$title . $hocvi . ". ";
			}			
			return $title;
		break;
        default:
    }
    return $return;
} 
add_filter( 'manage_users_custom_column', 'change_user_avatar', 10, 3 );

/*
 function put_my_url(){
    return ('http://daytoan.com'); // verander in de url van je website
}
add_filter('login_headerurl', 'put_my_url');
*/