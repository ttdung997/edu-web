<?php
/*
Plugin Name: Simple Groups
Plugin URI: http://MyWebsiteAdvisor.com/tools/wordpress-plugins/simple-department/
Description: Simple Groups Plugin for WordPress
Version: 1.1
Author: MyWebsiteAdvisor
Author URI: http://MyWebsiteAdvisor.com
*/

class Simple_Groups{

	function __construct(){
	
		//create and register the department custom taxonomy
		add_action('init', array(&$this,'register_department_taxonomy') );
	
		//update group taxonomy when users are deleted
		add_action( 'delete_user', array(&$this,'delete_user_department_relationships') );
		

		/*
		manage department taxonomy page
		*/
		//add the department taxonomy admin page
		//add_action( 'admin_menu', array(&$this,'add_department_admin_page') );
		
		// add the user count column on the group page
		add_action( 'manage_department_custom_column', array(&$this,'manage_user_department_column'), 10, 3 );
		
		// Unsets the 'posts' column and adds a 'users' column on the manage department admin page.
		add_filter( 'manage_edit-department_columns', array(&$this,'manage_department_taxonomy_user_column') );	
		
		// tell the tax page that its (menu) parent is the users page in the admin menu
		add_filter( 'parent_file', array(&$this,'fix_department_taxonomy_page_menu') );
		
	
		/*
		users list page
		*/
		//add group memberships column to the users.php page list table
		add_filter( 'manage_users_columns',  array(&$this,'add_manage_users_columns'), 15, 1);
		add_action( 'manage_users_custom_column', array(&$this, 'user_column_data'), 15, 3);
		
		//add Groups row action link on the users page list table
		add_filter( 'user_row_actions', array(&$this,'add_users_action_row_department_link'), 10, 2 );
		
		// filter by Group
		add_action('pre_user_query', array(&$this, 'user_query'));	
		
		
		/*
		user profile/edit user page
		*/
		// Add section to the edit user page in the admin to select group.
		add_action( 'show_user_profile', array(&$this, 'edit_user_department_section'), 25);
		add_action( 'edit_user_profile', array(&$this, 'edit_user_department_section'), 25);
		//add_action('admin_footer',  array(&$this, 'edit_user_department_section'));
		
		// Update the user department when the edit user page is saved.
		add_action( 'personal_options_update', array(&$this, 'save_user_department'));
		add_action( 'edit_user_profile_update', array(&$this, 'save_user_department'));
		

		//add register shortcode functions
		add_shortcode( 'members_only', array(&$this, 'members_only_shortcode') );
		add_shortcode( 'group_access', array(&$this, 'group_access_shortcode') );
		add_shortcode( 'department_access', array(&$this, 'group_access_shortcode') );
		add_shortcode( 'public_access', array(&$this, 'public_access_shortcode') );		
		

	}
	
	

	// registers the custom 'department' taxonomy
	function register_department_taxonomy() {
	
		$labels = array(
			'name' 							=> __( 'Đơn vị' ),
			'singular_name' 				=> __( 'Đơn vị' ),
			'menu_name' 					=> __( 'Đơn vị' ),
			'search_items' 					=> __( 'Tìm đơn vị' ),
			'popular_items' 				=> __( 'Đơn vị phổ biến' ),
			'all_items' 					=> __( 'Tất cả Đơn vị' ),
			'edit_item' 					=> __( 'Sửa Đơn vị' ),
			'update_item' 					=> __( 'Cập nhật Đơn vị' ),
			'add_new_item' 					=> __( 'Thêm Đơn vị' ),
			'new_item_name' 				=> __( 'Tên Đơn vị mới' ),
			'separate_items_with_commas' 	=> __( 'Separate Groups with commas' ),
			'add_or_remove_items' 			=> __( 'Thêm/Xóa Đơn vị' ),
			'choose_from_most_used' 		=> __( 'Choose from the most popular Groups' )
		);
		
		$params = array(
			'labels' 						=> $labels,
			'public' 						=> true,
			'hierarchical'    				=> true,
			'rewrite' 						=> true,
			'capabilities' => array(
				'manage_terms' 				=> 'edit_users', // Using 'edit_users' cap to keep this simple.
				'edit_terms'  				=> 'edit_users',
				'delete_terms' 				=> 'edit_users',
				'assign_terms' 				=> 'read',
			),
			'update_count_callback' 		=> array(&$this, 'update_user_department_count') // Use a custom function to update the count.
		);
	
		 register_taxonomy(
			'department',
			'user',
			$params
		);
	}
	
