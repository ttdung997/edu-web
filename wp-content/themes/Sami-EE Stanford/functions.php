<?php

add_theme_support( 'post-thumbnails');

require_once('wp_bootstrap_navwalker.php');

add_action( 'wp_head', 'mp6_override_toolbar_margin', 11 );
function mp6_override_toolbar_margin() {
	if ( is_admin_bar_showing() ) { ?>
		<style type="text/css" media="screen">
			html { margin-top: 0px !important; }
			* html body { margin-top: 0px !important; }
		</style>
	<?php }
}

function bybe_remove_yoast_json($data){
    $data = array();
    return $data;
  }
  add_filter('wpseo_json_ld_output', 'bybe_remove_yoast_json', 10, 1);

function addHomeMenuLink($menuItems, $args)
{
    if('top-nav-menu' == $args->theme_location) // make sure to give the right theme location for the menu
    {
		$class = 'menu-item';
        $homeMenuItem = '<li class="' . $class . '">' .
                $args->before .
                '<a href="' . home_url( '/' ) . '" title="Home">' .
				'<span class="glyphicon glyphicon-home"></span>'.
                $args->link_before .
             /* 'HOME' . //add home text if you want. */
                $args->link_after .
                '</a>' .
                $args->after .
                '</li>';
        $menuItems = $homeMenuItem . $menuItems;
    }
    return $menuItems;
}
//add_filter( 'wp_nav_menu_items', 'addHomeMenuLink', 10, 2 );

function vietnameseWeekday($w){
	switch ($w){
		case "Monday":
			return "Thứ Hai";
		case "Tuesday":
			return "Thứ Ba";
		case "Wednesday":
			return "Thứ Tư";
		case "Thursday":
			return "Thứ Năm";
		case "Friday":
			return "Thứ Sáu";
		case "Saturday":
			return "Thứ Bảy";
		case "Sunday":
			return "Chủ Nhật";
	}
}

add_filter( 'admin_head-nav-menus.php', 'wpse2770_admin_head_nav_menus' );
function wpse2770_admin_head_nav_menus()
{
    // Hijack "Pages" meta box callback with one that has an extra filter for the walker class
    $GLOBALS['wp_meta_boxes']['nav-menus']['side']['default']['add-page']['callback'] = 'wpse2770_wp_nav_menu_item_post_type_meta_box';

    // Since Walker_Nav_Menu_Checklist is not always available, we create this class in this function (didn't even know that was possible...)
    class WPSE2770_Walker_Nav_Menu_Checklist extends Walker_Nav_Menu_Checklist
    {
        public function __construct()
        {
            $this->db_fields['parent'] = 'post_parent';
            $this->db_fields['id'] = 'ID';
        }
    }

}

add_filter( 'wp_nav_menu_item_post_type_meta_box_walker', 'wpse2770_wp_nav_menu_item_post_type_meta_box_walker', 10, 3 );
function wpse2770_wp_nav_menu_item_post_type_meta_box_walker( $walker, $post_type, $context )
{
    if ( 'page' == $post_type && 'view-all' == $context ) {
        $walker = 'WPSE2770_Walker_Nav_Menu_Checklist';
    }
    return $walker;
}

