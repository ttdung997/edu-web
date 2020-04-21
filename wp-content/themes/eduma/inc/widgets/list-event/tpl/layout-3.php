<?php

$number_posts = $instance['number_posts'] ? $instance['number_posts'] : 10;
$link         = get_post_type_archive_link( 'tp_event' );
$query_args   = array(
	'post_type'           => 'tp_event',
	'posts_per_page'      => - 1,
	'post_status'         => array( 'tp-event-happenning', 'tp-event-upcoming' ),
	'ignore_sticky_posts' => true
);

$events = new WP_Query( $query_args );

$html    = array();
$sorting = array();

if ( $events->have_posts() ) {
	echo '<div class="list-event-layout-3">';
	if ( $instance['title'] ) {
		echo ent2ncr( $args['before_title'] . $instance['title'] . $args['after_title'] );
	}
	echo '<div class="thim-list-event ' . $instance['layout'] . '">';

	while ( $events->have_posts() ) {

		$events->the_post();
		$class = 'item-event thim-col-2';
		$time_format = get_option( 'time_format' );

		$time_start = tp_event_start( $time_format );
		$time_end   = tp_event_end( $time_format );

		$location   = tp_event_location();
		$date_show  = tp_event_get_time( 'd' );
		$month_show = tp_event_get_time( 'M, Y' );

		$sorting[strtotime( tp_event_get_time() )] = get_the_ID();
		ob_start();
		?>
		<div <?php post_class( $class ); ?>>
			<div class="time-from">
				<?php do_action( 'thim_before_event_time' ); ?>
				<div class="date">
					<?php echo esc_html( $date_show ); ?>
				</div>
				<div class="month">
					<?php echo esc_html( $month_show ); ?>
				</div>
				<?php do_action( 'thim_after_event_time' ); ?>
			</div>
			<div class="event-wrapper">
				<h5 class="title">
					<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>"> <?php echo get_the_title(); ?></a>
				</h5>

				<div class="location">
					<?php echo ent2ncr( $location ); ?>
				</div>
				<a class="read-more" href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>"><i class="fa fa-long-arrow-right"></i></a>
			</div>
		</div>
		<?php
		$html[ get_the_ID() ] = ob_get_contents();
		ob_end_clean();
	}

	ksort( $sorting );

	if ( ! empty( $sorting ) ) {
		$index = 1;
		foreach ( $sorting as $value ) {
			if ( $index > $number_posts ) {
				break;
			}
			if ( $html[ $value ] ) {
				echo ent2ncr( $html[ $value ] );
			}
			$index ++;
		}
	}

	if ( $instance['text_link'] != '' ) {
		echo '<a class="view-all" href="' . esc_url( $link ) . '">' . $instance['text_link'] . '</a>';
	}
	echo '</div>';
	echo '</div>'; //End div list-event-layout-3
}
wp_reset_postdata();

?>
