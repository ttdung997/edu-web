<?php

// Show only posts and media related to logged in author
add_action('pre_get_posts', 'query_set_only_author' );
function query_set_only_author( $wp_query ) {
    global $current_user;
    $post_types = get_post_types();
	//var_dump($current_user);
	if (is_admin()){// && !current_user_can('edit_others_posts')){
		//if (!current_user_can("manage_$post_type")){
			//$wp_query->set( 'author', $current_user->ID );
		//}
		//add_filter('views_upload', 'fix_media_counts');
		foreach ($post_types as $post_type){
			add_filter("views_edit-$post_type", 'fix_post_counts');
		}
	}
}

// Fix news counts
function fix_post_counts($views) {
    global $current_user, $wp_query;
    $screen = get_current_screen();
    $post_type = $screen->post_type;
    
    //unset($views['mine']);
    $types = array(
        array( 'status' =>  NULL ),
        array( 'status' => 'publish' ),
        array( 'status' => 'draft' ),
        array( 'status' => 'pending' ),
        array( 'status' => 'trash' )
    );
    foreach( $types as $type ) {
		$no_pending_post_types = array('project', 'publication', 'conference', 'seminar', 'syllabus', 'student',
										'mau-don','timkiem', 'bieu-mau', 'dethi', 'diemthi', 'document', 'page', 'alumni', 'phd', 'master');
		$query = array();
		if (current_user_can("manage_$post_type")){
			$query = array(
				'post_type'   => $post_type,
				'post_status' => $type['status']
			);		
		}
		else{
			$query = array(
				'author'      => $current_user->ID,
				'post_type'   => $post_type,
				'post_status' => $type['status']
			);
		}
        $result = new WP_Query($query);
        if( $type['status'] == NULL ):
            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
            $views['all'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url("edit.php?post_type=$post_type"),
            $class,
            $result->found_posts,
            __('Tất cả')
        );
        elseif( $type['status'] == 'publish' ):
            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
            $views['publish'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url("edit.php?post_status=publish&post_type=$post_type"),
            $class,
            $result->found_posts,
            __('Đã đăng')
        );
        elseif( $type['status'] == 'draft' ):
            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
            $views['draft'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url("edit.php?post_status=draft&post_type=$post_type"),
            $class,
            $result->found_posts,
            __('Bản nháp')
        );
        elseif(( $type['status'] == 'pending') && (!in_array($post_type, $no_pending_post_types))):
            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
            $views['pending'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url("edit.php?post_status=pending&post_type=$post_type"),
            $class,
            $result->found_posts,
            __('Đang chờ duyệt')
        );
        elseif( $type['status'] == 'trash' ):
            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
            $views['trash'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url("edit.php?post_status=trash&post_type=$post_type"),
            $class,
            $result->found_posts,
            __('Thùng rác')
        );
        endif;
    }
    return $views;
}



// Fix news counts
function fix_news_counts($views) {
    global $current_user, $wp_query;
    unset($views['mine']);
    $types = array(
        array( 'status' =>  NULL ),
        array( 'status' => 'publish' ),
        array( 'status' => 'draft' ),
        array( 'status' => 'pending' ),
        array( 'status' => 'trash' )
    );
    foreach( $types as $type ) {
        $query = array(
            'author'      => $current_user->ID,
            'post_type'   => 'tin-tuc',
            'post_status' => $type['status']
        );
        $result = new WP_Query($query);
        if( $type['status'] == NULL ):
            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
            $views['all'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_type=tin-tuc'),
            $class,
            $result->found_posts,
            __('Tất cả tin')
        );
        elseif( $type['status'] == 'publish' ):
            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
            $views['publish'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=publish&post_type=tin-tuc'),
            $class,
            $result->found_posts,
            __('Đã đăng')
        );
        elseif( $type['status'] == 'draft' ):
            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
            $views['draft'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=draft&post_type=tin-tuc'),
            $class,
            $result->found_posts,
            __('Bản nháp')
        );
        elseif( $type['status'] == 'pending' ):
            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
            $views['pending'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=pending&post_type=tin-tuc'),
            $class,
            $result->found_posts,
            __('Đang chờ duyệt')
        );
        elseif( $type['status'] == 'trash' ):
            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
            $views['trash'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=trash&post_type=tin-tuc'),
            $class,
            $result->found_posts,
            __('Thùng rác')
        );
        endif;
    }
    return $views;
}