function wpse2770_wp_nav_menu_item_post_type_meta_box( $object, $post_type ) {
    global $_nav_menu_placeholder, $nav_menu_selected_id;

    $post_type_name = $post_type['args']->name;

    // paginate browsing for large numbers of post objects
    $per_page = 50;
    $pagenum = isset( $_REQUEST[$post_type_name . '-tab'] ) && isset( $_REQUEST['paged'] ) ? absint( $_REQUEST['paged'] ) : 1;
    $offset = 0 < $pagenum ? $per_page * ( $pagenum - 1 ) : 0;

    $args = array(
        'offset' => $offset,
        'order' => 'ASC',
        'orderby' => 'title',
        'posts_per_page' => $per_page,
        'post_type' => $post_type_name,
        'suppress_filters' => true,
        'update_post_term_cache' => false,
        'update_post_meta_cache' => false
    );

    if ( isset( $post_type['args']->_default_query ) )
        $args = array_merge($args, (array) $post_type['args']->_default_query );

    // @todo transient caching of these results with proper invalidation on updating of a post of this type
    $get_posts = new WP_Query;
    $posts = $get_posts->query( $args );
    if ( ! $get_posts->post_count ) {
        echo '<p>' . __( 'No items.' ) . '</p>';
        return;
    }

    $post_type_object = get_post_type_object($post_type_name);

    $num_pages = $get_posts->max_num_pages;

    $page_links = paginate_links( array(
        'base' => add_query_arg(
            array(
                $post_type_name . '-tab' => 'all',
                'paged' => '%#%',
                'item-type' => 'post_type',
                'item-object' => $post_type_name,
            )
        ),
        'format' => '',
        'prev_text' => __('&laquo;'),
        'next_text' => __('&raquo;'),
        'total' => $num_pages,
        'current' => $pagenum
    ));

    if ( !$posts )
        $error = '<li id="error">'. $post_type['args']->labels->not_found .'</li>';

    $walker = 'Walker_Nav_Menu_Checklist';

    $current_tab = 'most-recent';
    if ( isset( $_REQUEST[$post_type_name . '-tab'] ) && in_array( $_REQUEST[$post_type_name . '-tab'], array('all', 'search') ) ) {
        $current_tab = $_REQUEST[$post_type_name . '-tab'];
    }

    if ( ! empty( $_REQUEST['quick-search-posttype-' . $post_type_name] ) ) {
        $current_tab = 'search';
    }

    $removed_args = array(
        'action',
        'customlink-tab',
        'edit-menu-item',
        'menu-item',
        'page-tab',
        '_wpnonce',
    );

    ?>
    <div id="posttype-<?php echo $post_type_name; ?>" class="posttypediv">
        <ul id="posttype-<?php echo $post_type_name; ?>-tabs" class="posttype-tabs add-menu-item-tabs">
            <li <?php echo ( 'most-recent' == $current_tab ? ' class="tabs"' : '' ); ?>><a class="nav-tab-link" href="<?php if ( $nav_menu_selected_id ) echo esc_url(add_query_arg($post_type_name . '-tab', 'most-recent', remove_query_arg($removed_args))); ?>#tabs-panel-posttype-<?php echo $post_type_name; ?>-most-recent"><?php _e('Most Recent'); ?></a></li>
            <li <?php echo ( 'all' == $current_tab ? ' class="tabs"' : '' ); ?>><a class="nav-tab-link" href="<?php if ( $nav_menu_selected_id ) echo esc_url(add_query_arg($post_type_name . '-tab', 'all', remove_query_arg($removed_args))); ?>#<?php echo $post_type_name; ?>-all"><?php _e('View All'); ?></a></li>
            <li <?php echo ( 'search' == $current_tab ? ' class="tabs"' : '' ); ?>><a class="nav-tab-link" href="<?php if ( $nav_menu_selected_id ) echo esc_url(add_query_arg($post_type_name . '-tab', 'search', remove_query_arg($removed_args))); ?>#tabs-panel-posttype-<?php echo $post_type_name; ?>-search"><?php _e('Search'); ?></a></li>
        </ul>

        <div id="tabs-panel-posttype-<?php echo $post_type_name; ?>-most-recent" class="tabs-panel <?php
            echo ( 'most-recent' == $current_tab ? 'tabs-panel-active' : 'tabs-panel-inactive' );
        ?>">
            <ul id="<?php echo $post_type_name; ?>checklist-most-recent" class="categorychecklist form-no-clear">
                <?php
                $recent_args = array_merge( $args, array( 'orderby' => 'post_date', 'order' => 'DESC', 'posts_per_page' => 15 ) );
                $most_recent = $get_posts->query( $recent_args );
                $args['walker'] = new $walker;
                echo walk_nav_menu_tree( array_map('wp_setup_nav_menu_item', $most_recent), 0, (object) $args );
                ?>
            </ul>
        </div><!-- /.tabs-panel -->

        <div class="tabs-panel <?php
            echo ( 'search' == $current_tab ? 'tabs-panel-active' : 'tabs-panel-inactive' );
        ?>" id="tabs-panel-posttype-<?php echo $post_type_name; ?>-search">
            <?php
            if ( isset( $_REQUEST['quick-search-posttype-' . $post_type_name] ) ) {
                $searched = esc_attr( $_REQUEST['quick-search-posttype-' . $post_type_name] );
                $search_results = get_posts( array( 's' => $searched, 'post_type' => $post_type_name, 'fields' => 'all', 'order' => 'DESC', ) );
            } else {
                $searched = '';
                $search_results = array();
            }
            ?>
            <p class="quick-search-wrap">
                <input type="text" class="quick-search input-with-default-title" title="<?php esc_attr_e('Search'); ?>" value="<?php echo $searched; ?>" name="quick-search-posttype-<?php echo $post_type_name; ?>" />
                <img class="waiting" src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" alt="" />
                <?php submit_button( __( 'Search' ), 'quick-search-submit button-secondary hide-if-js', 'submit', false ); ?>
            </p>

            <ul id="<?php echo $post_type_name; ?>-search-checklist" class="list:<?php echo $post_type_name?> categorychecklist form-no-clear">
            <?php if ( ! empty( $search_results ) && ! is_wp_error( $search_results ) ) : ?>
                <?php
                $args['walker'] = new $walker;
                echo walk_nav_menu_tree( array_map('wp_setup_nav_menu_item', $search_results), 0, (object) $args );
                ?>
            <?php elseif ( is_wp_error( $search_results ) ) : ?>
                <li><?php echo $search_results->get_error_message(); ?></li>
            <?php elseif ( ! empty( $searched ) ) : ?>
                <li><?php _e('No results found.'); ?></li>
            <?php endif; ?>
            </ul>
        </div><!-- /.tabs-panel -->


        <div id="<?php echo $post_type_name; ?>-all" class="tabs-panel tabs-panel-view-all <?php
            echo ( 'all' == $current_tab ? 'tabs-panel-active' : 'tabs-panel-inactive' );
        ?>">
            <?php if ( ! empty( $page_links ) ) : ?>
                <div class="add-menu-item-pagelinks">
                    <?php echo $page_links; ?>
                </div>
            <?php endif; ?>
            <ul id="<?php echo $post_type_name; ?>checklist" class="list:<?php echo $post_type_name?> categorychecklist form-no-clear">
                <?php
                // WPSE 2770: And this is the filter we want to add!
                $walker = apply_filters( 'wp_nav_menu_item_post_type_meta_box_walker', $walker, $post_type_name, 'view-all' );
                $args['walker'] = new $walker;

                // if we're dealing with pages, let's put a checkbox for the front page at the top of the list
                if ( 'page' == $post_type_name ) {
                    $front_page = 'page' == get_option('show_on_front') ? (int) get_option( 'page_on_front' ) : 0;
                    if ( ! empty( $front_page ) ) {
                        $front_page_obj = get_post( $front_page );
                        $front_page_obj->_add_to_top = true;
                        $front_page_obj->label = sprintf( _x('Home: %s', 'nav menu front page title'), $front_page_obj->post_title );
                        array_unshift( $posts, $front_page_obj );
                    } else {
                        $_nav_menu_placeholder = ( 0 > $_nav_menu_placeholder ) ? intval($_nav_menu_placeholder) - 1 : -1;
                        array_unshift( $posts, (object) array(
                            '_add_to_top' => true,
                            'ID' => 0,
                            'object_id' => $_nav_menu_placeholder,
                            'post_content' => '',
                            'post_excerpt' => '',
                            'post_title' => _x('Home', 'nav menu home label'),
                            'post_type' => 'nav_menu_item',
                            'type' => 'custom',
                            'url' => home_url('/'),
                        ) );
                    }
                }
$args['walker']->db_fields['parent'] = 'post_parent';
                $checkbox_items = walk_nav_menu_tree( array_map('wp_setup_nav_menu_item', $posts), 0, (object) $args );

                if ( 'all' == $current_tab && ! empty( $_REQUEST['selectall'] ) ) {
                    $checkbox_items = preg_replace('/(type=(.)checkbox(\2))/', '$1 checked=$2checked$2', $checkbox_items);

                }

                echo $checkbox_items;
                ?>
            </ul>
            <?php if ( ! empty( $page_links ) ) : ?>
                <div class="add-menu-item-pagelinks">
                    <?php echo $page_links; ?>
                </div>
            <?php endif; ?>
        </div><!-- /.tabs-panel -->


        <p class="button-controls">
            <span class="list-controls">
                <a href="<?php
                    echo esc_url(add_query_arg(
                        array(
                            $post_type_name . '-tab' => 'all',
                            'selectall' => 1,
                        ),
                        remove_query_arg($removed_args)
                    ));
                ?>#posttype-<?php echo $post_type_name; ?>" class="select-all"><?php _e('Select All'); ?></a>
            </span>

            <span class="add-to-menu">
                <img class="waiting" src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" alt="" />
                <input type="submit"<?php disabled( $nav_menu_selected_id, 0 ); ?> class="button-secondary submit-add-to-menu" value="<?php esc_attr_e('Add to Menu'); ?>" name="add-post-type-menu-item" id="submit-posttype-<?php echo $post_type_name; ?>" />
            </span>
        </p>

    </div><!-- /.posttypediv -->
    <?php
}

