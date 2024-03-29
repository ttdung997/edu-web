<?php
/*
Title: Thông tin các bộ phận
Setting: sami-settings
Tab: Các bộ phận
Tab Order: 20
Order: 2
*/

piklist('field', array(
	'type' => 'group'
	,'label' => __('Thông tin các Bộ phận')
	,'description' => __('When an add-more field is nested it should be grouped to maintain the data relationships.')
	,'field' => 'section_information'
	,'add_more' => true
	,'fields' => array(
			array(
				'type' => 'text'
				,'field' => 'section_name'
				,'label' => 'Tên bộ phận'
				,'description' => "Bắt buộc phải nhập."
				,'columns' => 12
				,'attributes' => array(
				 'class' => 'large-text'
				)
				,'required' => true
			)
			,array(
				'type' => 'text'
				,'field' => 'section_head'
				,'label' => 'Tên trưởng bộ phận'
				,'description' => "Bắt buộc phải nhập."
				,'columns' => 12
				,'attributes' => array(
				 'class' => 'large-text'
				)
				,'required' => true
			)
			,array(
				'type' => 'text'
				,'field' => 'email'
				,'label' => 'Email'
				,'description' => "Bắt buộc phải nhập."
				,'columns' => 12
				,'attributes' => array(
				 'class' => 'large-text'
				)
				,'required' => true
			)
			,array(
				'type' => 'text'
				,'field' => 'phone_number'
				,'label' => 'Điện thoại cơ quan'
				,'columns' => 12
				,'attributes' => array(
				 'class' => 'large-text'
				)
			)
			,array(
				'type' => 'text'
				,'field' => 'mobile_phone'
				,'label' => 'Điện thoại di động'
				,'columns' => 12
				,'attributes' => array(
				 'class' => 'large-text'
				)
			)									
		)
	)
);
?>
