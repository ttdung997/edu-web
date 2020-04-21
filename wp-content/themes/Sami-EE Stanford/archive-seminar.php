<?php
get_header('page');

$seminar_names = get_terms('seminars');

global $post;
$parent_ID = $post->post_parent;
$parent_page_title = get_the_title($parent_ID);
$post_title = $post->post_title;
$post_content = $post->post_content;

$args = array('post_type' => 'seminar',
    'posts_per_page' => -1,
    'status' => 'published'
        //'post__in' => $featured_courses //array($featured_course_1, $featured_course_2, $featured_course_3)
);
$seminars = new WP_Query($args);
?>
<h1>Lịch seminar </h1>
<hr class="page-hr"> 
<div class="article-list" style="margin-left: -15px;">
    <?php
        if ($seminars->have_posts()) {
            while ($seminars->have_posts()) {
                $seminars->the_post();
                $report_title = rwmb_meta('SAMI_SEMINAR_report_title');
                $date = new DateTime(rwmb_meta('SAMI_EVENTS_datetime'));

                $date = get_post_meta(get_the_ID(), 'SAMI_EVENTS_date', true);
                $date = (string) $date;
                $weekday = vietnameseWeekday(date("l", strtotime(str_replace('/', '-', $date))));
                $event_date = date('d', strtotime(str_replace('/', '-', $date)));
                $month_year = date('m/Y', strtotime(str_replace('/', '-', $date)));

                $time = get_post_meta(get_the_ID(), 'SAMI_EVENTS_start_time', true);
                $hour = date('H', strtotime($time));
                $minute = date('i', strtotime($time));
            
            ?>
            <div class="report-item tr1?> col-lg-6">
                <div class="date_stamp">
                    <div class="date_stamp_top">
                        <div class="weekday"><?php echo $weekday; ?></div>
                        <div class="event_date"><?php echo $event_date; ?></div>
                    </div>
                    <p class="date_time_bottom"><?php echo $month_year; ?></p>

                </div>
                <div class="seminar_item_right">
                    <h2 class="article-title" style="text-align: justify;" ><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="seminar_info">
                        <div><i>Bắt đầu:</i> <?php echo $hour; ?>h<?php echo $minute; ?></div>
                        <div><i>Địa điểm:</i> <?php echo rwmb_meta('SAMI_EVENTS_location'); ?> <a href="<?php the_permalink(); ?>">(Xem chi tiết)</a></div>
                        <div><i>Người báo cáo:</i> <?php echo rwmb_meta('SAMI_SEMINAR_reporter'); ?></div>
                    </div>
                </div>
            </div>
            <?php
            }
        }else{
            echo "không tìm thấy post";
        }
    
    ?>
</div>
<?php
get_footer('page');
?>