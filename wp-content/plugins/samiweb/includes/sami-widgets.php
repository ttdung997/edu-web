<?php
function sami_widgets_init() {
 
    // In header widget area, located to the right hand side of the header, next to the site title and description. Empty by default.
    register_sidebar( array(
        'name' => 'Homepage Left sidebar',
        'id' => 'in-header-widget-area',
        'description' => 'A widget area located to the right hand side of the header, next to the site title and description.',
        'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
 
    // Sidebar widget area, located in the sidebar. Empty by default.
    register_sidebar( array(
        'name' => 'Sidebar Widget Area',
        'id' => 'sidebar-widget-area',
        'description' => 'The sidebar widget area',
        'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    // Sidebar widget area, located in the sidebar. Empty by default.
    register_sidebar( array(
        'name' => 'News categories widget',
        'id' => 'news-categories-widget',
        'description' => 'Widget on sidebar for news categories',
        'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
	
    // Sidebar widget area, located in the sidebar. Empty by default.
    register_sidebar( array(
        'name' => 'Notification categories widget',
        'id' => 'notification-categories-widget',
        'description' => 'Widget on sidebar for notification categories',
        'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
	
    // Sidebar widget area, located in the sidebar. Empty by default.
    register_sidebar( array(
        'name' => 'Student sidebar widget',
        'id' => 'student-sidebar-widget',
        'description' => 'Widget on sidebar for student page',
        'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
	
    // Sidebar widget area, located in the sidebar. Empty by default.
    register_sidebar( array(
        'name' => 'Level 3 submenu',
        'id' => 'level_3_submenu',
        'description' => 'Submenu of level 3',
        'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
	
    // Sidebar widget area, located in the sidebar. Empty by default.
    register_sidebar( array(
        'name' => 'Alumni navigation menu widget',
        'id' => 'alumni-nav-menu',
        'description' => 'Alumni navigation menu widget',
        'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
	
    // Sidebar widget area, located in the sidebar. Empty by default.
    register_sidebar( array(
        'name' => 'Academic Tutor Menu Widget',
        'id' => 'academic-tutor-nav-menu',
        'description' => 'Academic Tutor Menu Widget',
        'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );	
	
}
add_action( 'widgets_init', 'sami_widgets_init' );
?>
