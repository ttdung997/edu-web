<?php
add_action('admin_footer', 'multiple_roles_field');
//add_action( 'register_form', 'multiple_roles_field' );
//add_action('edit_user_profile_update', 'update_user_roles'  );
add_action('profile_update', 'update_user_roles' );
add_action('user_register', 'update_user_roles' );

function multiple_roles_field($user){
	global $pagenow, $user_id;
	
	if (in_array($pagenow, array('user-edit.php', 'user-new.php'))){
	$editable_roles = get_editable_roles();
	
   if ($user_id)
   {
     $user = get_user_to_edit($user_id);
     $user_roles = array_intersect(array_values($user->roles), array_keys($editable_roles));
   }
   else
   {
     $user_roles = null;
   }	
?>
  <style type="text/css">
  
    select#role {
      //display: none !important;
    }
    
    ul.piklist-field-list li {
		border: 1px transparent solid;
		/*float: left;        /*  added  */
		min-width: 200px;   /*  added  */
	}
  
  </style>

<div class="hidden" id="role_stub">
  
  <input type="hidden" value="<?php echo $user_roles[0]; ?>" name="role"/>
  <!-- <h1>UserID = <?php echo $user_id; ?></h1> -->
  <ul class="piklist-field-list">
  <?php
  $role_num = 0;
  foreach ( $editable_roles as $role_name => $role_details ){
  ?>
  		<li <?php if (0 == $role_num){echo 'class="first-child"'; }?>>
  			<label class="piklist-field-list-item">        
        		<input id="roles_<?php echo $role_num; ?>" name="roles[0][]" value="<?php echo $role_name; ?>" class="roles" title="" alt=""		tabindex="" type="checkbox" <?php if (in_array($role_name, $user_roles)){echo 'checked="checked"';}?>>
                
          	<input id="roles_<?php echo $role_num; ?>" name="roles[0][]" value="" type="hidden">    
				<span class="piklist-list-item-label"><?php echo $role_details['name']; ?></span>
    
      	</label>  			
  		</li>
  <?php
  		$role_num = $role_num + 1;
  }
  		//var_dump($user_roles);
  ?>
  </ul>

  <script type="text/javascript">

    (function($)
    {
      $(document).ready(function()
      {
        var role_field = 'select[name="role"]';
      
        if ($(role_field).length > 0)
        {
          var stub = $('div#role_stub').html();
        
          $(stub).insertAfter(role_field);
          $(role_field).parents('.form-field').removeClass('form-field');
          $(role_field + ', div#role_stub').remove();
        }
      });
    })(jQuery);

  </script>

</div>
<?php
	}
}

function update_roles($user_id){
	global $wpdb, $wp_roles, $current_user, $pagenow;
	
	/* roles got from profile page */
	//$roles = $roles ? $roles : (isset($_POST['roles']) && isset($_POST['roles'][0]) ? $_POST['roles'][0] : false);
	$roles = (isset($_POST['roles']) && isset($_POST['roles'][0]) ? $_POST['roles'][0] : false);
	
	if ($roles && current_user_can('edit_user', $current_user->ID)){
	
		$roles = is_array($roles) ? $roles : array($roles);
	
		/* get user to be edit */   		
		$user = new WP_User($user_id);
		//$user = get_user_to_edit($user_id);
	
		/* get editable roles */
		$editable_roles = get_editable_roles();
	
		/* get current roles of this user */
		$user_roles = array_intersect(array_values($user->roles), array_keys($editable_roles));
		
		$user->remove_all_caps();
		foreach ($user_roles as $role){
			$user->remove_role($role);		
		}
			
		foreach ($roles as $role){
			$user->add_role($role);
		}
	}	
}

function update_user_roles($user_id)
{
	global $wpdb, $wp_roles, $current_user, $pagenow;

	$roles = $roles ? $roles : (isset($_POST['roles']) && isset($_POST['roles'][0]) ? $_POST['roles'][0] : false);

	if ($roles && current_user_can('edit_user', $current_user->ID))
	{      
		$editable_roles = get_editable_roles();
		$user = new WP_User($user_id);
		$user_roles = array_intersect(array_values($user->roles), array_keys($editable_roles));

		$_user_role_log = get_user_meta($user_id, $wpdb->prefix . 'capabilities_log', true);
		$user_role_log = $_user_role_log ? $_user_role_log : array();

		$roles = is_array($roles) ? $roles : array($roles);
		foreach ($roles as $role)
		{
			if (!in_array($role, $user_roles) && $wp_roles->is_role($role))
			{
				$user->add_role($role);

				array_push($user_role_log, array(
				'action' => 'add'
				,'role' => $role
				,'timestamp' => time()
				));
			}
		}

		foreach ($user_roles as $role)
		{
			if (!in_array($role, $roles) && $wp_roles->is_role($role))
			{
				$user->remove_role($role);

				array_push($user_role_log, array(
				'action' => 'remove'
				,'role' => $role
				,'timestamp' => time()
				));
			}
		}

		update_user_meta($user_id, $wpdb->prefix . 'capabilities_log', $user_role_log);
	}
}
