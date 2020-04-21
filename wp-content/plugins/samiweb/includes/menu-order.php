<?php
function remove_menus(){
  
  remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'edit.php' );                   //Posts
  remove_menu_page( 'edit-comments.php' );          //Comments
  //remove_menu_page( 'themes.php' );                 //Appearance
  //remove_menu_page( 'plugins.php' );                //Plugins
  //remove_menu_page( 'tools.php' );                  //Tools
  //remove_menu_page( 'options-general.php' );        //Settings
  
  
  if (!current_user_can('administrator')){
	remove_submenu_page( 'themes.php', 'themes.php' ); // hide the theme selection submenu
	remove_submenu_page( 'themes.php', 'widgets.php' ); // hide the widgets submenu
	remove_menu_page( 'options-general.php' );
	remove_menu_page( 'tools.php' ); 
	remove_menu_page( 'piklist' );
		global $submenu;
        // Appearance Menu
        unset($submenu['themes.php'][6]); // Customize

	}
  
}
add_action( 'admin_menu', 'remove_menus' );

function custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;
    return array(
      'index.php', // Dashboard
      'edit.php?post_type=tin-tuc', // Custom type one
      'edit.php?post_type=thong-bao', // Custom type two
	  'edit.php?post_type=tin-tuyen-dung', // Custom type two
      'edit.php?post_type=document', // Custom type three
      'edit.php?post_type=publication', // Custom type four
      'edit.php?post_type=conference', // Custom type five
      'edit.php?post_type=project', // Custom type five
      'separator1', // First separator
      'edit.php?post_type=seminar', // Custom type five
      'edit.php?post_type=event', // Custom type five
      'separator2',
      'edit.php?post_type=student', // Custom type five
      'edit.php?post_type=syllabus', // Custom type five
      'edit.php?post_type=mau-don', // Custom type five
      'edit.php?post_type=bieu-mau', // Custom type five
      'edit.php?post_type=dethi', // Custom type five
	  'edit.php?post_type=diemthi', // Custom type five
	  'edit.php?post_type=timkiem', // Custom type five
	  'separator2',
	  'edit.php?post_type=phd', // Custom type five
	  'edit.php?post_type=master', // Custom type five
      'separator2',
	  'edit.php?post_type=alumni', // Custom type five
	  'edit.php?post_type=danh-sach-giang-vien', // Custom type five
	  'edit.php?post_type=research', // Custom type five
	  'edit.php?post_type=qa_faqs', // Custom type five
	  'edit.php?post_type=contact-form', // Custom type five
      'edit.php?post_type=page', // Pages
	  'separator3',
      'users.php', // Users
      'edit.php', // Posts
      'upload.php', // Media
      'link-manager.php', // Links
      'edit-comments.php', // Comments
      'separator4', // Second separator
      'themes.php', // Appearance
      'plugins.php', // Plugins

      'tools.php', // Tools
      'options-general.php', // Settings
      'separator-last', // Last separator
    );
  }

  add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
  add_filter('menu_order', 'custom_menu_order');
