<form id="learn_press_payment_form" name="learn_press_payment_form" method="post">
	<span class="learn_press_payment_close"><i class="fa fa-close"></i></span>
	<?php
	if ( !learn_press_is_free_course() ) {
		$gateways = LPR_Gateways::instance()->get_available_payment_gateways();
		?>
		<ul id="lpr-payment-tab" class="nav nav-tabs" role="tablist">
			<?php
			do_action( 'learn_press_before_payment_loop' );
			$i = 0;
			foreach ( $gateways as $slug => $gateway ) {
				$gateway = apply_filters( 'learn_press_print_payment_' . $slug, $gateway );
				if ( !$gateway ) continue;
				?>
				<li>
					<label><input type="radio" name="payment_method" value="<?php echo esc_attr( $slug ); ?>" /> <?php echo esc_attr( $gateway ); ?>
					</label>

					<div class="learn_press_payment_form" id="learn_press_payment_form_<?php echo esc_attr( $slug ); ?>">
						<?php do_action( 'learn_press_payment_gateway_form_' . $slug ); ?>
					</div>
				</li>
				<?php
			}
			do_action( 'learn_press_after_payment_loop' );
			?>
		</ul>
	<?php } ?>
	<input type="hidden" name="action" value="learnpress_take_course" />
	<input type="hidden" name="course_id" value="<?php the_ID(); ?>" />
	<a title="Check out" class="learn_press_payment_checkout"><?php esc_html_e( 'Check out', 'eduma' ); ?></a>
</form>