// Fix notification counts
function fix_notification_counts($views) {
    global $current_user, $wp_query;
    unset($views['mine']);
    $types = array(
        array( 'status' =>  NULL ),
        array( 'status' => 'publish' ),
        array( 'status' => 'draft' ),
        array( 'status' => 'pending' ),
        array( 'status' => 'trash' )
    );
    foreach( $types as $type ) {
        $query = array(
            'author'      => $current_user->ID,
            'post_type'   => 'thong-bao',
            'post_status' => $type['status']
        );
        $result = new WP_Query($query);
        if( $type['status'] == NULL ):
            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
            $views['all'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_type=thong-bao'),
            $class,
            $result->found_posts,
            __('Tất cả tin')
        );
        elseif( $type['status'] == 'publish' ):
            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
            $views['publish'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=publish&post_type=thong-bao'),
            $class,
            $result->found_posts,
            __('Đã đăng')
        );
        elseif( $type['status'] == 'draft' ):
            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
            $views['draft'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=draft&post_type=thong-bao'),
            $class,
            $result->found_posts,
            __('Bản nháp')
        );
        elseif( $type['status'] == 'pending' ):
            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
            $views['pending'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=pending&post_type=thong-bao'),
            $class,
            $result->found_posts,
            __('Đang chờ duyệt')
        );
        elseif( $type['status'] == 'trash' ):
            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
            $views['trash'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=trash&post_type=thong-bao'),
            $class,
            $result->found_posts,
            __('Thùng rác')
        );
        endif;
    }
    return $views;
}

// Fix document counts
function fix_document_counts($views) {
    global $current_user, $wp_query;
    unset($views['mine']);
    $types = array(
        array( 'status' =>  NULL ),
        array( 'status' => 'publish' ),
        array( 'status' => 'draft' ),
        array( 'status' => 'pending' ),
        array( 'status' => 'trash' )
    );
    foreach( $types as $type ) {
        $query = array(
            'author'      => $current_user->ID,
            'post_type'   => 'document',
            'post_status' => $type['status']
        );
        $result = new WP_Query($query);
        if( $type['status'] == NULL ):
            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
            $views['all'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_type=document'),
            $class,
            $result->found_posts,
            __('Tất cả')
        );
        elseif( $type['status'] == 'publish' ):
            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
            $views['publish'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=publish&post_type=document'),
            $class,
            $result->found_posts,
            __('Đã đăng')
        );
        elseif( $type['status'] == 'draft' ):
            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
            $views['draft'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=draft&post_type=document'),
            $class,
            $result->found_posts,
            __('Bản nháp')
        );
        elseif( $type['status'] == 'pending' ):
            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
            $views['pending'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=pending&post_type=document'),
            $class,
            $result->found_posts,
            __('Đang chờ duyệt')
        );
        elseif( $type['status'] == 'trash' ):
            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
            $views['trash'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=trash&post_type=document'),
            $class,
            $result->found_posts,
            __('Thùng rác')
        );
        endif;
    }
    return $views;
}

// Fix publication counts
function fix_publication_counts($views) {
    global $current_user, $wp_query;
    unset($views['mine']);
    $types = array(
        array( 'status' =>  NULL ),
        array( 'status' => 'publish' ),
        array( 'status' => 'draft' ),
        array( 'status' => 'pending' ),
        array( 'status' => 'trash' )
    );
    foreach( $types as $type ) {
        $query = array(
            'author'      => $current_user->ID,
            'post_type'   => 'publication',
            'post_status' => $type['status']
        );
        $result = new WP_Query($query);
        if( $type['status'] == NULL ):
            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
            $views['all'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_type=publication'),
            $class,
            $result->found_posts,
            __('Tất cả')
        );
        elseif( $type['status'] == 'publish' ):
            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
            $views['publish'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=publish&post_type=publication'),
            $class,
            $result->found_posts,
            __('Đã đăng')
        );
        elseif( $type['status'] == 'draft' ):
            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
            $views['draft'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=draft&post_type=publication'),
            $class,
            $result->found_posts,
            __('Bản nháp')
        );
        elseif( $type['status'] == 'pending' ):
            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
            $views['pending'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=pending&post_type=publication'),
            $class,
            $result->found_posts,
            __('Đang chờ duyệt')
        );
        elseif( $type['status'] == 'trash' ):
            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
            $views['trash'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=trash&post_type=publication'),
            $class,
            $result->found_posts,
            __('Thùng rác')
        );
        endif;
    }
    return $views;
}

