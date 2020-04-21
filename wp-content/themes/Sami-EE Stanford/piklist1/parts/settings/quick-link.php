<?php
/*
Title: Các đường link đặt vào phần Liên kết nhanh
Setting: sami-settings
Tab: URL liên kết nhanh
Tab Order: 50
Order: 5
*/

piklist('field', array(
	'type' => 'group'
	,'label' => __('Thông tin các liên kết')
	,'field' => 'quick_links'
	,'add_more' => true
	,'fields' => array(
			array(
				'type' => 'text'
				,'field' => 'quick_link_name'
				,'label' => 'Tên liên kết'
				,'description' => "Bắt buộc phải nhập."
				,'columns' => 12
				,'attributes' => array(
				 'class' => 'large-text'
				)
				,'required' => true
			)
			,array(
				'type' => 'text'
				,'field' => 'quick_link_url'
				,'label' => 'URL'
				,'description' => "Bắt buộc phải nhập."
				,'columns' => 12
				,'attributes' => array(
				 'class' => 'large-text'
				)
				,'required' => true
			)								
		)
	)
);
?>
