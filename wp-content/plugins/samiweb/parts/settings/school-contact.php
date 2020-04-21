<?php
/*
Title: Thông tin liên hệ
Setting: sami-settings
Order: 10
Tab: Thông tin liên hệ
Flow: Setting Workflow
Capability: administrator
*/

piklist('field', array(
	'type' => 'text'
	,'field' => 'school_name'
	,'label' => 'Tên Viện'
	,'description' => "Bắt buộc phải nhập."
	,'help' => 'Nhập tên Viện'
	,'attributes' => array(
		'class' => 'regular-text'
		,'placeholder' => 'Nhập tên Viện'
	)
	,'required' => true
	)
);

piklist('field', array(
	'type' => 'text'
	,'field' => 'school_address'
	,'label' => 'Địa chỉ'
	,'description' => "Bắt buộc phải nhập.."
	,'attributes' => array(
		'class' => 'regular-text'
		,'placeholder' => 'Nhập địa chỉ văn phòng Viện'
	)
	,'required' => true
	)
);

piklist('field', array(
	'type' => 'text'
	,'field' => 'school_phone'
	,'label' => 'Điện thoại'
	,'description' => "Bắt buộc phải nhập."
	,'attributes' => array(
		'class' => 'regular-text'
		,'placeholder' => 'Nhập số điện thoại Văn phòng'
	)
	,'required' => true
	)
);

piklist('field', array(
	'type' => 'text'
	,'field' => 'school_fax'
	,'label' => 'Fax'
	,'attributes' => array(
		'class' => 'regular-text'
		,'placeholder' => 'Nhập số fax'
	)
	)
);

piklist('field', array(
	'type' => 'text'
	,'field' => 'school_email'
	,'label' => 'Email'
	,'description' => "Bắt buộc phải nhập."
	,'attributes' => array(
		'class' => 'regular-text'
		,'placeholder' => 'Nhập địa chỉ email'
	)
	,'required' => true
	,'validate' => array(
		array(
		  'type' => 'email'
		)
		,array(
		  'type' => 'email_domain'
		)
	) 	
	)
);
?>
