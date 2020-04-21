<?php
/*
Title: Hiển thị
Setting: sami-settings
Order: 5
Tab: Hiển thị
Flow: Setting Workflow
*/

piklist('field', array(
    'type' => 'select'
    ,'field' => 'max_tin_tuc'
    ,'label' => 'Số tin tức hiển thị ở trang chủ:'
	,'value' => 2
    ,'choices' => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10
    )
  ));
  
piklist('field', array(
    'type' => 'select'
    ,'field' => 'max_thong_bao'
    ,'label' => 'Số thông báo hiển thị ở trang chủ:'
	,'value' => 2
    ,'choices' => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10
    )
  ));  

piklist('field', array(
    'type' => 'select'
    ,'field' => 'max_seminar'
    ,'label' => 'Số seminar hiển thị ở trang chủ:'
	,'value' => 2
    ,'choices' => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10
    )
  )); 
  
piklist('field', array(
    'type' => 'select'
    ,'field' => 'max_carear'
    ,'label' => 'Số tin tuyển dụng hiển thị ở trang chủ:'
	,'value' => 2
    ,'choices' => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10
    )
  ));   
  
piklist('field', array(
    'type' => 'checkbox'
    ,'scope' => 'taxonomy'
    ,'field' => 'project_role_taxonomy'
    ,'label' => 'Liệt kê đề tài nếu vai trò là:'
    ,'description' => 'Chọn vai trò trong thực hiện đề tài để được hiển thị vào danh sách đề tài của Viện.'
    ,'choices' => piklist(
      get_terms('project_role', array(
        'hide_empty' => false
      ))
      ,array(
        'slug'
        ,'name'
      )
    )
  ));
  
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'video_url'
    ,'label' => 'URL Video ở trang chủ (Youtube)'
    ,'description' => 'URL của Video hiển thị ở trang chủ. Ví dụ: <a href="http://youtu.be/-FM7IEUg8Bw">http://youtu.be/-FM7IEUg8Bw</a>'
    ,'placeholder' => 'URL Video trang chủ'
    ,'attributes' => array(
      'class' => 'regular-text'
    )
  ));
  
  /*
  piklist('field', array(
    'type' => 'group'
    ,'field' => 'slideshow_images'
	,'add_more' => true
    ,'label' => 'Chọn ảnh slideshow  (Size: 700 x 300)'
    ,'list' => true
    ,'fields' => array(
		array(
			'type' => 'file'
			,'field' => 'slideshow_image' // Use these field to match WordPress featured images.
			,'options' => array(
			  'title' => 'Chọn ảnh  (Size: 700 x 300)'
			  ,'button' => 'Chọn ảnh (Size: 700 x 300)'
			)
			,'required' => true
		),
		array(
			'type' => 'text'
			,'field' => 'slide_title'
			,'label' => 'Tiêu đề'
			,'attributes' => array(
			  'class' => 'large-text'
			  ,'placeholder' => 'Tiêu đề slide'
			)
			,'required' => true
		 ),	 
    )
    ,'on_post_status' => array(
        'value' => 'lock'
      )
  ));
  */

piklist('field', array(
    'type' => 'group'
    ,'field' => 'slideshow_images'
    ,'label' => __('Chọn ảnh slideshow  (Size: 700 x 300)', 'sami-settings')
    ,'columns' => 12
    ,'add_more' => true
    ,'fields' => array(
      array(
        'type' => 'file'
        ,'field' => 'slideshow_image'
        ,'label' => __('Chọn ảnh  (Size: 700 x 300)', 'sami-settings')
        ,'columns' => 12
        ,'options' => array(
          'title' => __('Chọn ảnh  (Size: 700 x 300)', 'sami-settings')
          ,'modal_title' => __('Chọn ảnh  (Size: 700 x 300)', 'sami-settings')
          ,'button' => __('Chọn ảnh  (Size: 700 x 300)', 'sami-settings')
        )
      ),
  array(
    'type' => 'text'
    ,'field' => 'slide_title'
    ,'label' => 'Tiêu đề slideshow'
    ,'attributes' => array(
      'class' => 'large-text'
      ,'placeholder' => 'Tiêu đề slide'
    )
    ,'required' => true
   ),
    array(
    'type' => 'text'
    ,'field' => 'slide_describe'
    ,'label' => 'Mô tả slideshow'
    ,'attributes' => array(
      'class' => 'large-text'
      ,'placeholder' => 'Mô tả slide'
    )
   ),   
    )
  ));