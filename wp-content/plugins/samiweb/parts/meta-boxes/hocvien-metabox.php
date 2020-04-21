<?php
/*
Title: Thông tin nhóm học viên
Description: this is the description
Post Type: phd
Collapse: false
*/
?>

<?php

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'student_group_name'
    ,'label' => 'Tên nhóm'
    ,'description' => 'Bắt buộc phải nhập'
    ,'help' => 'Tên nhóm'
    ,'attributes' => array(
      'class' => 'regular-text'
      ,'placeholder' => 'Tên nhóm'
    )
    ,'on_post_status' => array(
      'value' => 'lock'
    )
    ,'required' => true
  ));

  piklist('field', array(
    'type' => 'group'
    ,'field' => 'student_info'
	,'add_more' => true
    ,'label' => 'Thông tin thành viên'
    ,'fields' => array(
		array(
			'type' => 'file'
			,'field' => 'student_thumbnail_image' // Use these field to match WordPress featured images.
			,'options' => array(
			  'title' => 'Chọn ảnh đại diện'
			  ,'button' => 'Chọn ảnh đại diện'
			)
		),	
		array(
			'type' => 'text'
			,'field' => 'student_name'
			,'label' => 'Họ và tên'
			,'attributes' => array(
			  'class' => 'regular-text'
			  ,'placeholder' => 'Họ và tên'
			)
			,'required' => true
		 ),				
		array(
			'type' => 'text'
			,'field' => 'employer_name'
			,'label' => 'Chức vụ'
			,'attributes' => array(
			  'class' => 'regular-text'
			  ,'placeholder' => 'Chức vụ'
			)
			,'required' => false
		 ),
		array(
			'type' => 'editor'
			,'field' => 'supervisor_names'
			,'label' => 'Thông tin thành viên'
			,'attributes' => array(
			  'class' => 'regular-text'
			  ,'placeholder' => 'Nhập thông tin thành viên'
			)
			,'required' => false
		 ),
		array(
			'type' => 'text'
			,'field' => 'subject_img'
			,'label' => 'Link ảnh'
			,'attributes' => array(
			  'class' => 'regular-text'
			  ,'placeholder' => 'Nhập link'
			)
			
		 )		 
    )
  ));  
?>