// Fix conference counts
function fix_conference_counts($views) {
    global $current_user, $wp_query;
    unset($views['mine']);
    $types = array(
        array( 'status' =>  NULL ),
        array( 'status' => 'publish' ),
        array( 'status' => 'draft' ),
        array( 'status' => 'pending' ),
        array( 'status' => 'trash' )
    );
    foreach( $types as $type ) {
        $query = array(
            'author'      => $current_user->ID,
            'post_type'   => 'conference',
            'post_status' => $type['status']
        );
        $result = new WP_Query($query);
        if( $type['status'] == NULL ):
            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
            $views['all'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_type=conference'),
            $class,
            $result->found_posts,
            __('Tất cả')
        );
        elseif( $type['status'] == 'publish' ):
            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
            $views['publish'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=publish&post_type=conference'),
            $class,
            $result->found_posts,
            __('Đã đăng')
        );
        elseif( $type['status'] == 'draft' ):
            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
            $views['draft'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=draft&post_type=conference'),
            $class,
            $result->found_posts,
            __('Bản nháp')
        );
        elseif( $type['status'] == 'pending' ):
            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
            $views['pending'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=pending&post_type=conference'),
            $class,
            $result->found_posts,
            __('Đang chờ duyệt')
        );
        elseif( $type['status'] == 'trash' ):
            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
            $views['trash'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=trash&post_type=conference'),
            $class,
            $result->found_posts,
            __('Thùng rác')
        );
        endif;
    }
    return $views;
}

// Fix project counts
function fix_project_counts($views) {
    global $current_user, $wp_query;
    unset($views['mine']);
    $types = array(
        array( 'status' =>  NULL ),
        array( 'status' => 'publish' ),
        array( 'status' => 'draft' ),
        array( 'status' => 'pending' ),
        array( 'status' => 'trash' )
    );
    foreach( $types as $type ) {
        $query = array(
            'author'      => $current_user->ID,
            'post_type'   => 'project',
            'post_status' => $type['status']
        );
        $result = new WP_Query($query);
        if( $type['status'] == NULL ):
            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
            $views['all'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_type=project'),
            $class,
            $result->found_posts,
            __('Tất cả')
        );
        elseif( $type['status'] == 'publish' ):
            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
            $views['publish'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=publish&post_type=project'),
            $class,
            $result->found_posts,
            __('Đã đăng')
        );
        elseif( $type['status'] == 'draft' ):
            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
            $views['draft'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=draft&post_type=project'),
            $class,
            $result->found_posts,
            __('Bản nháp')
        );
        elseif( $type['status'] == 'pending' ):
            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
            $views['pending'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=pending&post_type=project'),
            $class,
            $result->found_posts,
            __('Đang chờ duyệt')
        );
        elseif( $type['status'] == 'trash' ):
            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
            $views['trash'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=trash&post_type=project'),
            $class,
            $result->found_posts,
            __('Thùng rác')
        );
        endif;
    }
    return $views;
}

