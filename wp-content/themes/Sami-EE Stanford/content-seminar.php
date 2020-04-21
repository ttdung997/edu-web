<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Sami_EE_Stanford
 * @since Sami EE Stanford 1.0
 */

	global $post;
	
	$post_title = $post->post_title;
	$post_content = $post->post_content;
	//$date = new DateTime(rwmb_meta( 'SAMI_SEMINAR_datetime' ));

	$date = get_post_meta(get_the_ID(), 'SAMI_EVENTS_date', true);
	$date = (string)$date;
	$weekday = vietnameseWeekday(date("l", strtotime(str_replace('/', '-', $date))));
	$date = date('d/m/Y', strtotime(str_replace('/', '-', $date)));
	
	$time = get_post_meta(get_the_ID(), 'SAMI_EVENTS_start_time', true);
	$hour = date ('H', strtotime($time));
	$minute = date ('i', strtotime($time));
	
	$seminars = rwmb_meta(  'SAMI_SEMINAR_seminar_name', 'type=taxonomy&taxonomy=seminars');//'SAMI_SEMINAR_seminar_name' );
	$current_seminar = $seminars;
	$seminar_name = $current_seminar->name;
?>

<div class="seminar_schedule">
	<p><label class="event_time">Thời gian</label>: <?php echo $hour; ?>h<?php echo $minute; ?>, ngày <?php echo $date; ?> (<?php echo $weekday; ?>)</p>
	<p><label class="event_location">Địa điểm</label>: <?php echo rwmb_meta( 'SAMI_EVENTS_location' ); ?></p>
</div>
<div class="report_info">
	<p><label>Tên seminar</label>: <?php echo $seminar_name;; ?></p>
	<p><label>Người báo cáo</label>: <?php echo rwmb_meta( 'SAMI_SEMINAR_reporter' ); ?></p>
	<?php
		if (rwmb_meta( 'SAMI_SEMINAR_institute' )){
	?>
	<p><label>Đơn vị</label>: <?php echo rwmb_meta( 'SAMI_SEMINAR_institute' ); ?></p>
	<?php
		}
	?>
</div>

<?php
	if (rwmb_meta( 'SAMI_SEMINAR_report_summary' )){
?>			
<div class="report_summary">
	<h4>Tóm tắt báo cáo</h4>
	<?php echo rwmb_meta( 'SAMI_SEMINAR_report_summary' ); ?>
</div>
<?php
	}
	$files = rwmb_meta( 'SAMI_SEMINAR_file', 'type=file_advanced' );
	if (sizeof($files) > 0){
?>
<div class="post_attach_file">
<h4 style="margin-bottom: 5px;">Xem file đính kèm</h4>
<?php
	
	foreach ( $files as $info )
	{
		echo "<a href='{$info['url']}' title='{$info['title']}'>{$info['name']}</a><br />";
	}
?>
</div>
<?php
}
?>