<?php
/*
Title: Liên kết web
Setting: sami-settings
Tab: URL web liên kết
Tab Order: 60
Order: 6
*/

piklist('field', array(
	'type' => 'group'
	,'label' => __('Các web liên kết')
	,'field' => 'web_link_url'
	,'add_more' => true
	,'fields' => array(
			array(
				'type' => 'text'
				,'field' => 'web_link_name'
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
				,'field' => 'web_link_url'
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
