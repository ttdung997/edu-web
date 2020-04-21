<?php
	get_header();
	
	$theme_options = get_option('sami-settings');	
	$slideshow_images = $theme_options['slideshow_images'];
	$max_tin_tuc = $theme_options['max_tin_tuc'] + 1;
	$max_thong_bao = $theme_options['max_thong_bao'] + 1;
	$max_seminar = $theme_options['max_seminar'] + 1;
	$max_carear = $theme_options['max_carear'] + 1;
	
	$news_options = get_option('sami-stickynews-settings');
	$notification_options = get_option('sami-sticky-notification-settings');
	
	$sticky_news_ids = $news_options['sticky_news'];
	$sticky_notifications_ids = $notification_options['sticky_notifications'];
	$sticky_news_ids = array_filter($sticky_news_ids);
	$sticky_notifications_ids = array_filter($sticky_notifications_ids);
	
	$n_sticky_news = sizeof($sticky_news_ids);
	$n_sticky_notifications = sizeof($sticky_notifications_ids);
	
	$n_missing_news = $max_tin_tuc - $n_sticky_news;
	$n_missing_notifications = $max_thong_bao - $n_sticky_notifications;	
	
	$nsize = sizeof($slideshow_images);
?>
<div id="index-main">
<div class="container">
<div class="row">
	<div class="col-md-9" id="slide-show">
		<div id="myCarousel" class="carousel slide" style="border: solid 1px #D0D0D0;">
			<ol class="carousel-indicators">
			<?php
			for ($i=0; $i<$nsize; $i++){
			?>
				<li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" <?php if (0 == $i){echo 'class="active"';}; ?>></li>
			<?php
				}
			?>
			</ol>
			<!-- Carousel items -->
			<div class="carousel-inner">
<?php
	for ($i=0; $i<$nsize; $i++){
		$cur_img = $slideshow_images[$i];
		$image_id = $cur_img['slideshow_image'][0];
		$image_title = $cur_img['slide_title'];

		if ('undefined' == $image_id){
		    $image_id = $cur_img['slideshow_image'][1];
		}
		
		$image_title_ = explode('$', $image_title);	
		if (count($image_title_)>1)	{
?>
              	<div class="item <?php if (0 == $i){echo 'active';}; ?>">
                	<a href="<?php echo $image_title_[1]; ?>"><img src="<?php echo wp_get_attachment_url( $image_id ); ?>" alt="" style="width: 100%;" /></a>
				<?php
					if ('' != $image_title_[0]){						
				?>
                	<div class="carousel-caption">
                  		<h4><?php echo $image_title_[0]; ?></h4>
                	</div>
				<?php
					}
				?>
              	</div>
<?php
		}else
		{
			?>
              	<div class="item <?php if (0 == $i){echo 'active';}; ?>">
                	<img src="<?php echo wp_get_attachment_url( $image_url ); ?>" alt="" style="width: 100%;" />
				<?php
					if ('' != $image_title){						
				?>
                	<div class="carousel-caption">
                  		<h4><?php echo $image_title; ?></h4>
                	</div>
				<?php
					}
				?>
              	</div>
<?php
		}
	}
?>
			</div>
			<!-- Carousel nav -->
			<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
			<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
		</div><!-- myCarousel -->

	</div><!-- /.blog-main -->
	
	<div class="col-md-3 block-views well-1" id="quick-link-nav">
		<div class="sidebar-module">
			<h2>Liên kết nhanh</h2>
			<?php
				wp_nav_menu( array('menu' => 'primary', 'theme_location' => 'quick-link-nav', 'menu_class'      => 'quick-link-nav vertical-nav nav' ));
			?>
		</div>
	</div><!-- /.blog-sidebar -->
</div><!-- /.row -->

