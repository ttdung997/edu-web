<?php
/*
function posts_for_current_author

Objective: Show only current user's posts/custom posts on post lists of admin panel
   
*/
function posts_for_current_author($query) {
 global $pagenow;
 global $menu;
 
 //$query->set('posts_per_page', -1);
if ( !is_admin() && $query->is_main_query() && (is_archive() || is_tax())){
	//$query->set( 'posts_per_page', 10 );
}
	
 if( 'edit.php' != $pagenow || !$query->is_admin )
 return $query;
 
	$screen = get_current_screen();
	$post_type = $screen->post_type;

 //if( !current_user_can( 'read_others_posts' ) ) {
 if (!current_user_can("manage_$post_type")){
	global $user_ID;

	$query->set('author', $user_ID );
 }
 return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');

/*
set custom post title based on custom field of post
*/
function set_custom_post_title( $data , $postarr ) {
if($data['post_type'] == 'research') {
    $mytitle = $_POST['SAMI_RESEARCH_group_title'];//get_post_meta($postarr['ID'],'publication_title',true);
      if ($mytitle == ''){
      	   $mytitle = get_post_meta($postarr['ID'],'SAMI_RESEARCH_group_title',true);
      }
    $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
    $post_slugsan = sanitize_title($post_slug);
    
    $data['post_title'] = $mytitle;
  }
elseif($data['post_type'] == 'contact-form') {
    $mytitle = $_POST['SAMI_CONTACT_FORM_title'];//get_post_meta($postarr['ID'],'publication_title',true);
      if ($mytitle == ''){
      	   $mytitle = get_post_meta($postarr['ID'],'SAMI_CONTACT_FORM_title',true);
      }
    $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
    $post_slugsan = sanitize_title($post_slug);
    
    $data['post_title'] = $mytitle;
  }
  elseif($data['post_type'] == 'phd' || $data['post_type'] == 'master') {
    var_dump($data);
    //$mytitle = $_POST['_post_meta']['student_group_name'][0];//get_post_meta($postarr['ID'],'publication_title',true);
    $mytitle = $_POST['_post_meta']['student_group_name'];
      if ($mytitle == ''){
      	   $mytitle = get_post_meta($postarr['ID'],'_post_meta[student_group_name][0]',true);
      }
    $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
    $post_slugsan = sanitize_title($post_slug);
    
    $data['post_title'] = $mytitle;
  }
elseif($data['post_type'] == 'danh-sach-giang-vien') {
    $mytitle = $_POST['_post_meta']['department_name'][0];//get_post_meta($postarr['ID'],'publication_title',true);
      if ($mytitle == ''){
      	   $mytitle = get_post_meta($postarr['ID'],'_post_meta[department_name][0]',true);
      }
    $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
    $post_slugsan = sanitize_title($post_slug);
    
    $data['post_title'] = $mytitle;
  }elseif($data['post_type'] == 'event') {
    $mytitle = $_POST['SAMI_EVENTS_name'];//get_post_meta($postarr['ID'],'publication_title',true);
      if ($mytitle == ''){
      	   $mytitle = get_post_meta($postarr['ID'],'SAMI_EVENTS_name',true);
      }
    $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
    $post_slugsan = sanitize_title($post_slug);
    
    $data['post_title'] = $mytitle;
  }else if($data['post_type'] == 'document') {
    $mytitle = $_POST['SAMI_DOCUMENTS_title'];//get_post_meta($postarr['ID'],'publication_title',true);
      if ($mytitle == ''){
      	   $mytitle = get_post_meta($postarr['ID'],'SAMI_DOCUMENTS_title',true);
      }
    $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
    $post_slugsan = sanitize_title($post_slug);
    
    $data['post_title'] = $mytitle;
  }
  else if($data['post_type'] == 'publication') {
    $mytitle = $_POST['SAMI_PUBLICATION_publication_title'];//get_post_meta($postarr['ID'],'publication_title',true);
      if ($mytitle == ''){
      	   $mytitle = get_post_meta($postarr['ID'],'SAMI_PUBLICATION_publication_title',true);
      }
    $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
    $post_slugsan = sanitize_title($post_slug);
    
    $data['post_title'] = $mytitle;
  }else if ($data['post_type'] == 'conference'){
    $mytitle = $_POST['SAMI_CONFERENCE_report_title'];//get_post_meta($postarr['ID'],'paper_title',true);
      if ($mytitle == ''){
      	   $mytitle = get_post_meta($postarr['ID'],'SAMI_CONFERENCE_report_title',true);
      }
    $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
    $post_slugsan = sanitize_title($post_slug);
    
    $data['post_title'] = $mytitle;
  }else if ($data['post_type'] == 'book'){
    $mytitle = $_POST['SAMI_BOOK_title'];//get_post_meta($postarr['ID'],'EDUBOX_BOOK_title',true);
      if ($mytitle == ''){
      	   $mytitle = get_post_meta($postarr['ID'],'SAMI_BOOK_title',true);
      }
    $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
    $post_slugsan = sanitize_title($post_slug);
    
    $data['post_title'] = $mytitle;
  }else if ($data['post_type'] == 'seminar'){
      $mytitle = $_POST['SAMI_SEMINAR_report_title'];//get_post_meta($postarr['ID'],'EDUBOX_BOOK_title',true);
      if ($mytitle == ''){
      	   $mytitle = get_post_meta($postarr['ID'],'SAMI_SEMINAR_report_title',true);
      }
    $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
    $post_slugsan = sanitize_title($post_slug);

    var_dump($mytitle);
    
    $data['post_title'] = $mytitle;
  }else if ($data['post_type'] == 'project'){
      $mytitle = $_POST['SAMI_PROJECTS_name'];//get_post_meta($postarr['ID'],'EDUBOX_BOOK_title',true);
      if ($mytitle == ''){
      	   $mytitle = get_post_meta($postarr['ID'],'SAMI_PROJECTS_name',true);
      }
    $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
    $post_slugsan = sanitize_title($post_slug);
    
    $data['post_title'] = $mytitle;
  }else if ($data['post_type'] == 'de-tai'){
        $mytitle = $_POST['SAMI_DETAI_name'];//get_post_meta($postarr['ID'],'EDUBOX_BOOK_title',true);
        if ($mytitle == ''){
        	   $mytitle = get_post_meta($postarr['ID'],'SAMI_DETAI_name',true);
        }
    $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
    $post_slugsan = sanitize_title($post_slug);
    
    $data['post_title'] = $mytitle;
    }else if ($data['post_type'] == 'bieu-mau'){
            $mytitle = $_POST['SAMI_BIEUMAU_title'];//get_post_meta($postarr['ID'],'EDUBOX_BOOK_title',true);
            if ($mytitle == ''){
            	   $mytitle = get_post_meta($postarr['ID'],'SAMI_BIEUMAU_title',true);
            }
        $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
        $post_slugsan = sanitize_title($post_slug);
        
        $data['post_title'] = $mytitle;
    }else if ($data['post_type'] == 'mau-don'){
            $mytitle = $_POST['SAMI_MAUDON_title'];//get_post_meta($postarr['ID'],'EDUBOX_BOOK_title',true);
            if ($mytitle == ''){
            	   $mytitle = get_post_meta($postarr['ID'],'SAMI_MAUDON_title',true);
            }
        $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
        $post_slugsan = sanitize_title($post_slug);
        
        $data['post_title'] = $mytitle;
    }else if ($data['post_type'] == 'syllabus'){
            $mytitle = $_POST['SAMI_SYLLABUSES_title'];//get_post_meta($postarr['ID'],'EDUBOX_BOOK_title',true);
            if ($mytitle == ''){
            	   $mytitle = get_post_meta($postarr['ID'],'SAMI_SYLLABUSES_title',true);
            }
        $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
        $post_slugsan = sanitize_title($post_slug);
        
        $data['post_title'] = $mytitle;
    }else if ($data['post_type'] == 'research'){
            $mytitle = $_POST['SAMI_RESEARCH_group_title'];//get_post_meta($postarr['ID'],'EDUBOX_BOOK_title',true);
            if ($mytitle == ''){
            	   $mytitle = get_post_meta($postarr['ID'],'SAMI_RESEARCH_group_title',true);
            }
        $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
        $post_slugsan = sanitize_title($post_slug);
        
        $data['post_title'] = $mytitle;
    }else if ($data['post_type'] == 'dethi'){
            $mytitle = $_POST['SAMI_DETHI_title'];//get_post_meta($postarr['ID'],'EDUBOX_BOOK_title',true);
            if ($mytitle == ''){
            	   $mytitle = get_post_meta($postarr['ID'],'SAMI_DETHI_title',true);
            }
        $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
        $post_slugsan = sanitize_title($post_slug);
        
        $data['post_title'] = $mytitle;
    }else if ($data['post_type'] == 'diemthi'){
            $mytitle = $_POST['SAMI_DIEMTHI_title'];//get_post_meta($postarr['ID'],'EDUBOX_BOOK_title',true);
            if ($mytitle == ''){
            	   $mytitle = get_post_meta($postarr['ID'],'SAMI_DIEMTHI_title',true);
            }
        $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
        $post_slugsan = sanitize_title($post_slug);
        
        $data['post_title'] = $mytitle;
    }
  return $data;
}
add_action( 'wp_insert_post_data' , 'set_custom_post_title', '10', 2);


function set_custom_post_title_seminar( $data , $postarr ) {
  if ($data['post_type'] == 'seminar'){
      $mytitle = $_POST['SAMI_SEMINAR_report_title'];//get_post_meta($postarr['ID'],'EDUBOX_BOOK_title',true);
      if ($mytitle == ''){
           $mytitle = get_post_meta($postarr['ID'],'SAMI_SEMINAR_report_title',true);
      }
    $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
    $post_slugsan = sanitize_title($post_slug);
    
    $data['post_title'] = $mytitle;
    //$data['post_name'] = $post_id;
  }
  
  //$data['post_title'] = 'Hello world';
  return $data;
}

//add_action('save_post', 'tr_save_post_show_title', 12);

function tr_save_post_show_title ($post_id, $post) {
    if($post->post_type == 'seminar'){//} && !in_array($post -> post_status, array('auto-draft', 'revision', 'trash'))) {
        // don't bother if our CPT post is an auto-draft, a revision or in the trash

        $mytitle = $_POST['SAMI_SEMINAR_report_title'];//get_post_meta($postarr['ID'],'EDUBOX_BOOK_title',true);
      if ($mytitle == ''){
           $mytitle = get_post_meta($postarr['ID'],'SAMI_SEMINAR_report_title',true);
      }
      $post_slug = sanitize_title_with_dashes ($mytitle,'','save');
      $post_slugsan = sanitize_title($post_slug);

      // unhook this function so it doesn't loop infinitely
      remove_action('save_post', 'change_title');

      // update the post, which calls save_post again
      wp_update_post(array('ID' => $post_id, 'post_title' => $mytitle));

      // re-hook this function
      add_action('save_post', 'change_title');
    }
}

//add_action( 'wp_insert_post_data' , 'set_custom_post_title_seminar' );
/* 
	Change default placeholder of custom post type's title
*/
function change_default_title( $title ){
 
$screen = get_current_screen();
 
if ( 'new' == $screen->post_type ){
$title = 'Nhập tiêu đề tin vào đây';
}else if ( 'notification' == $screen->post_type ){
	$title = 'Nhập tiêu đề thông báo vào đây';
}else if ( 'student' == $screen->post_type ){
	$title = 'Nhập tiêu đề thông báo vào đây';
}
 
return $title;
}
 
//add_filter( 'enter_title_here', 'change_default_title' );
