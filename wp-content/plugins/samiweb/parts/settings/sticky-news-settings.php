<?php
/*
Setting: sami-stickynews-settings
*/

$choice_list[''] = '';
$news_list = get_posts(array(
                  'post_type' => 'tin-tuc'
                  ,'orderby' => 'post_date', 'fields'=>array('ID', 'post_title')
                 )
               );
foreach ( $news_list as $post ) : setup_postdata( $post );
	$choice_list[$post->ID] = $post->post_title;
endforeach; 
wp_reset_postdata();

piklist('field', array(
    'type' => 'select'
    ,'field' => 'sticky_news'
    ,'label' => 'Đặt tin nổi bật'
	,'add_more' => true
    ,'attributes' => array(
      'class' => 'text'
    )
    ,'choices' => $choice_list
  ));
?>
