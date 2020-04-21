<?php
/**
 * Template for display content of lesson
 *
 * @author  ThimPress
 * @version 2.0.7
 */

error_reporting(0);

global $lp_query, $wp_query;
$user          = learn_press_get_current_user();
$course        = LP()->global['course'];
$item          = LP()->global['course-item'];
$security      = wp_create_nonce( sprintf( 'complete-item-%d-%d-%d', $user->id, $course->id, $item->ID ) );
$can_view_item = $user->can( 'view-item', $item->id, $course->id );

?>
<div class="learn-press-content-item-summary">
	<?php learn_press_get_template( 'content-lesson/description.php', array() ); ?>

	<?php if ( $user->has_completed_lesson( $item->ID, $course->id ) ) { ?>
		<button class="complete-lesson-button completed" disabled="disabled"> <?php _e( 'Completed', 'eduma' ); ?></button>
	<?php } else if ( !$user->has( 'finished-course', $course->id ) && !in_array( $can_view_item, array( 'preview', 'no-required-enroll' ) ) ) { ?>

		<form method="post" name="learn-press-form-complete-lesson" class="learn-press-form">
			<input type="hidden" name="id" value="<?php echo $item->id; ?>" />
			<input type="hidden" name="course_id" value="<?php echo $course->id; ?>" />
			<input type="hidden" name="security" value="<?php echo esc_attr( $security ); ?>" />
			<input type="hidden" name="type" value="lp_lesson" />
			<input type="hidden" name="lp-ajax" value="complete-item" />

			<button class="complete-lesson-button button-complete-item button-complete-lesson"><?php echo __( 'Complete Lesson', 'eduma' ); ?></button>

		</form>
	<?php } ?>
	
	<?php //learn_press_lesson_comment_form( $item->id ); ?>
</div>
<?php LP_Assets::enqueue_script( 'learn-press-course-lesson' ); ?>

<?php LP_Assets::add_var( 'LP_Lesson_Params', wp_json_encode( $item->get_settings( $user->id, $course->id ) ), '__all' ); ?>

