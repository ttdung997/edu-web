<?php
/**
 * Template for displaying content of landing course
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$course = LP()->global['course'];
$user   = learn_press_get_current_user();
$review_is_enable = thim_plugin_active( 'learnpress-course-review/learnpress-course-review.php' );
$student_list_enable = thim_plugin_active( 'learnpress-students-list/learnpress-students-list.php' );

?>

<?php do_action( 'learn_press_before_content_landing' ); ?>

<div class="course-landing-summary">

	<?php do_action( 'learn_press_content_landing_summary' ); ?>

</div>

<div id="course-landing">
	<div class="course-tabs">

		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#tab-course-description" data-toggle="tab">
					<i class="fa fa-bookmark"></i>
					<span><?php esc_html_e( 'Description', 'eduma' ); ?></span>
				</a>
			</li>
			<li role="presentation">
				<a href="#tab-course-curriculum" data-toggle="tab">
					<i class="fa fa-cube"></i>
					<span><?php esc_html_e( 'Curriculum', 'eduma' ); ?></span>
				</a>
			</li>
			<li role="presentation">
				<a href="#tab-course-instructor" data-toggle="tab">
					<i class="fa fa-user"></i>
					<span><?php esc_html_e( 'Instructors', 'eduma' ); ?></span>
				</a>
			</li>
			<?php if ( $review_is_enable ) : ?>
				<li role="presentation">
					<a href="#tab-course-review" data-toggle="tab">
						<i class="fa fa-comments"></i>
						<span><?php esc_html_e( 'Reviews', 'eduma' ); ?></span>
						<span><?php echo '(' . learn_press_get_course_rate_total( get_the_ID() ) . ')'; ?></span>
					</a>
				</li>
			<?php endif; ?>
			<?php if ( $student_list_enable ) : ?>
				<li role="presentation">
					<a href="#tab-course-student-list" data-toggle="tab">
						<i class="fa fa-list"></i>
						<span><?php esc_html_e( 'Student List', 'eduma' ); ?></span>
					</a>
				</li>
			<?php endif; ?>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="tab-course-description">
				<?php do_action( 'learn_press_begin_course_content_course_description' ); ?>
				<div class="thim-course-content">
					<?php the_content(); ?>
				</div>
				<?php thim_course_info(); ?>
				<?php do_action( 'learn_press_end_course_content_course_description' ); ?>
				<?php do_action( 'thim_social_share' ); ?>
			</div>
			<div class="tab-pane" id="tab-course-curriculum">
				<?php learn_press_course_curriculum(); ?>
			</div>
			<div class="tab-pane" id="tab-course-instructor">
				<?php thim_about_author(); ?>
			</div>
			<?php if ( $review_is_enable ) : ?>
				<div class="tab-pane" id="tab-course-review">
					<?php thim_course_review(); ?>
				</div>
			<?php endif; ?>
			<?php if ( $student_list_enable ) : ?>
				<div class="tab-pane" id="tab-course-student-list">
					<?php learn_press_course_students_list(); ?>
				</div>
			<?php endif; ?>
		</div>

	</div>

	<div class="thim-course-menu-landing">
		<div class="container">
			<ul class="thim-course-landing-tab">
				<li>
					<a href="#tab-course-description"><?php esc_html_e( 'Description', 'eduma' ); ?></a>
				</li>
				<li>
					<a href="#tab-course-curriculum"><?php esc_html_e( 'Curriculum', 'eduma' ); ?></a>
				</li>
				<li>
					<a href="#tab-course-instructor"><?php esc_html_e( 'Instructors', 'eduma' ); ?></a>
				</li>
				<?php if ( $review_is_enable ) : ?>
					<li>
						<a href="#tab-course-review"><?php esc_html_e( 'Reviews', 'eduma' ); ?></a>
					</li>
				<?php endif; ?>

			</ul>
			<div class="thim-course-landing-button">
				<?php
				if( $course->is_free() || !$user->can( 'enroll-course', $course->id ) ) {
					learn_press_course_price();
				}
				learn_press_course_buttons();
				?>
			</div>
		</div>
	</div>
</div>

<?php do_action( 'learn_press_after_content_landing' ); ?>
