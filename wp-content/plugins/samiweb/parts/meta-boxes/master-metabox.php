<?php
/*
Title: Thông tin nhóm học viên
Description: this is the description
Post Type: master
Collapse: false
*/
?>

<?php

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'student_group_name'
    ,'label' => 'Tên nhóm học viên'
    ,'description' => 'Bắt buộc phải nhập'
    ,'help' => 'Tên nhóm học viên'
    ,'attributes' => array(
      'class' => 'regular-text'
      ,'placeholder' => 'Tên nhóm học viên'
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
    ,'label' => 'Thông tin học viên'
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
			,'label' => 'Nơi công tác'
			,'attributes' => array(
			  'class' => 'regular-text'
			  ,'placeholder' => 'Đơn vị công tác'
			)
			,'required' => false
		 ),
		array(
			'type' => 'editor'
			,'field' => 'supervisor_names'
			,'label' => 'Người hướng dẫn khoa học'
			,'attributes' => array(
			  'class' => 'regular-text'
			  ,'placeholder' => 'Tên người hướng dẫn khoa học'
			)
			,'required' => false
		 ),
		array(
			'type' => 'text'
			,'field' => 'subject_title'
			,'label' => 'Tên đề tài'
			,'attributes' => array(
			  'class' => 'regular-text'
			  ,'placeholder' => 'Tên đề tài'
			)
			
		 ),
		array(
			'type' => 'file'
			,'field' => 'student_detail'
			,'label' => 'Thông tin chi tiết'
			,'options' => array(
			  'modal_title' => 'File thông tin chi tiết'
			  ,'button' => 'Chọn file'
			)
		 )		 
    )
  ));  
?>
