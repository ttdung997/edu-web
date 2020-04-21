<?php
get_header('page');

$theme_options = get_option('sami-settings');
$project_role_taxonomy = $theme_options['project_role_taxonomy'];
?>

<?php
$the_key = 'SAMI_PROJECTS_start_year';  // The meta key to sort on
$args = array(
    'meta_key' => $the_key,
    'orderby' => 'meta_value',
    'tax_query' => array(
        array(
            'taxonomy' => 'project_role',
            'field' => 'slug',
            'terms' => $project_role_taxonomy
        )
    )
);

global $wp_query;

$query_args = array_merge($wp_query->query_vars, $args);

query_posts($query_args);

if (!$current_page = get_query_var('paged'))
    $current_page = 1;
$posts_per_page = get_query_var('posts_per_page');

$start_number = ($current_page - 1) * $posts_per_page + 1;
?>

<h1>Một số đề tài khoa học do cán bộ Viện thực hiện</h1>
<a onclick="hientimkiem()" href="#" class="timkiem">Tìm kiếm <span class="glyphicon glyphicon-circle-arrow-down"></span></a>
<form class="formtimkiem" action="" method="post">
    <input class="inputtimkiem" type="text" name="search">
    <input class="submit" type="submit" name="submit" value="tìm kiếm">
    <br><br><br>
</form>

<?php



$search_value = $_POST["search"];
$search_value = strtolower(stripVietName($search_value));

$exploded = multiexplode(array(" "), $search_value);
$cout = str_word_count($search_value);
for ($j = 0; $j < 30; $j++) {
    $array[$j] = 0;
}
?>


<?php
$j = 0;
if (have_posts()) :
    while (have_posts()): the_post();
                    $user_id = get_the_author_meta('ID');
                    $user_meta = get_user_meta($user_id);
                    $hodem = isset($user_meta['first_name'][0]) ? $user_meta['first_name'][0] : '';
                    $ten = isset($user_meta['last_name'][0]) ? $user_meta['last_name'][0] : '';
                    $title = $title . $hodem . ' ' . $ten;
        for ($i = 0; $i < $cout; $i++) {
            $string = (get_the_title());
            $string = strtolower(stripVietName($string));
            if (strpos($string, $exploded[$i]) !== false ||
                strpos(strtolower(stripVietName($title)), $exploded[$i]) !== false    ) {
                $array[$j] ++;
            }
        }
        $j++;
        $title="";

    endwhile;
endif;
//$i++;			
?>
<?php
$max = 0;
for ($j = 0; $j < 30; $j++) {
    if ($max < $array[$j])
        $max = $array[$j];
}
$j = 0;
?>

<div class="article-list">
    <ol start="<?php echo $start_number; ?>">
        <?php
        if (have_posts()) :
            while (have_posts()): the_post();

                if ($array[$j] == $max) {
                    $roles = rwmb_meta('', 'type=taxonomy&taxonomy=project_role');
                    $role = $roles; //['slug'];
                    $role_slug = $role->slug;
                    $title = '';
                    $role_name = $role->name;

                    $user_id = get_the_author_meta('ID');
                    $user_meta = get_user_meta($user_id);

                    $hocham = isset($user_meta['select_hocham'][0]) ? $user_meta['select_hocham'][0] : '';
                    $hocvi = isset($user_meta['select_hocvi'][0]) ? $user_meta['select_hocvi'][0] : '';
                    $chucdanh = isset($user_meta['select_chucdanh'][0]) ? $user_meta['select_chucdanh'][0] : '';
                    $danhhieu = isset($user_meta['select_danhhieu'][0]) ? $user_meta['select_danhhieu'][0] : '';
                    $chucvu = isset($user_meta['text_chucvu'][0]) ? $user_meta['text_chucvu'][0] : '';
                    $hodem = isset($user_meta['first_name'][0]) ? $user_meta['first_name'][0] : '';
                    $ten = isset($user_meta['last_name'][0]) ? $user_meta['last_name'][0] : '';
                    $teaching_subject = isset($user_meta['teaching_subject'][0]) ? $user_meta['teaching_subject'][0] : '';
                    $research_interest = isset($user_meta['research_interest'][0]) ? $user_meta['research_interest'][0] : '';
                    $students = isset($user_meta['students'][0]) ? $user_meta['students'][0] : '';
                    $email = isset($user_meta['email'][0]) ? $user_meta['email'][0] : '';
                    $website = isset($user_meta['homepage'][0]) ? $user_meta['homepage'][0] : '';

                    /* 			

                      $hocham=$user_meta['select_hocham'][0];
                      $hocvi=$user_meta['select_hocvi'][0];
                      $chucdanh=$user_meta['select_chucdanh'][0];
                      $danhhieu=$user_meta['select_danhhieu'][0];
                      $chucvu = $user_meta['text_chucvu'][0];
                      $hodem=$user_meta['first_name'][0];
                      $ten=$user_meta['last_name'][0];
                      $teaching_subject=$user_meta['teaching_subject'][0];
                      $research_interest=$user_meta['research_interest'][0];
                      $students=$user_meta['students'][0];
                      $email=$user_meta['email'][0];
                      $website=$user_meta['homepage'][0];
                     */

                    if ($hocham != "" && strtoupper($hocham) != "NONE") {
                        $title = $title . $hocham . ". ";
                    }

                    if ($hocvi != "" && strtoupper($hocvi) != "NONE") {
                        $title = $title . $hocvi . ". ";
                    }

                    $title = $title . $hodem . ' ' . $ten;


                    //$first_name = get_the_author_meta('first_name');
                    //$last_name = get_the_author_meta('last_name');
                    //$full_name = "$first_name $last_name";

                    $start_year = get_post_meta(get_the_ID(), 'SAMI_PROJECTS_start_year', true);
                    $end_year = get_post_meta(get_the_ID(), 'SAMI_PROJECTS_end_year', true);
                    $terms = get_the_terms($post->id, 'project-type');
                    //for ($i = 0; $i < $cout; $i++) {
                    //if (strpos(stripVietName(the_title()), $exploded[$i]) !== false) {
                    foreach ($terms as $term) {

                        $term_name = $term->name;
                        $term_id = $term->term_id;
                    }
                    ?>
                    <li>
                        <div class="article-info">
                            <!-- <div class="cat-icon science"><a href="http://news.harvard.edu/gazette/section/science-n-health/">View all posts in Science &amp; Health</a></div> -->
                            <h2 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div><span class="label">Loại đề tài: </span><?php echo $term_name; ?></div>
                            <div><span class="label">Chủ nhiệm: </span><?php echo $title; ?></div>
                            <div><span class="label">Năm thực hiện: </span><?php echo $start_year . ' - ' . $end_year; ?></div>

                        </div>
                    </li>
                    <?php
                }
                $j++;
            endwhile;
        endif;