// Fix seminar counts
function fix_seminar_counts($views) {
    global $current_user, $wp_query;
    unset($views['mine']);
    $types = array(
        array( 'status' =>  NULL ),
        array( 'status' => 'publish' ),
        array( 'status' => 'draft' ),
        array( 'status' => 'pending' ),
        array( 'status' => 'trash' )
    );
    foreach( $types as $type ) {
        $query = array(
            'author'      => $current_user->ID,
            'post_type'   => 'seminar',
            'post_status' => $type['status']
        );
        $result = new WP_Query($query);
        if( $type['status'] == NULL ):
            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
            $views['all'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_type=seminar'),
            $class,
            $result->found_posts,
            __('Tất cả')
        );
        elseif( $type['status'] == 'publish' ):
            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
            $views['publish'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=publish&post_type=seminar'),
            $class,
            $result->found_posts,
            __('Đã đăng')
        );
        elseif( $type['status'] == 'draft' ):
            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
            $views['draft'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=draft&post_type=seminar'),
            $class,
            $result->found_posts,
            __('Bản nháp')
        );
        elseif( $type['status'] == 'pending' ):
            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
            $views['pending'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=pending&post_type=seminar'),
            $class,
            $result->found_posts,
            __('Đang chờ duyệt')
        );
        elseif( $type['status'] == 'trash' ):
            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
            $views['trash'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=trash&post_type=seminar'),
            $class,
            $result->found_posts,
            __('Thùng rác')
        );
        endif;
    }
    return $views;
}

// Fix event counts
function fix_event_counts($views) {
    global $current_user, $wp_query;
    unset($views['mine']);
    $types = array(
        array( 'status' =>  NULL ),
        array( 'status' => 'publish' ),
        array( 'status' => 'draft' ),
        array( 'status' => 'pending' ),
        array( 'status' => 'trash' )
    );
    foreach( $types as $type ) {
        $query = array(
            'author'      => $current_user->ID,
            'post_type'   => 'event',
            'post_status' => $type['status']
        );
        $result = new WP_Query($query);
        if( $type['status'] == NULL ):
            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
            $views['all'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_type=event'),
            $class,
            $result->found_posts,
            __('Tất cả')
        );
        elseif( $type['status'] == 'publish' ):
            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
            $views['publish'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=publish&post_type=event'),
            $class,
            $result->found_posts,
            __('Đã đăng')
        );
        elseif( $type['status'] == 'draft' ):
            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
            $views['draft'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=draft&post_type=event'),
            $class,
            $result->found_posts,
            __('Bản nháp')
        );
        elseif( $type['status'] == 'pending' ):
            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
            $views['pending'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=pending&post_type=event'),
            $class,
            $result->found_posts,
            __('Đang chờ duyệt')
        );
        elseif( $type['status'] == 'trash' ):
            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
            $views['trash'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=trash&post_type=event'),
            $class,
            $result->found_posts,
            __('Thùng rác')
        );
        endif;
    }
    return $views;
}

// Fix student counts
function fix_student_counts($views) {
    global $current_user, $wp_query;
    unset($views['mine']);
    $types = array(
        array( 'status' =>  NULL ),
        array( 'status' => 'publish' ),
        array( 'status' => 'draft' ),
        array( 'status' => 'pending' ),
        array( 'status' => 'trash' )
    );
    foreach( $types as $type ) {
        $query = array(
            'author'      => $current_user->ID,
            'post_type'   => 'student',
            'post_status' => $type['status']
        );
        $result = new WP_Query($query);
        if( $type['status'] == NULL ):
            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
            $views['all'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_type=student'),
            $class,
            $result->found_posts,
            __('Tất cả')
        );
        elseif( $type['status'] == 'publish' ):
            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
            $views['publish'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=publish&post_type=student'),
            $class,
            $result->found_posts,
            __('Đã đăng')
        );
        elseif( $type['status'] == 'draft' ):
            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
            $views['draft'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=draft&post_type=student'),
            $class,
            $result->found_posts,
            __('Bản nháp')
        );
        elseif( $type['status'] == 'pending' ):
            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
            $views['pending'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=pending&post_type=student'),
            $class,
            $result->found_posts,
            __('Đang chờ duyệt')
        );
        elseif( $type['status'] == 'trash' ):
            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
            $views['trash'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=trash&post_type=student'),
            $class,
            $result->found_posts,
            __('Thùng rác')
        );
        endif;
    }
    return $views;
}

