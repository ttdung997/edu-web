
<?php
get_header('page');
$theme_options = get_option('sami-settings');
?>

<?php
$args = array(
    'post_type' => 'any',
    'posts_per_page' => -1,
        //'post__in' => $featured_courses //array($featured_course_1, $featured_course_2, $featured_course_3)
);
$args = new WP_Query($args);
?>
<?php
$search_value = $_POST["search"];
$timkiem = $search_value;
$search_value = strtolower($search_value);

$exploded = multiexplode(array(" "), $search_value);
$cout = str_word_count($search_value);
?>
<h1><?=$timkiem?></h1>
<?php
$max1 = 0;
$max2 = 0;
$max3 = 0;
if ($args->have_posts()) :
    while ($args->have_posts()) : $args->the_post();
        $string = (get_the_title());
        $title = strtolower($string);
        $string = (get_the_content());
        $content = strtolower($string);
        $text = [];
        $text[] = $title;
        $text[] = (string)$content;
        if ((string) mb_strlen($text[1]) == (string) 0)
            $text[1] = ' ';
        WuManber::Build($exploded);
//       $test = WuManber::Search($text, $exploded);
//        if ($max1 < $test[0])$max1 = $test[0];
//        if ($max2 < $test[1]) $max2 = $test[1];
//        if ($max3 < $test[2]) $max3 = $test[2];

    endwhile;
endif;
echo $max1.'<br>'.$max2.'<br>'.$max3.'<br>';
?>
<h2>co chạy đến đây?</h2>
<?php
wp_pagenavi(array('query' => $args));
get_footer('page');