	//displays department related to user in the user row, group column
	function user_column_data($value, $column_name, $user_id) {
		switch($column_name) {
			case 'department':
				return $this->get_group_tags($user_id);
			  	break;
		}
		return $value;
	}
	
	//gets list of department for a specific user (object)
	function get_department($user = '') {
		if(is_object($user)) { $user_id = $user->ID; } elseif(is_int($user*1)) { $user_id = $user*1; }
		if(empty($user)) { return false;}
		$department = wp_get_object_terms($user_id, 'department', array('fields' => 'all_with_object_id'));
		return $department;
	}
	

	//generates list of links
	function get_group_tags($user, $page = null) {
		$terms = $this->get_department($user);
		if(empty($terms)) { return false; }
		
		$in = array();
		foreach($terms as $term) {
			$link = empty($page) ? add_query_arg(array('department' => $term->slug), admin_url('users.php')) : add_query_arg(array('department' => $term->slug), $page);
			$in[] = sprintf('%s%s%s', '<a  href="'.$link.'" title="'.esc_attr($term->description).'">', $term->name, '</a>');
		}

		//return the list of department styled similarly to post categories.
	  	return implode(', ', $in);
	}
	

	
	//for the users page to filter by group
	function user_query($Query = '') {
		global $pagenow,$wpdb;

		if('users.php' !== $pagenow) return; 

		if(!empty($_GET['department'])) {

			$department = explode(',',$_GET['department']);
			$ids = array();
			foreach($department as $group) {
				$term = get_term_by('slug', esc_attr($group), 'department');
				$user_ids = get_objects_in_term($term->term_id, 'department');
				$ids = array_merge($user_ids, $ids);
			}
			$ids = implode(',', wp_parse_id_list( $user_ids ) );

			$Query->query_where .= " AND $wpdb->users.ID IN ($ids)";
		}
	}


	//create the select group for edit users page.
	function edit_user_department_section( $user ) {

		$tax = get_taxonomy( 'department' );

		/* Make sure the user can assign terms of the department taxonomy before proceeding. */
		if ( !current_user_can( $tax->cap->assign_terms ) || !current_user_can('edit_users') )
			return;

		/* Get the terms of the 'department' taxonomy. */
		$terms = get_terms( 'department', array( 'hide_empty' => false ) ); ?>

		<h3 id="department">Đơn vị</h3>
		<table class="form-table">
		<tr>
			<th>
				<label for="department" style="display:block;"><?php _e( sprintf(_n(__('Chọn đơn vị', 'user-department'), __('Chọn đơn vị', 'simple-department'), sizeof($terms)))); ?></label>
			</th>

			<td>
			<p><a href="<?php echo admin_url('edit-tags.php?taxonomy=department'); ?>"><?php _e('Quản lý Đơn vị', 'simple-department'); ?></a></p>
			
			<?php
			/* If there are any terms available, loop through them and display checkboxes. */
			if ( !empty( $terms ) ) {
			
				echo "<div style='border: 1px solid #ccc; width:90%; overflow-x:auto; overflow-y:auto; padding-left:10px; padding-right:50px;'>";
				echo '<ul>';
				foreach ( $terms as $term ) {
				?>
					<li>
					<input type="checkbox" name="department[]" id="user-group-<?php echo esc_attr( $term->slug ); ?>" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( true, is_object_in_term( $user->ID, 'department', $term->slug ) ); ?> /> 
					<label for="user-group-<?php echo esc_attr( $term->slug ); ?>"><?php echo $term->name; ?></label></li>
				<?php 
				}
				echo '</ul>';
				echo "</div>";
			}

			/* If there are no department, display a message. */
			else {
				_e('There are no department defined. <a href="'.admin_url('edit-tags.php?taxonomy=department').'">'.__('Add a Group', 'simple-department').'</a>');
			}

			?></td>
		</tr>
	</table>
<?php
	}

	
	