// Fix syllabus counts
function fix_syllabus_counts($views) {
    global $current_user, $wp_query;
    unset($views['mine']);
    $types = array(
        array( 'status' =>  NULL ),
        array( 'status' => 'publish' ),
        array( 'status' => 'draft' ),
        array( 'status' => 'pending' ),
        array( 'status' => 'trash' )
    );
    foreach( $types as $type ) {
        $query = array(
            'author'      => $current_user->ID,
            'post_type'   => 'syllabus',
            'post_status' => $type['status']
        );
        $result = new WP_Query($query);
        if( $type['status'] == NULL ):
            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
            $views['all'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_type=syllabus'),
            $class,
            $result->found_posts,
            __('Tất cả')
        );
        elseif( $type['status'] == 'publish' ):
            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
            $views['publish'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=publish&post_type=syllabus'),
            $class,
            $result->found_posts,
            __('Đã đăng')
        );
        elseif( $type['status'] == 'draft' ):
            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
            $views['draft'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=draft&post_type=syllabus'),
            $class,
            $result->found_posts,
            __('Bản nháp')
        );
        elseif( $type['status'] == 'pending' ):
            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
            $views['pending'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=pending&post_type=syllabus'),
            $class,
            $result->found_posts,
            __('Đang chờ duyệt')
        );
        elseif( $type['status'] == 'trash' ):
            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
            $views['trash'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=trash&post_type=syllabus'),
            $class,
            $result->found_posts,
            __('Thùng rác')
        );
        endif;
    }
    return $views;
}

// Fix mau-don counts
function fix_maudon_counts($views) {
    global $current_user, $wp_query;
    unset($views['mine']);
    $types = array(
        array( 'status' =>  NULL ),
        array( 'status' => 'publish' ),
        array( 'status' => 'draft' ),
        array( 'status' => 'pending' ),
        array( 'status' => 'trash' )
    );
    foreach( $types as $type ) {
        $query = array(
            'author'      => $current_user->ID,
            'post_type'   => 'mau-don',
            'post_status' => $type['status']
        );
        $result = new WP_Query($query);
        if( $type['status'] == NULL ):
            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
            $views['all'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_type=mau-don'),
            $class,
            $result->found_posts,
            __('Tất cả')
        );
        elseif( $type['status'] == 'publish' ):
            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
            $views['publish'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=publish&post_type=mau-don'),
            $class,
            $result->found_posts,
            __('Đã đăng')
        );
        elseif( $type['status'] == 'draft' ):
            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
            $views['draft'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=draft&post_type=mau-don'),
            $class,
            $result->found_posts,
            __('Bản nháp')
        );
        elseif( $type['status'] == 'pending' ):
            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
            $views['pending'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=pending&post_type=mau-don'),
            $class,
            $result->found_posts,
            __('Đang chờ duyệt')
        );
        elseif( $type['status'] == 'trash' ):
            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
            $views['trash'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=trash&post_type=mau-don'),
            $class,
            $result->found_posts,
            __('Thùng rác')
        );
        endif;
    }
    return $views;
}

// Fix bieu-mau counts
function fix_bieumau_counts($views) {
    global $current_user, $wp_query;
    unset($views['mine']);
    $types = array(
        array( 'status' =>  NULL ),
        array( 'status' => 'publish' ),
        array( 'status' => 'draft' ),
        array( 'status' => 'pending' ),
        array( 'status' => 'trash' )
    );
    foreach( $types as $type ) {
        $query = array(
            'author'      => $current_user->ID,
            'post_type'   => 'bieu-mau',
            'post_status' => $type['status']
        );
        $result = new WP_Query($query);
        if( $type['status'] == NULL ):
            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
            $views['all'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_type=bieu-mau'),
            $class,
            $result->found_posts,
            __('Tất cả')
        );
        elseif( $type['status'] == 'publish' ):
            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
            $views['publish'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=publish&post_type=bieu-mau'),
            $class,
            $result->found_posts,
            __('Đã đăng')
        );
        elseif( $type['status'] == 'draft' ):
            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
            $views['draft'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=draft&post_type=bieu-mau'),
            $class,
            $result->found_posts,
            __('Bản nháp')
        );
        elseif( $type['status'] == 'pending' ):
            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
            $views['pending'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=pending&post_type=bieu-mau'),
            $class,
            $result->found_posts,
            __('Đang chờ duyệt')
        );
        elseif( $type['status'] == 'trash' ):
            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
            $views['trash'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=trash&post_type=bieu-mau'),
            $class,
            $result->found_posts,
            __('Thùng rác')
        );
        endif;
    }
    return $views;
}

