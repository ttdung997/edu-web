<?php

if ( have_posts() ) :?>
	<div id="our-team-archive" class="our-team-archive">
		<div class="wrapper-lists-our-team ">
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				$team_id      = get_the_ID();
				$regency      = get_post_meta( $team_id, 'regency', true );
				$link_face    = get_post_meta( $team_id, 'face_url', true );
				$link_twitter = get_post_meta( $team_id, 'twitter_url', true );
				$skype_url    = get_post_meta( $team_id, 'skype_url', true );
				$dribbble_url = get_post_meta( $team_id, 'dribbble_url', true );
				$linkedin_url = get_post_meta( $team_id, 'linkedin_url', true );

				?>
				<div class="our-team-item col-sm-3 col-xs-6">
					<div class="our-team-image">
						<?php echo thim_get_feature_image( get_post_thumbnail_id(), 'full', apply_filters( 'thim_member_thumbnail_width', 200 ), apply_filters( 'thim_member_thumbnail_height', 200 ) ); ?>
						<div class="social-team">
							<?php if ( $link_face <> '' ): ?>
								<a href="<?php echo $link_face; ?>"><i class="fa fa-facebook"></i></a>
							<?php endif; ?>
							<?php if ( $link_twitter <> '' ): ?>
								<a href="<?php echo $link_twitter; ?>"><i class="fa fa-twitter"></i></a>
							<?php endif; ?>
							<?php if ( $dribbble_url <> '' ): ?>
								<a href="<?php echo $dribbble_url; ?>"><i class="fa fa-dribbble"></i></a>
							<?php endif; ?>
							<?php if ( $skype_url <> '' ): ?>
								<a href="<?php echo $skype_url; ?>"><i class="fa fa-skype"></i></a>
							<?php endif; ?>
							<?php if ( $linkedin_url <> '' ): ?>
								<a href="<?php echo $linkedin_url; ?>"><i class="fa fa-linkedin"></i></a>
							<?php endif; ?>
							<?php if ( $link_face <> '' ): ?>
								<a href="<?php echo $link_face; ?>"><i class="fa fa-facebook"></i></a>
							<?php endif; ?>

						</div>
					</div>
					<div class="content-team">
						<h4 class="title">
							<a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo get_the_title() ?></a>
						</h4>

						<?php if ( !empty( $regency ) ) : ?>
							<div class="regency"><?php echo $regency ; ?></div>
						<?php endif; ?>

					</div>
				</div>

				<?php
			endwhile;
			?>
		</div>
	</div>
	<?php
	thim_paging_nav();
	?>
	</div>
	<?php
else :
	?>
	<p class="message message-info"><?php esc_html_e( 'Không tìm thấy!', 'eduma' ); ?></p>
	<?php
endif;
?>