	//save user info after the user edit page is saved
	function save_user_department( $user_id, $department = array(), $bulk = false) {

		// Make sure the current user can edit the user before proceeding.
		if ( !current_user_can( 'edit_user', $user_id )  ) {
			return false;
		}
		
		//make sure that the current user has admin like permissions to update department, otherwise, do not edit the group membership
		if ( !current_user_can( 'manage_options', $user_id ) ){
			return false;
		}
		
		
		if(empty($department) && !$bulk) {
			$department = @$_POST['department'];
		}

		if(is_null($department) || empty($department)) {
			wp_delete_object_term_relationships( $user_id, 'department' );
		} else {

			$saved_department = array();
			foreach($department as $group) {
				$saved_department[] = esc_attr($group);
			}

			// saves the terms for the user. 
			wp_set_object_terms( $user_id, $saved_department, 'department', false);
		}

		clean_object_term_cache( $user_id, 'department' );
	}

	
	//create the manage group page
	function add_department_admin_page() {
	
		$tax = get_taxonomy( 'department' );
	
		add_users_page(
			esc_attr( $tax->labels->menu_name ),
			esc_attr( $tax->labels->menu_name ),
			$tax->cap->manage_terms,
			'edit-tags.php?taxonomy=' . $tax->name
		);
	}


	
	//update the user count for each group
	function update_user_department_count( $terms, $taxonomy ) {
		global $wpdb;

		foreach ( (array) $terms as $term ) {

			$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->term_relationships WHERE term_taxonomy_id = %d", $term ) );

			do_action( 'edit_term_taxonomy', $term, $taxonomy );
			$wpdb->update( $wpdb->term_taxonomy, compact( 'count' ), array( 'term_taxonomy_id' => $term ) );
			do_action( 'edited_term_taxonomy', $term, $taxonomy );
		}
	}
	
	
	// add group memberships column to the users.php page list table
	function add_manage_users_columns($defaults) {
		$defaults['department'] = __('Đơn vị', 'department');
		return $defaults;
	}


	// add the user count column on the group page
	function manage_user_department_column( $display, $column, $term_id ) {
	
		if ( 'user_number' === $column ) {
			$term = get_term( $term_id, 'department' );
			echo '<a href="'.admin_url('users.php?department='.$term->slug).'">'.sprintf(_n(__('%s người'), __('%s người'), $term->count), $term->count).'</a>';
		}
		
		
		return;
	}

	
	//add Groups row action link on the users page list table
	function add_users_action_row_department_link( $actions, $user_object ) {
		if ( current_user_can( 'administrator', $user_object->ID ) )
			$actions['department'] = '<a href="edit-tags.php?taxonomy=department">Đơn vị</a>';
		return $actions;
	}

	
	
	// Create custom columns for the manage department page.
	// Unsets the 'posts' column and adds a 'users' column on the manage department admin page.
	function manage_department_taxonomy_user_column( $columns ) {
		unset( $columns['posts'] );
		unset( $columns['users'] );
		unset( $columns['description'] );
		$columns['user_number'] = __( 'Số người' );
		$new_columns = array();
		$customOrder = array('cb', 'name', 'slug', 'name', 'user_number');
		foreach ($customOrder as $colname)
			$new_columns[$colname] = $columns[$colname]; 
		return $new_columns;
	}

	
	
	//update group taxonomy when users are deleted
	function delete_user_department_relationships( $user_id ) {
		wp_delete_object_term_relationships( $user_id, 'department' );
	}
	

	
	// this is a custom tax applied to a user rather than a post or page, so WP gets a bit confused.
	// this filter function tell the tax page that its parent is the users page in the admin menu
	function fix_department_taxonomy_page_menu( $parent_file = '' ) {
		global $pagenow;
	
		if (!empty($_GET['taxonomy']) && 'department' == $_GET['taxonomy']  && 'edit-tags.php' == $pagenow){
			$parent_file = 'users.php';
		}
	
		return $parent_file;
	}




	// worker function for [group_access group="name"][/group_access] shortcode.
	// worker function for [department_access department="name,name2"][/department_access] shortcode.
	function group_access_shortcode( $atts, $content = null ){
		if( is_user_logged_in() ) {
		
			if(  (isset($atts['department']) && "" !== $atts['department']) || (isset($atts['group']) && "" !== $atts['group']) ){
				
				if(isset($atts['department']))
					$atts['department'] = explode(",", $atts['department']);
				
				$user = wp_get_current_user();
				$terms = $this->get_department($user);
				if(empty($terms)) { return false; }
				
				$department = array();
				foreach($terms as $term){
					$department[] = $term->name;
				}
				
				if( (isset($atts['department']) && array_intersect($atts['department'], $department)) || (isset($atts['group']) && in_array($atts['group'], $department)) ){
					return '<span>' . do_shortcode($content) . '</span>';
				}
			}
		}
	}
	
	
	
	// worker function for [members_only][/members_only] shortcode.
	function members_only_shortcode( $atts, $content = null ){
		if(is_user_logged_in()){
			return '<span>' . do_shortcode($content) . '</span>';
		}
	}
	
	
	// worker function for [public_access][/public_access] shortcode.
	// most likely this would be used to display login and register links.
	function public_access_shortcode( $atts, $content = null ){
		if(!is_user_logged_in()){
			return '<span>' . do_shortcode($content) . '</span>';
		}
	}
	
}	// end of Simple_Groups Class




// instantiate new simple_department object
$simple_department = new Simple_Groups;



?>