// Fix dethi counts
function fix_dethi_counts($views) {
    global $current_user, $wp_query;
    unset($views['mine']);
    $types = array(
        array( 'status' =>  NULL ),
        array( 'status' => 'publish' ),
        array( 'status' => 'draft' ),
        array( 'status' => 'pending' ),
        array( 'status' => 'trash' )
    );
    foreach( $types as $type ) {
        $query = array(
            'author'      => $current_user->ID,
            'post_type'   => 'dethi',
            'post_status' => $type['status']
        );
        $result = new WP_Query($query);
        if( $type['status'] == NULL ):
            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
            $views['all'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_type=dethi'),
            $class,
            $result->found_posts,
            __('Tất cả')
        );
        elseif( $type['status'] == 'publish' ):
            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
            $views['publish'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=publish&post_type=dethi'),
            $class,
            $result->found_posts,
            __('Đã đăng')
        );
        elseif( $type['status'] == 'draft' ):
            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
            $views['draft'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=draft&post_type=dethi'),
            $class,
            $result->found_posts,
            __('Bản nháp')
        );
        elseif( $type['status'] == 'pending' ):
            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
            $views['pending'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=pending&post_type=dethi'),
            $class,
            $result->found_posts,
            __('Đang chờ duyệt')
        );
        elseif( $type['status'] == 'trash' ):
            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
            $views['trash'] = sprintf(
            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
            admin_url('edit.php?post_status=trash&post_type=dethi'),
            $class,
            $result->found_posts,
            __('Thùng rác')
        );
        endif;
    }
    return $views;
}

// Fix media counts
function fix_media_counts($views) {
    global $wpdb, $wp_query, $current_user, $post_mime_types, $avail_post_mime_types;
    $views = array();
	//$wp_query->set( 'author', $current_user->ID );
    $count = $wpdb->get_results( "
        SELECT post_mime_type, COUNT( * ) AS num_posts 
        FROM $wpdb->posts 
        WHERE post_type = 'attachment' 
        AND post_author = $current_user->ID 
        AND post_status != 'trash' 
        GROUP BY post_mime_type
    ", ARRAY_A );
    foreach( $count as $row )
        $_num_posts[$row['post_mime_type']] = $row['num_posts'];
    $_total_posts = array_sum($_num_posts);
    $detached = isset( $_REQUEST['detached'] ) || isset( $_REQUEST['find_detached'] );
    if ( !isset( $total_orphans ) )
        $total_orphans = $wpdb->get_var("
            SELECT COUNT( * ) 
            FROM $wpdb->posts 
            WHERE post_type = 'attachment'
            AND post_author = $current_user->ID 
            AND post_status != 'trash' 
            AND post_parent < 1
        ");
    $matches = wp_match_mime_types(array_keys($post_mime_types), array_keys($_num_posts));
    foreach ( $matches as $type => $reals )
        foreach ( $reals as $real )
            $num_posts[$type] = ( isset( $num_posts[$type] ) ) ? $num_posts[$type] + $_num_posts[$real] : $_num_posts[$real];
    $class = ( empty($_GET['post_mime_type']) && !$detached && !isset($_GET['status']) ) ? ' class="current"' : '';
    $views['all'] = "<a href='upload.php'$class>" . sprintf( __('All <span class="count">(%s)</span>', 'uploaded files' ), number_format_i18n( $_total_posts )) . '</a>';
    foreach ( $post_mime_types as $mime_type => $label ) {
        $class = '';
        if ( !wp_match_mime_types($mime_type, $avail_post_mime_types) )
            continue;
        if ( !empty($_GET['post_mime_type']) && wp_match_mime_types($mime_type, $_GET['post_mime_type']) )
            $class = ' class="current"';
        if ( !empty( $num_posts[$mime_type] ) )
            $views[$mime_type] = "<a href='upload.php?post_mime_type=$mime_type'$class>" . sprintf( translate_nooped_plural( $label[2], $num_posts[$mime_type] ), $num_posts[$mime_type] ) . '</a>';
    }
    $views['detached'] = '<a href="upload.php?detached=1"' . ( $detached ? ' class="current"' : '' ) . '>' . sprintf( __( 'Unattached <span class="count">(%s)</span>', 'detached files' ), $total_orphans ) . '</a>';
    return $views;
}

?>