<div class="row">
	<div class="col-sm-12">
		<div class="streamer">
			<div class="col-sm-2" id="heading-cover">
				<div class="heading">
					<h2>Sự kiện</h2>
					<p class="more"><a href="<?php echo get_post_type_archive_link( 'event' ); ?>">Xem thêm +</a></p>
				</div><!-- heading -->
			</div>
			<div class="prime listing col-md-10 col-sm-10">
		<?php
			$today = date('Ymd');
			$args = array('post_type' => array('event'),
								'posts_per_page' => 2,
								'meta_key' => 'SAMI_EVENTS_date',
								'orderby' => 'meta_value',
								'order' => 'DESC',
						);
			$events = new WP_Query($args);
			if ($events->have_posts()) : while ($events->have_posts()) : $events->the_post();
				$event_date = get_post_meta(get_the_ID(), 'SAMI_EVENTS_date', true);
				$event_date = (string)$event_date;
				$weekday = vietnameseWeekday(date("l", strtotime(str_replace('/', '-', $event_date))));
				$event_date = date('d/m/Y', strtotime(str_replace('/', '-', $event_date)));
				
				$time = get_post_meta(get_the_ID(), 'SAMI_EVENTS_start_time', true);
				$hour = date ('H', strtotime($time));
				$minute = date ('i', strtotime($time));
				
				$location = rwmb_meta( 'SAMI_EVENTS_location' );
		?>	
				<div class="col-sm-6 item">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p class="data">Thời gian: <?php echo $hour . ':' . $minute; ?>, ngày <?php echo $event_date; ?> (<?php echo $weekday; ?>)</p>
					<p class="data">Địa điểm: <?php echo $location; ?></p>
				</div>
		<?php
				endwhile;
			endif;
		?>
			</div><!-- prime -->
		</div><!-- streamer -->
	</div><!-- col-sm-12 -->
</div><!-- row -->


<div class="row">
	<div class="col-sm-4 block-views" id="news-block">
		<h2 style="    background: #EDEDED;    padding: 7px 8px;">Đào tạo Đại học</h2>

<?php echo do_shortcode('[widget id="smart-post-list-widget-2"]'); ?>
		<div class="more"><a href="http://localhost/loai-hinh-dao-tao/dao-tao-dai-hoc/">Xem thêm +</a></div>
	</div>
	
	<div class="col-sm-4 block-views" id="news-block">
		<h2 style="    background: #EDEDED;    padding: 7px 8px;">Đào tạo Thạc sĩ</h2>

<?php echo do_shortcode('[widget id="smart-post-list-widget-3"]'); ?>
		<div class="more"><a href="http://localhost/loai-hinh-dao-tao/dao-tao-thac-si/">Xem thêm +</a></div>
	</div>
	
	<div class="col-sm-4 block-views" id="news-block">
		<h2 style="    background: #EDEDED;    padding: 7px 8px;">Đào tạo Tiến sĩ</h2>

<?php echo do_shortcode('[widget id="smart-post-list-widget-4"]'); ?>
		<div class="more"><a href="http://localhost/loai-hinh-dao-tao/dao-tao-tien-si/">Xem thêm +</a></div>
	</div>
	
	<!-- /.blog-sidebar -->
</div><!-- /.row -->





<div class="row">
	<div class="col-sm-4 block-views" id="news-block">
		<h2>Tin tức</h2>
	<?php echo do_shortcode('[widget id="smart-post-list-widget-5"]'); ?>
		
		<!-- <div class="featured">
  <?php $recent = new WP_Query("post_type=tin-tuc1&showposts=");
  while($recent->have_posts()) : $recent->the_post();?>
    <h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
 <div style="clear:both;"></div>
  <?php endwhile; ?>
</div>
		
		
		<?php
$args1 = new WP_Query( array( 'cat' => '20' ) );
?>
		<ul id="main-new-list" class="news-list article-list nopadding-left">
<?php
	$news = new WP_Query( $args1 );
	while ($news->have_posts()): $news->the_post();
?>
			<li class="sticky-post sticky-news">
	<?php 
		if ( has_post_thumbnail() ) {
			$thumbnail_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
	?>
			<img class="img-thumbnail col-sm-3" src="<?php echo $thumbnail_image_url[0]; ?>" />
	<?php
		}
	?>					
				<div class="col-view2">
					<div class="date-repeat-instance"><?php the_time('d/m/Y'); ?></div>
					<div class="bolder">
						<a class="bold1" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</div>
					<div><?php //the_excerpt(); ?></div>
				</div>
			</li>
<?php
	endwhile;
