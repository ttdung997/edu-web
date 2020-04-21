<?php
$link_before = $after_link = $image = $css_animation = $number = $style_width = $item_tablet = $item_mobile= '';
$pagination = ( isset($instance['show_pagination']) && $instance['show_pagination'] == 'yes' ) ? 1 : 0;
if ( !empty( $instance['title'] ) ) {
	echo ent2ncr( $args['before_title'] . $instance['title'] . $args['after_title'] );
}
if ( $instance['image'] ) {
	if ( $instance['link_target'] ) {
		$t = 'target="_blank"';
	} else {
		$t = '';
	}
	if ( $instance['number'] ) {
		$number = 'data-visible="' . $instance['number'] . '"';
	}
	if( !empty( $instance['item_tablet'] ) ) {
		$item_tablet = 'data-itemtablet="' . $instance['item_tablet'] . '"';
	}
	if( !empty( $instance['item_mobile'] ) ){
		$item_mobile = ' data-itemmobile="' . $instance['item_mobile'] . '"';
	}

	$img_id = explode( ",", $instance['image'] );
	if ( $instance['image_link'] ) {
		$img_url = explode( ",", $instance['image_link'] );
	}

	$css_animation = $instance['css_animation'];
	$css_animation = thim_getCSSAnimation( $css_animation );
	echo '<div class="thim-carousel-wrapper gallery-img ' . esc_attr( $css_animation ) . '" ' . $number . $item_tablet . $item_mobile . ' data-pagination="'. esc_attr( $pagination ). '">';
	$i = 0;
	foreach ( $img_id as $id ) {
		$src = wp_get_attachment_image_src( $id, $instance['image_size'] );
		if ( $src ) {
			$img_size = '';
			$src_size = @getimagesize( $src['0'] );
			$image    = '<img src ="' . esc_url( $src['0'] ) . '" ' . $src_size[3] . ' alt=""/>';
		}
		if ( $instance['image_link'] ) {
			$link_before = '<a ' . $t . ' href="' . esc_url( $img_url[$i] ) . '">';
			$after_link  = "</a>";
		}
		echo '<div class="item"' . $style_width . '>' . $link_before . $image . $after_link . "</div>";
		$i ++;
	}
	echo "</div>";
}