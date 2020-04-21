<?php
	get_header('page');
	
	$term =	$wp_query->queried_object;
	$term_name = $term->name;
	$term_id = $term->term_id;
	
	global $wp_query;
	
	$taxonomy_query = array(
				'taxonomy' => 'seminars',
				'terms' => array( $term_id),
				'operator' => 'IN'
			);
	$wp_query->set('tax_query', $taxonomy_query);
	//var_dump($wp_query);

?>
<h1>Lịch seminar</h1>
<div class="article-list">
<?php
/*
	$seminars = new WP_Query( array(
		'post_type' => 'seminar',
		'tax_query' => array(
			array(
				'taxonomy' => 'seminars',
				'terms' => array( $term_id),
				'operator' => 'IN'
			)
		),
		//'posts_per_page' => -1
	) );
*/
?>
<?php
	if ( have_posts() ){
?>
<div class="seminar_item">
	<div class="report_name"><h3 class="seminar_name"><?php echo $term_name; ?></h3></div>
<?php
	$i = 1;
		while ( have_posts() ){
			the_post();
			if ($i == 1){
				$i = 2;
			}else{
				$i = 1;
			}
			$report_title = rwmb_meta( 'SAMI_SEMINAR_report_title' );
			$date = new DateTime(rwmb_meta( 'SAMI_EVENTS_datetime' ));

			$date = get_post_meta(get_the_ID(), 'SAMI_EVENTS_date', true);
			$date = (string)$date;
			$weekday = vietnameseWeekday(date("l", strtotime(str_replace('/', '-', $date))));
			$date = date('d/m/Y', strtotime(str_replace('/', '-', $date)));
			$month_year = date('m/Y', strtotime(str_replace('/', '-', $date)));
			$event_date = date('d', strtotime(str_replace('/', '-', $date)));
			
			$time = get_post_meta(get_the_ID(), 'SAMI_EVENTS_start_time', true);
			$hour = date ('H', strtotime($time));
			$minute = date ('i', strtotime($time));
	?>
		<div class="report-item tr<?php echo $i; ?>" style="overflow: hidden;">
			<div class="date_stamp">
				<div class="date_stamp_top">
					<div class="weekday"><?php echo $weekday; ?></div>
					<div class="event_date"><?php echo $event_date; ?></div>
				</div>
				<p class="date_time_bottom"><?php echo $month_year; ?></p>
			</div>
			<div class="seminar_item_right">
				<h2 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<div class="seminar_info" style="margin-left: 17px;">
					<div><i>Bắt đầu:</i> <?php echo $hour; ?>h<?php echo $minute; ?></div>
					<div><i>Địa điểm:</i> <?php echo rwmb_meta( 'SAMI_EVENTS_location' ); ?> <a href="<?php the_permalink(); ?>">(Xem chi tiết)</a></div>
					<!-- p><i>Người báo cáo:</i> <?php echo rwmb_meta( 'SAMI_SEMINAR_reporter' ); ?></p -->
				</div>
			</div>
		</div>			
	<?php
		}
	?>
	</div>
	<?php
	// Reset things, for good measure
	$seminars = null;
	wp_reset_postdata();
}
?>	
</div>
<?php
	get_footer('page');
?>