?>		
-->
		</ul>
		<div class="more"><a href="http://localhost/tin-tuc/">Xem thêm +</a></div>
	</div>
	<div class="col-sm-4 block-views" id="notice-block">
		<h2>Thông báo</h2>
		<ul class="notice-list article-list nopadding-left">
<?php
if ($n_sticky_notifications > 0){
$args1 = array(
			'post_type' => 'thong-bao',
			'posts_per_page' => $n_sticky_notifications,
			'post__in'      => $sticky_notifications_ids,
			'orderby'=>'post__in');

$notices = new WP_Query( $args1 );
while ($notices->have_posts()): $notices->the_post();
?>
			<li class="sticky-post sticky-notifications">
				<div class="date-repeat-instance"><?php the_time('d/m/Y'); ?></div>
				<div class="bolder">
					<a class="bold1" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</div>
			</li>
<?php
endwhile;
}
if ($n_missing_notifications > 0){
			
$args2 = array(
			'post_type' => 'thong-bao',
			'posts_per_page' => $n_missing_notifications,
			'post__not_in' => $sticky_notifications_ids			);
$notices = new WP_Query( $args2 );
while ($notices->have_posts()): $notices->the_post();
?>
			<li>
				<div class="date-repeat-instance"><?php the_time('d/m/Y'); ?></div>
				<div class="bolder">
					<a class="bold1" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</div>
			</li>
<?php
endwhile;
}
?>
		</ul>
		<div class="more"><a href="<?php echo get_post_type_archive_link( 'thong-bao' ); ?>">Xem thêm +</a></div>
	</div>
	<div class="col-sm-4 blog-sidebar  block-views" id="seminar-block">
		<div class="sidebar-module">
			<h2>Lịch seminar</h2>
			<ul class="seminar-schedule article-list nopadding-left">
	<?php
		wp_reset_query();
		$today = date('Ymd');
		$future_seminars = array();
		$past_seminars = array();
		
		// Get future seminars
		$seminar_args1 = array('post_type' => array('seminar'),
							'posts_per_page' => $max_seminar,
							'meta_key' => 'SAMI_EVENTS_date',
							
							'meta_query' => array(
								array(
									'key' => 'SAMI_EVENTS_date',
									'value' => $today,
									'compare' => '>=',
									'type' => 'date'
								)
							),
							
							'orderby' => 'meta_value',
							'order' => 'DESC',
							//'post__in' => $featured_courses //array($featured_course_1, $featured_course_2, $featured_course_3)
					);
		$future_seminars = new WP_Query($seminar_args1);
		
		$n_seminar = 0;
		if ($future_seminars->have_posts()) : while ($future_seminars->have_posts()) : $future_seminars->the_post();
		
		global $post;

		$event_date = get_post_meta(get_the_ID(), 'SAMI_EVENTS_date', true);
		$event_date = (string)$event_date;
		$weekday = vietnameseWeekday(date("l", strtotime(str_replace('/', '-', $event_date))));
		$day_month = date('d/m', strtotime(str_replace('/', '-', $event_date)));
		
		$event_day = date('d', strtotime(str_replace('/', '-', $event_date)));
		$event_month_year = date('m/Y', strtotime(str_replace('/', '-', $event_date)));
		
		$event_time = get_post_meta(get_the_ID(), 'SAMI_EVENTS_start_time', true);
		$event_time = date ('H:i', strtotime($event_time));
		
		$event_location = get_post_meta(get_the_ID(), 'SAMI_EVENTS_location', true);		
	?>			
				<li>
					<div class="article_item tr2">
						<div class="date_stamp">
							<div class="date_stamp_top">
								<div class="weekday"><?php echo $weekday; ?></div>
								<div class="event_date"><?php echo $event_day; ?></div>
							</div>
							<p class="date_time_bottom"><?php echo $event_month_year; ?></p>

						</div>
						<div class="seminar_item_right">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<p class="seminar-time seminar-info"><span class=" glyphicon glyphicon-time"> </span> <?php echo $event_time; ?></p>
						</div>
					</div>
				</li>
	<?php
			$n_seminar += 1;
		endwhile;
	endif;
		
		//$n_seminar = sizeof($future_seminars);
		//echo "Future seminar: $n_seminar<br />";
		$n_missing = $max_seminar - $n_seminar;
		
		//$n_missing = 0;
		
		//Get past seminars
		
		if ($n_missing > 0){
			wp_reset_query();
			$seminar_args2 = array('post_type' => array('seminar'),
								'posts_per_page' => $n_missing,
								'meta_key' => 'SAMI_EVENTS_date',
								
								'meta_query' => array(
									array(
										'key' => 'SAMI_EVENTS_date',
										'value' => $today,
										'compare' => '<',
										'type' => 'date'
									)
								),
								
								'orderby' => 'meta_value',
								'order' => 'DESC',
								//'post__in' => $featured_courses //array($featured_course_1, $featured_course_2, $featured_course_3)
						);
			$past_seminars = new WP_Query($seminar_args2);
			while ($past_seminars->have_posts()) : $past_seminars->the_post();
			
			global $post;

			$event_date = get_post_meta(get_the_ID(), 'SAMI_EVENTS_date', true);
			$event_date = (string)$event_date;
			$weekday = vietnameseWeekday(date("l", strtotime(str_replace('/', '-', $event_date))));
			$day_month = date('d/m', strtotime(str_replace('/', '-', $event_date)));
			
			$event_day = date('d', strtotime(str_replace('/', '-', $event_date)));
			$event_month_year = date('m/Y', strtotime(str_replace('/', '-', $event_date)));
			
			$event_time = get_post_meta(get_the_ID(), 'SAMI_EVENTS_start_time', true);
			$event_time = date ('H:i', strtotime($event_time));
			
			$event_location = get_post_meta(get_the_ID(), 'SAMI_EVENTS_location', true);		
		?>			
					<li>
						<div class="article_item tr2">
							<div class="date_stamp">
								<div class="date_stamp_top">
									<div class="weekday"><?php echo $weekday; ?></div>
									<div class="event_date"><?php echo $event_day; ?></div>
								</div>
								<p class="date_time_bottom"><?php echo $event_month_year; ?></p>

							</div>
							<div class="seminar_item_right">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<p class="seminar-time seminar-info"><span class=" glyphicon glyphicon-time"> </span> <?php echo $event_time; ?></p>
							</div>
						</div>
					</li>
		<?php
			endwhile;
		
		}
	?>
			</ul>
			<div class="more"><a href="<?php echo get_post_type_archive_link( 'seminar' ); ?>">Xem thêm +</a></div>
		</div>
	</div><!-- /.blog-sidebar -->
