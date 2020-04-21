<?php
/**
 * Template for displaying the enroll button
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 2.0.6
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$course = LP()->global['course'];

if ( !$course->is_required_enroll() ) {
	return;
}

$course_status = learn_press_get_user_course_status();
$user          = learn_press_get_current_user();
$in_cart       = learn_press_is_added_to_cart( $course->id );
// only show enroll button if user had not enrolled
$purchase_button_text = apply_filters( 'learn_press_purchase_button_text', __( 'Buy this course', 'eduma' ) );
$enroll_button_text   = apply_filters( 'learn_press_enroll_button_text', __( 'Take this course', 'eduma' ) );
$retake_button_text   = apply_filters( 'learn_press_retake_button_text', __( 'Retake', 'eduma' ) );
?>

	<?php do_action( 'learn_press_before_course_buttons', $course->id ); ?>

	<?php

	# -------------------------------
	# Finished Course
	# -------------------------------
	if ( $user->has( 'finished-course', $course->id ) ): ?>
		<?php if ( $count = $user->can( 'retake-course', $course->id ) ): ?>
			<button
				class="button button-retake-course"
				data-course_id="<?php echo esc_attr( $course->id ); ?>"
				data-security="<?php echo esc_attr( wp_create_nonce( sprintf( 'learn-press-retake-course-%d-%d', $course->id, $user->id ) ) ); ?>">
				<?php echo esc_html( sprintf( __( 'Retake course (+%d)', 'eduma' ), $count ) ); ?>
			</button>
		<?php endif; ?>
		<?php

	# -------------------------------
	# Enrolled Course
	# -------------------------------
	elseif ( $user->has( 'enrolled-course', $course->id ) ): ?>
		<?php
		$can_finish = $user->can_finish_course( $course->id );
		//if ( $can_finish ) {
		$finish_course_security = wp_create_nonce( sprintf( 'learn-press-finish-course-' . $course->id . '-' . $user->id ) );
		//} else {
		//$finish_course_security = '';
		//}
		?>
		<button
			id="learn-press-finish-course"
			class="button-finish-course<?php echo !$can_finish ? ' hide-if-js' : ''; ?>"
			data-id="<?php echo esc_attr( $course->id ); ?>"
			data-security="<?php echo esc_attr( $finish_course_security ); ?>">
			<?php esc_html_e( 'Finish course', 'eduma' ); ?>
		</button>
	<?php elseif ( $user->can( 'enroll-course', $course->id ) ) : ?>
		<form name="enroll-course" class="enroll-course form-purchase-course" method="post" enctype="multipart/form-data">
			<?php do_action( 'learn_press_before_enroll_button' ); ?>

			<input type="hidden" name="lp-ajax" value="enroll-course" />
			<input type="hidden" name="enroll-course" value="<?php echo $course->id; ?>" />
			<button class="button enroll-button thim-enroll-course-button" data-block-content="no"><?php echo $enroll_button_text; ?></button>

			<?php do_action( 'learn_press_after_enroll_button' ); ?>
		</form>
	<?php elseif ( $user->can( 'purchase-course', $course->id ) ) : ?>
		<form name="purchase-course" class="purchase-course form-purchase-course" method="post" enctype="multipart/form-data">
			<?php do_action( 'learn_press_before_purchase_button' ); ?>
			<button class="button purchase-button thim-enroll-course-button" data-block-content="no">
				<?php echo $course->is_free() ? $enroll_button_text : $purchase_button_text; ?>
			</button>
			<?php do_action( 'learn_press_after_purchase_button' ); ?>
			<input type="hidden" name="purchase-course" value="<?php echo $course->id; ?>" />
		</form>
	<?php else: ?>
		<?php $order_status = $user->get_order_status( $course->id ); ?>
		<?php if ( in_array( $order_status, array( 'lp-pending', 'lp-refunded', 'lp-cancelled', 'lp-failed' ) ) ) { ?>
			<form name="purchase-course" class="purchase-course form-purchase-course" method="post" enctype="multipart/form-data">
				<?php do_action( 'learn_press_before_purchase_button' ); ?>
				<button class="button purchase-button thim-enroll-course-button" data-block-content="no">
					<?php echo $course->is_free() ? $enroll_button_text : $purchase_button_text; ?>
				</button>
				<?php do_action( 'learn_press_after_purchase_button' ); ?>
				<input type="hidden" name="purchase-course" value="<?php echo $course->id; ?>" />
			</form>
		<?php } elseif ( in_array( $order_status, array( 'lp-processing', 'lp-on-hold' ) ) ) { ?>
			<?php learn_press_display_message( '<p>' . apply_filters( 'learn_press_user_course_pending_message', __( 'You have purchased this course. Please wait for approval.', 'eduma' ), $course, $user ) . '</p>' ); ?>
		<?php } elseif ( $order_status && $order_status != 'lp-completed' ) { ?>
			<?php learn_press_display_message( '<p>' . apply_filters( 'learn_press_user_can_not_purchase_course_message', __( 'Sorry, you can not purchase this course', 'eduma' ), $course, $user ) . '</p>' ); ?>
		<?php } ?>
	<?php endif; ?>

	<?php do_action( 'learn_press_after_course_buttons', $course->id ); ?>