function enable_third_row_buttons($buttons) {
     $buttons[] = 'fontselect';
     $buttons[] = 'backcolor';
     $buttons[] = 'image';
     $buttons[] = 'media';
     $buttons[] = 'anchor';
     $buttons[] = 'sub';
     $buttons[] = 'sup';
     $buttons[] = 'hr';
	 $buttons[] = 'br';
     $buttons[] = 'wp_page';
     $buttons[] = 'cut';
     $buttons[] = 'copy';
     $buttons[] = 'paste';
     $buttons[] = 'newdocument';
     $buttons[] = 'code';
     $buttons[] = 'cleanup';
     $buttons[] = 'styleselect';

     return $buttons;
}
add_filter("mce_buttons_3", "enable_third_row_buttons");

function my_quick_edit_custom_box($column_name, $screen, $name)
{   
    //if($name != 'president' && ($column_name != 'start-date' || $column_name != 'end-date')) return false;
?>
    <fieldset>
        <div id="my-custom-content" class="inline-edit-col">
            <label>
                <span class="title"><?php if($column_name == 'start-date') _e('Start Date', 'my_plugin'); else _e('End Date', 'my_plugin'); ?></span>
                <span class="input-text-wrap"><input type="text" name="<?php echo $column_name; ?>" class="ptitle" value=""></span>
            </label>
        </div>
    </fieldset>
	
	
<?php 
}

add_action('quick_edit_custom_box', 'my_quick_edit_custom_box', 10, 3);

//require_once ('export-data/export-data.php');
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Footer semi',
        'id'   => 'footer-semi',
        'description'   => 'Đối tác',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));
}








 
//I do some other stuff later in this function that isn't important.
//For example, I define a custom taxonomy for the new post_type...