//wp_pagenavi();
//if (function_exists('wp_corenavi')) wp_corenavi();
//wp_reset_postdata();
        ?>
        <?php
        $j=0;
        if (have_posts()) :
            while (have_posts()): the_post();
                if ($array[$j] > 0  && $array[$j] !== $max) {
                    $roles = rwmb_meta('', 'type=taxonomy&taxonomy=project_role');
                    $role = $roles; //['slug'];
                    $role_slug = $role->slug;
                    $title = '';
                    $role_name = $role->name;

                    $user_id = get_the_author_meta('ID');
                    $user_meta = get_user_meta($user_id);

                    $hocham = isset($user_meta['select_hocham'][0]) ? $user_meta['select_hocham'][0] : '';
                    $hocvi = isset($user_meta['select_hocvi'][0]) ? $user_meta['select_hocvi'][0] : '';
                    $chucdanh = isset($user_meta['select_chucdanh'][0]) ? $user_meta['select_chucdanh'][0] : '';
                    $danhhieu = isset($user_meta['select_danhhieu'][0]) ? $user_meta['select_danhhieu'][0] : '';
                    $chucvu = isset($user_meta['text_chucvu'][0]) ? $user_meta['text_chucvu'][0] : '';
                    $hodem = isset($user_meta['first_name'][0]) ? $user_meta['first_name'][0] : '';
                    $ten = isset($user_meta['last_name'][0]) ? $user_meta['last_name'][0] : '';
                    $teaching_subject = isset($user_meta['teaching_subject'][0]) ? $user_meta['teaching_subject'][0] : '';
                    $research_interest = isset($user_meta['research_interest'][0]) ? $user_meta['research_interest'][0] : '';
                    $students = isset($user_meta['students'][0]) ? $user_meta['students'][0] : '';
                    $email = isset($user_meta['email'][0]) ? $user_meta['email'][0] : '';
                    $website = isset($user_meta['homepage'][0]) ? $user_meta['homepage'][0] : '';

                    /* 			

                      $hocham=$user_meta['select_hocham'][0];
                      $hocvi=$user_meta['select_hocvi'][0];
                      $chucdanh=$user_meta['select_chucdanh'][0];
                      $danhhieu=$user_meta['select_danhhieu'][0];
                      $chucvu = $user_meta['text_chucvu'][0];
                      $hodem=$user_meta['first_name'][0];
                      $ten=$user_meta['last_name'][0];
                      $teaching_subject=$user_meta['teaching_subject'][0];
                      $research_interest=$user_meta['research_interest'][0];
                      $students=$user_meta['students'][0];
                      $email=$user_meta['email'][0];
                      $website=$user_meta['homepage'][0];
                     */

                    if ($hocham != "" && strtoupper($hocham) != "NONE") {
                        $title = $title . $hocham . ". ";
                    }

                    if ($hocvi != "" && strtoupper($hocvi) != "NONE") {
                        $title = $title . $hocvi . ". ";
                    }

                    $title = $title . $hodem . ' ' . $ten;


                    //$first_name = get_the_author_meta('first_name');
                    //$last_name = get_the_author_meta('last_name');
                    //$full_name = "$first_name $last_name";

                    $start_year = get_post_meta(get_the_ID(), 'SAMI_PROJECTS_start_year', true);
                    $end_year = get_post_meta(get_the_ID(), 'SAMI_PROJECTS_end_year', true);
                    $terms = get_the_terms($post->id, 'project-type');
                    //for ($i = 0; $i < $cout; $i++) {
                    //if (strpos(stripVietName(the_title()), $exploded[$i]) !== false) {
                    foreach ($terms as $term) {

                        $term_name = $term->name;
                        $term_id = $term->term_id;
                    }
                    ?>
                    <li>
                        <div class="article-info">
                            <!-- <div class="cat-icon science"><a href="http://news.harvard.edu/gazette/section/science-n-health/">View all posts in Science &amp; Health</a></div> -->
                            <h2 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div><span class="label">Loại đề tài: </span><?php echo $term_name; ?></div>
                            <div><span class="label">Chủ nhiệm: </span><?php echo $title; ?></div>
                            <div><span class="label">Năm thực hiện: </span><?php echo $start_year . ' - ' . $end_year; ?></div>

                        </div>
                    </li>
                    <?php
                }
                $j++;
            endwhile;
        endif;
//wp_pagenavi();
//if (function_exists('wp_corenavi')) wp_corenavi();

        wp_reset_postdata();
        ?>
    </ol>
</div><!-- article-list -->
<?php ?>
<?php
get_footer('page');
