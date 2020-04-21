<?php
/*
Title: Học hàm-Học vị
Setting: sami-settings
Tab: Học hàm-Học vị
Tab Order: 40
Order: 4
*/

piklist('field', array(
	'type' => 'group'
	,'label' => __('Học hàm')
	,'field' => 'hocham_information'
	,'add_more' => true
	,'fields' => array(
			array(
				'type' => 'text'
				,'field' => 'ten_hoc_ham'
				,'label' => 'Tên học hàm'
				,'description' => "Bắt buộc phải nhập."
				,'columns' => 6
				,'attributes' => array(
				 'class' => 'regular-text'
				)
				,'required' => true
			)	
			,array(
				'type' => 'text'
				,'field' => 'ma_hoc_ham'
				,'label' => 'Viết tắt'
				,'description' => "Bắt buộc phải nhập."
				,'columns' => 3
				,'attributes' => array(
				 'class' => 'small-text'
				)
				,'required' => true
			)									
		)
	)
);

piklist('field', array(
	'type' => 'group'
	,'label' => __('Học vị')
	,'field' => 'hocvi_information'
	,'add_more' => true
	,'fields' => array(	
			array(
				'type' => 'text'
				,'field' => 'ten_hoc_vi'
				,'label' => 'Tên học vị'
				,'description' => "Bắt buộc phải nhập."
				,'columns' => 6
				,'attributes' => array(
				 'class' => 'regular-text'
				)
				,'required' => true
			)
			,array(
				'type' => 'text'
				,'field' => 'ma_hoc_vị'
				,'label' => 'Viết tắt'
				,'description' => "Bắt buộc phải nhập."
				,'columns' => 3
				,'attributes' => array(
				 'class' => 'small-text'
				)
				,'required' => true
			)									
		)
	)
);

piklist('field', array(
	'type' => 'group'
	,'label' => __('Chức danh')
	,'field' => 'chucdanh_information'
	,'add_more' => true
	,'fields' => array(	
			array(
				'type' => 'text'
				,'field' => 'ten_chuc_danh'
				,'label' => 'Tên chức danh'
				,'description' => "Bắt buộc phải nhập."
				,'columns' => 6
				,'attributes' => array(
				 'class' => 'regular-text'
				)
				,'required' => true
			)	
			,array(
				'type' => 'text'
				,'field' => 'ma_chuc_danh'
				,'label' => 'Viết tắt'
				,'description' => "Bắt buộc phải nhập."
				,'columns' => 3
				,'attributes' => array(
				 'class' => 'small-text'
				)
				,'required' => true
			)								
		)
	)
);

piklist('field', array(
	'type' => 'group'
	,'label' => __('Danh hiệu')
	,'field' => 'danhhieu_information'
	,'add_more' => true
	,'fields' => array(	
			array(
				'type' => 'text'
				,'field' => 'ten_danh_hieu'
				,'label' => 'Tên danh hiệu'
				,'description' => "Bắt buộc phải nhập."
				,'columns' => 6
				,'attributes' => array(
				 'class' => 'regular-text'
				)
				,'required' => true
			)	
			,array(
				'type' => 'text'
				,'field' => 'ma_danh_hieu'
				,'label' => 'Viết tắt'
				,'description' => "Bắt buộc phải nhập."
				,'columns' => 3
				,'attributes' => array(
				 'class' => 'small-text'
				)
				,'required' => true
			)								
		)
	)
);
?>
