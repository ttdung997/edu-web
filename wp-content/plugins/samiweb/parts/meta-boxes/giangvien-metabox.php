<?php
/*
Title: Danh sách giảng viên
Description: Danh sách giảng viên các đơn vị
Post Type: danh-sach-giang-vien
Order: 10
Collapse: false
Capability: manage_options
*/

	$lecturer_list = array();
	$lecturers= get_users(array('orderby' => 'last_name', 'order' => 'asc', 'role'         => 'lecturer'));
	foreach ($lecturers as $lecturer){
		$lecturer_list["$lecturer->ID"] = $lecturer->first_name . ' ' . $lecturer->last_name;
	}
/*
  piklist('field', array(
    'type' => 'radio'
    ,'field' => 'select_department'
    ,'label' => 'Chọn đơn vị'
    ,'choices' => piklist(
      get_terms('department', array(
        'hide_empty' => false
      ))
      ,array(
        'term_id'
        ,'name'
      )
    )
  ));
*/  
  global $post;
  $meta_value = get_post_meta($post->ID, 'select_department', true);
  //var_dump($meta_value);
  
  $users = get_objects_in_term( $meta_value, 'department' );
  //var_dump($users);
  $fields = array('ID', 'first_name', 'last_name');
  $user_list = get_users(array('include' => $users, 'fields' => 'all'));
  
  //var_dump($user_list);
  
  $lecturer_arr = array();
  foreach($user_list as $user){
		$first_name = $user->first_name;
		$last_name = $user->last_name;
		$full_name = "$first_name $last_name";
		$lecturer_arr["$user->ID"] = $full_name;
  }
  //$users = array_unique($users);
  
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'department_name'
    ,'label' => 'Tên bộ môn'
    ,'description' => "Bắt buộc phải nhập"
    ,'attributes' => array(
      'class' => 'regular-text'
      ,'placeholder' => 'Nhập tên bộ môn.'
    )
    ,'on_post_status' => array(
      'value' => 'lock'
    )
    ,'required' => true
  ));

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'select_user_acount'
    ,'add_more' => true
    ,'label' => 'Danh sách cán bộ'
    ,'description' => 'Lập danh sách cán bộ các bộ môn.'
    ,'value' => 'admin'
	,'choices' => $lecturer_list
	/*,'choices' => piklist(
	   get_users(
		 array(
		  'orderby' => 'display_name'
		  ,'order' => 'asc'
		 )
		 ,'objects'
	   )
	   ,array(
		 'ID'
		 ,'first_name last_name'
	   )
	  ) */
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));