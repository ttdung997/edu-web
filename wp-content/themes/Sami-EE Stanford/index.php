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

                <div id="myCarousel" class="carousel slide" style="border: solid 1px #D0D0D0;">
                    <ol class="carousel-indicators">
                        <?php
                        for ($i = 0; $i < $nsize; $i++) {
                            ?>
                            <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" <?php
                            if (0 == $i) {
                                echo 'class="active"';
                            };
                            ?>></li>
                                <?php
                            }
                            ?>
                    </ol>
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <?php
                        for ($i = 0; $i < $nsize; $i++) {
                            $cur_img = $slideshow_images[$i];
                            $image_id = $cur_img['slideshow_image'][0];
                            $image_title = $cur_img['slide_title'];
                            $image_describe = $cur_img['slide_describe'];


                            $image_title_ = explode('$', $image_title);
                            ?>
                            <div class="item <?php
                            if (0 == $i) {
                                echo 'active';
                            };
                            ?>">
                                <a href="<?php echo $image_title_[1]; ?>"><img src="<?= wp_get_attachment_url($image_id); ?>" style="width: 100%;" /></a>
                                <?php
                                if ('' != $image_title_[0]) {
                                    ?>
                                    <div class="carousel-caption1 hidden-xs">
                                        <h4><?php echo $image_title_[0]; ?></h4>
                                        <br>
                                        <p><?php echo $image_describe; ?></p>

                                        <button type="button" class="btn btn-default">Đọc thêm</button>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- Carousel nav -->
                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
                </div><!-- myCarousel -->
    <div class="container">

        <div class="row">
            <div class="col-md-12" id="slide-show">

            </div><!-- /.blog-main -->
        </div><!-- /.row -->






        <div class="row">
            <div class="col-sm-4 block-views" id="news-block">
                <div class="card-jumbotron text-color">
                    <h2>Sứ mệnh</h2>
                    <p class="text-justify">
                        Trung tâm an toàn thông tin hoạt động theo mô hình Phòng thí nghiệm mở, là tập hợp của các nhà khoa học có trình độ chuyên môn cao thuộc trường Đại học Bách khoa Hà Nội. Trung tâm có nhiệm vụ tạo ra cầu nối liên kết giữa Nhà trường với các cơ sở nghiên cứu và đào tạo có uy tín trên thế giới và đóng vai trò quan trọng trong việc quảng bá kiến thức, thông tin và những tiến bộ khoa học và công nghệ của các quốc gia về an ninh mạng tại Việt Nam</p>
                        <!-- <a href="">
                            <strong class="text-color ng-scope-body">Đọc thêm</strong>
                        </a> -->
                        <div class="more"><a href="#">Đọc thêm +</a></div>
                    
                </div>
            </div>
            <div class="col-sm-4 block-views" id="news-block">
                <div class="card-jumbotron text-color" style="margin-left: 1%;margin-right: 1%">
                    <h2>Đào tạo</h2>
                    <p class="text-justify">
                        Chương trình giảng dạy kỹ sư an toàn thông tin do Trung tâm hỗ trợ Viện Công nghệ thông tin và truyền thông thực hiện là chương trình với sự tham gia giảng dạy của 15 giáo sư, phó giáo sư và 40 tiến sỹ. Chương trình được trang bị cơ sở vật chất khang trang, hiện đại với khối lượng và chất lượng các bài thực hành tương đương với các chứng chỉ đào tạo an ninh mạng quốc tế</p>
                       <!--  <a href="">
                            <strong class="text-color ng-scope-body" >Đọc thêm</strong>
                        </a> -->
                        <br><br>
                        <div class="more" style="margin-top: 23px;""><a href="#">Đọc thêm +</a></div>
                    
                </div>
            </div>
            <div class="col-sm-4 block-views" id="news-block">
                <div class="card-jumbotron text-color">
                    <h2>Nghiên cứu</h2>
                    <p class="text-justify">
                        Hoạt động nghiên cứu khoa học của Trung tâm tập trung vào các vấn đề cơ bản của an ninh hạ tầng truyền thông, an toàn hệ thống, đánh giá kiểm định an toàn hệ thống thông tin và bản quyền số. Trung tâm cam kết hỗ trợ, tư vấn cho các cơ quan nhà nước và các tổ chức doanh nghiệp trong việc xây dựng các quy chuẩn và áp dụng các quy trình đảm bảo an toàn an ninh thông tin theo chuẩn quốc tế ISO27001, ISO27005</p>   
                        <!-- <a href="">
                            <strong class="text-color ng-scope-body" >Đọc thêm</strong>
                        </a> --><br>
                         <div class="more"><a href="#">Đọc thêm +</a></div>
                  
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 block-views" id="news-block">
                <h2>Tin tức</h2>
                <?php echo do_shortcode('[widget id="smart-post-list-widget-5"]'); ?>

                <!-- <div class="featured">
                <?php
                $recent = new WP_Query("post_type=tin-tuc1&showposts=");
                while ($recent->have_posts()) : $recent->the_post();
                    ?>
                        <h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                     <div style="clear:both;"></div>
                <?php endwhile; ?>
</div>
                
                
                <?php
                $args1 = new WP_Query(array('cat' => '20'));
                ?>
                <ul id="main-new-list" class="news-list article-list nopadding-left">
                <?php
                $news = new WP_Query($args1);
                while ($news->have_posts()): $news->the_post();
                    ?>
                                            <li class="sticky-post sticky-news">
                    <?php
                    if (has_post_thumbnail()) {
                        $thumbnail_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
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
                                                            <div><?php //the_excerpt();    ?></div>
                                                    </div>
                                            </li>
                    <?php
                endwhile;
                ?>		
                -->
                </ul>
                <div class="more"><a href="/tin-tuc/">Xem thêm +</a></div>
            </div>
            <div class="col-sm-4 block-views" id="notice-block">
                <h2>Sự kiện</h2>
                <ul class="notice-list article-list nopadding-left">
                    <?php
                    if ($n_sticky_notifications > 0) {
                        $args1 = array(
                            'post_type' => 'thong-bao',
                            'posts_per_page' => $n_sticky_notifications,
                            'post__in' => $sticky_notifications_ids,
                            'orderby' => 'post__in');

                        $notices = new WP_Query($args1);
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
                    if ($n_missing_notifications > 0) {

                        $args2 = array(
                            'post_type' => 'thong-bao',
                            'posts_per_page' => $n_missing_notifications,
                            'post__not_in' => $sticky_notifications_ids);
                        $notices = new WP_Query($args2);
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
                <div class="more"><a href="<?php echo get_post_type_archive_link('thong-bao'); ?>">Xem thêm +</a></div>
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
                                $event_date = (string) $event_date;
                                $weekday = vietnameseWeekday(date("l", strtotime(str_replace('/', '-', $event_date))));
                                $day_month = date('d/m', strtotime(str_replace('/', '-', $event_date)));

                                $event_day = date('d', strtotime(str_replace('/', '-', $event_date)));
                                $event_month_year = date('m/Y', strtotime(str_replace('/', '-', $event_date)));

                                $event_time = get_post_meta(get_the_ID(), 'SAMI_EVENTS_start_time', true);
                                $event_time = date('H:i', strtotime($event_time));

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

                        if ($n_missing > 0) {
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
                                $event_date = (string) $event_date;
                                $weekday = vietnameseWeekday(date("l", strtotime(str_replace('/', '-', $event_date))));
                                $day_month = date('d/m', strtotime(str_replace('/', '-', $event_date)));

                                $event_day = date('d', strtotime(str_replace('/', '-', $event_date)));
                                $event_month_year = date('m/Y', strtotime(str_replace('/', '-', $event_date)));

                                $event_time = get_post_meta(get_the_ID(), 'SAMI_EVENTS_start_time', true);
                                $event_time = date('H:i', strtotime($event_time));

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
                    <div class="more"><a href="<?php echo get_post_type_archive_link('seminar'); ?>">Xem thêm +</a></div>
                </div>
            </div><!-- /.blog-sidebar -->
        </div><!-- /.row -->




    </div><!-- container -->
</div>

<?php
get_footer();
?>