</div><!-- /.row -->



<div class="row">
	<div class="col-sm-4 block-views" id="news-block">
		<h2>Cơ hội nghề nghiệp</h2>
		<ul class="job-news-list article-list nopadding-left">
<?php
$args = array(
	'post_type' => 'tin-tuyen-dung',
	'posts_per_page' => $max_carear,
);
$news = new WP_Query( $args );
while ($news->have_posts()) : $news->the_post();
?>			
			<li>
				<div class="date-repeat-instance"><?php the_time('d/m/Y'); ?></div>
				<div class="bolder">
					<a class="bold1" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</div>
			</li>
<?php
endwhile;
?>
		</ul>
		<div class="more"><a href="<?php echo get_post_type_archive_link( 'tin-tuyen-dung' ); ?>">Xem thêm +</a></div>
	</div>
	<div class="col-sm-4 block-views" id="notice-block">
		<h2>Video</h2>
	<?php
		$theme_options = get_option('sami-settings');
		$video_url = $theme_options['video_url'];
		if ('' != $video_url){
	?>
		<div class="video-container">
			<iframe width="100%" src="<?php echo $video_url; ?>" frameborder="0" allowfullscreen></iframe>
		</div>
	<?php
		}
	?>
	</div>
	<div class="col-sm-4 blog-sidebar  block-views" id="web-link-block">
		<div class="sidebar-module">
			<h2>Liên kết web</h2>
			<?php
				wp_nav_menu( array('menu' => 'primary', 'theme_location' => 'web-lien-ket', 'menu_class'      => 'web-links nav' ));
			?>
		</div>
	</div><!-- /.blog-sidebar -->
</div><!-- /.row -->
</div><!-- container -->
</div>

<?php
	get_footer();
?>
