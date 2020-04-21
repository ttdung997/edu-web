<?php

function publication_post_type() {
	$labels = array(
		'name'               => _x( 'Bài báo khoa học', 'post type general name' ),
		'singular_name'      => _x( 'Bài báo', 'post type singular name' ),
		'add_new'            => _x( 'Thêm bài báo', 'book' ),
		'add_new_item'       => __( 'Thêm bài báo' ),
		'edit_item'          => __( 'Sửa' ),
		'new_item'           => __( 'Thêm bài báo' ),
		'all_items'          => __( 'Tất cả bài báo' ),
		'view_item'          => __( 'Xem bài báo' ),
		'search_items'       => __( 'Tìm kiếm bài báo' ),
		'not_found'          => __( 'Không tìm thấy bài báo' ),
		'not_found_in_trash' => __( 'Không tìm thấy bài báo' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Bài báo khoa học'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Thông tin các bài báo khoa học đã và đang chờ xuất bản',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title'),
		'has_archive'   => true,
	);
	register_post_type( 'publication', $args );	
}
add_action( 'init', 'publication_post_type' );

function my_taxonomies_publication() {
	$labels = array(
		'name'              => _x( 'Phân loại bài báo', 'taxonomy general name' ),
		'singular_name'     => _x( 'Phân loại bài báo', 'taxonomy singular name' ),
		'search_items'      => __( 'Tìm kiếm' ),
		'all_items'         => __( 'Các loại bài báo' ),
		'parent_item'       => __( 'Danh mục cha' ),
		'parent_item_colon' => __( 'Danh mục cha:' ),
		'edit_item'         => __( 'Sửa đổi phân loại' ), 
		'update_item'       => __( 'Cập nhật phân loại' ),
		'add_new_item'      => __( 'Thêm mới phân loại' ),
		'new_item_name'     => __( 'Thêm phân loại mới' ),
		'menu_name'         => __( 'Phân loại bài báo' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'publication-cat', 'publication', $args );
}

add_action( 'init', 'my_taxonomies_publication', 0 );
?>