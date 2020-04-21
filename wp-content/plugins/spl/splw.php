<?php
/*
Plugin Name: Smart Post Lists
Plugin URI: http://otwthemes.com/wordpress-plugins/smart-post-lists/
Description: Makes Smart Post Lists Widget available. It works similar to sql query but no coding required! It makes a list of posts selected from the database based on options you choose from a form. Select category/s and/or tag/s and/or author/s. Choose post count and offset. Order the list by date, author, date, id, rand. Define which fields you need to show: title, date, excerpt, comments. Choose to show image on the first post only, all post, none. Choose which Wordpress image to show: thumbnail, medium, large. Choose image float.
Version: 2.0
Author: By OTWthemes
Author URI: http://themeforest.net/user/OTWthemes
*/

// error_reporting(E_ALL); /* for development */

define('SMART_POST_LIST_PLUGIN_URL', plugin_dir_url( __FILE__ ));

class PostInCategory extends WP_Widget {
    /**
     * The Widget.
     */
  	function PostInCategory() {
		$widget_ops = array( 'classname' => 'widget smart-post-list',
							 'description' => __('A widget that displays posts from a specific category/tag/author', 'smart-post-list') );
		$control_ops = array( 'width' => 300,
							  'height' => 350,
							  'id_base' => 'smart-post-list-widget' );

		$this->WP_Widget( 'smart-post-list-widget',
						  __('Smart Post Lists', 'smart-post-list'),
						  $widget_ops, $control_ops );
  	}

  	/**
  	 * Creates the Widget's Admin HTML.
  	 */
	function form($instance) {
		$defaults = array('title' => __('Category Name', 'smart-post-list'),
						  'show_title' => 1,
						  'show_date' => 1,
                          'show_excerpt' => 1,
                          'excerpt_words_count' => 150,
                          'show_number_of_comments' => 1,
                          'posts_count' => 5,
                          'posts_offset' => 0,
                          'post_orderby' => 'date',
                          'post_order_direction' => 'DESC',
						  'authors' => '',
                          'thumb_on_post' => 'none',
                          'thumb_image_size' => 'thumbnail',
		                  'thumb_image_width' => '',
		                  'thumb_image_height' => '',
						  'post_image_float' => 'top_of_excerpt',
		                  'show_hr_delimiter' => 0,
		                  'number_of_columns' => 1,
		                  'custom_widget_css_class' => '',
		                  'post_type' => 'post',
		                  'post_type_options' => array() // Contains all the custom post types options selected for the widget
		);

		$instance = wp_parse_args((array) $instance, $defaults);
        ?>
            <script type="text/javascript">
            if (document.getElementById("<?php echo $this->get_field_id('thumb_on_post');?>") != null && document.getElementById("<?php echo $this->get_field_id('thumb_on_post');?>").selectedIndex == 0) {
                document.getElementById("<?php echo $this->get_field_id('thumb_image_size');?>").disabled = true;
				document.getElementById("<?php echo $this->get_field_id('post_image_float');?>").disabled = true;
            }
            </script>

            <span id="removeMe">
                <script type="text/javascript">
                // JS Logic to handle the creation of a new instance of the CPLW.
                jQuery(function () {
    				jQuery('.ui-draggable').draggable({
    				
    					stop: function(event, ui) {
    						
    						jQuery(this).ajaxComplete(function(event, XMLHttpRequest, ajaxOptions) {
    							var widget_id_base = '<?php echo @$control_ops['id_base']; ?>';
    							
    							
    							// Validate it was our Widget's AJAX call end.
    							if(ajaxOptions.data.search('action=save-widget') != -1 && ajaxOptions.data.search('id_base=' + widget_id_base) != -1) {
    								var uiHelper = jQuery(ui.helper);
    								var thisDroppedWidgetDropDown = jQuery(uiHelper).find('.post_type select');
    								if (jQuery(thisDroppedWidgetDropDown).length == 1) {
    									jQuery('.post_type select').change(function () {
    										performAJAXCallOnPostTypeChange(jQuery(this));
    		        					});
    		        					var searchRegEx = /this_widget_iteration=([0-9]+)/;
    									var widgetIteration = ajaxOptions.data.match(searchRegEx);
    									performAJAXCallOnPageLoad001(jQuery(thisDroppedWidgetDropDown), widgetIteration[1]);
    								}
    							}
    						});
    					}
    				});
    			});
                </script>
            </span>

            <p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'smart-post-list'); ?></label>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" type='text' style="width:100%;" />
			</p>
			<div class="post_type">
				<label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php _e('Post Types', 'smart-post-list'); ?></label>
				<select id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>" style="width:100%;">
					<?php
					// Get all the User Interfase visible Post Types, including the Custom Post Type
					$all_post_types = get_post_types(array('show_ui' => true), 'objects');
					foreach ($all_post_types as $post_type_object) {
					    if ($post_type_object->name == 'page') {
					        continue;
					    }

					    $post_type_selected = '';
					    if ($post_type_object->name == $instance['post_type']) {
					        $post_type_selected = ' selected="selected"';
					    }
					?>
					<option id="<?php echo $post_type_object->name; ?>" value="<?php echo $post_type_object->name; ?>"<?php echo $post_type_selected; ?>><?php echo $post_type_object->label; ?></option>
					<?php
					}
					?>
				</select>

    			<div class="smart-post-lists-admin-taxonomies">&nbsp;</div>
            	<input type="hidden" class="categories_serialized" name="categories_serialized" value="<?php echo urlencode(serialize($instance['post_type_options'])); ?>" />
            	<input type="hidden" class="authors_serialized" name="authors_serialized" value="<?php echo urlencode(serialize($instance['authors'])); ?>" />
            	<input type="hidden" class="this_widget_iteration" name="this_widget_iteration" value="<?php echo $this->number; ?>" />
            	<input type="hidden" class="this_widget_iteration_name" name="this_widget_iteration_name" value="<?php echo 'widget-' . $this->id_base; ?>" />
			</div>

			<p>
				<label for="<?php echo $this->get_field_id('posts_count'); ?>"><?php _e('Posts count', 'smart-post-list'); ?></label>
				<input id="<?php echo $this->get_field_id('posts_count'); ?>" onkeypress="return isNumberKey(event)" name="<?php echo $this->get_field_name('posts_count'); ?>" value="<?php echo $instance['posts_count']; ?>" type='text' style="width: 100%;" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('posts_offset'); ?>"><?php _e('Posts offset (number of posts to skip)', 'smart-post-list'); ?></label>
				<input id="<?php echo $this->get_field_id('posts_offset'); ?>" onkeypress="return isNumberKey(event)" name="<?php echo $this->get_field_name('posts_offset'); ?>" value="<?php echo $instance['posts_offset']; ?>" type='text' style="width: 100%;" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('post_orderby'); ?>"><?php _e('Order by:', 'smart-post-list'); ?></label>
				<select id="<?php echo $this->get_field_id('post_orderby'); ?>" name="<?php echo $this->get_field_name('post_orderby'); ?>" class="widefat" style="width:100%;">
					<option <?php if ( 'author' == $instance['post_orderby'] ) echo 'selected="selected"'; ?>>author</option>
					<option <?php if ( 'date' == $instance['post_orderby'] ) echo 'selected="selected"'; ?>>date</option>
					<option <?php if ( 'title' == $instance['post_orderby'] ) echo 'selected="selected"'; ?>>title</option>
					<option <?php if ( 'modified' == $instance['post_orderby'] ) echo 'selected="selected"'; ?>>modified</option>
					<option <?php if ( 'parent' == $instance['post_orderby'] ) echo 'selected="selected"'; ?>>parent</option>
					<option <?php if ( 'ID' == $instance['post_orderby'] ) echo 'selected="selected"'; ?>>ID</option>
					<option <?php if ( 'rand' == $instance['post_orderby'] ) echo 'selected="selected"'; ?>>rand</option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('post_order_direction'); ?>"><?php _e('Order to display posts:', 'smart-post-list'); ?></label>
				<select id="<?php echo $this->get_field_id('post_order_direction'); ?>" name="<?php echo $this->get_field_name('post_order_direction'); ?>" class="widefat" style="width:100%;">
					<option <?php if ( 'DESC' == $instance['post_order_direction'] ) echo 'selected="selected"'; ?>>DESC</option>
					<option <?php if ( 'ASC' == $instance['post_order_direction'] ) echo 'selected="selected"'; ?>>ASC</option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('show_title'); ?>"><input type="checkbox" <?php checked($instance['show_title'], true) ?> id="<?php echo $this->get_field_id( 'show_title' ); ?>" name="<?php echo $this->get_field_name( 'show_title' ); ?>" /><?php _e('Show title', 'smart-post-list'); ?></label>

			</p>
			<p>
				<label for="<?php echo $this->get_field_id('show_date'); ?>"><input type="checkbox" <?php checked($instance['show_date'], true) ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" /><?php _e('Show date', 'smart-post-list'); ?></label>

			</p>
            <p>
				<label for="<?php echo $this->get_field_id('show_excerpt'); ?>"><input type="checkbox" <?php checked($instance['show_excerpt'], true) ?> id="<?php echo $this->get_field_id( 'show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>"/><?php _e('Show excerpt', 'smart-post-list'); ?></label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('excerpt_words_count'); ?>"><?php _e('Excerpt length in words', 'smart-post-list'); ?></label>
				<input id="<?php echo $this->get_field_id('excerpt_words_count'); ?>" onkeypress="return isNumberKey(event)" name="<?php echo $this->get_field_name('excerpt_words_count'); ?>" value="<?php echo $instance['excerpt_words_count']; ?>" type='text' style="width: 100%;" />
			</p>
            <p>
				<label for="<?php echo $this->get_field_id('show_number_of_comments'); ?>"><input type="checkbox" <?php checked($instance['show_number_of_comments'], true) ?> id="<?php echo $this->get_field_id( 'show_number_of_comments' ); ?>" name="<?php echo $this->get_field_name( 'show_number_of_comments' ); ?>" /><?php _e('Show number of comments', 'smart-post-list'); ?></label>
			</p>

            <p>
				<label for="<?php echo $this->get_field_id('show_hr_delimiter'); ?>"><input type="checkbox" <?php checked($instance['show_hr_delimiter'], true) ?> id="<?php echo $this->get_field_id( 'show_hr_delimiter' ); ?>" name="<?php echo $this->get_field_name( 'show_hr_delimiter' ); ?>" /><?php _e('Show post delimiter', 'smart-post-list'); ?></label>
			</p>

            <p>
    			<label for="<?php echo $this->get_field_id('thumb_on_post'); ?>"><?php _e('Show thumbnail on post', 'smart-post-list'); ?></label>
				<select id="<?php echo $this->get_field_id('thumb_on_post'); ?>" name="<?php echo $this->get_field_name('thumb_on_post'); ?>" onchange="onThumbOnPostSelect(this, '<?php echo $this->get_field_id('thumb_image_size');?>'); onThumbOnPostSelect(this, '<?php echo $this->get_field_id('post_image_float');?>');" class="widefat" style="width:100%;">
					<option <?php if ( 'none' == $instance['thumb_on_post'] ) echo 'selected="selected"'; ?>>none</option>
					<option <?php if ( 'all' == $instance['thumb_on_post'] ) echo 'selected="selected"'; ?>>all</option>
					<option <?php if ( 'first' == $instance['thumb_on_post'] ) echo 'selected="selected"'; ?>>first</option>
				</select>
				<em>(<?php _e("Uses post's featured image", 'smart-post-list'); ?>)</em>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('thumb_image_size'); ?>"><?php _e('Image size', 'smart-post-list'); ?></label>
                <select id="<?php echo $this->get_field_id('thumb_image_size'); ?>" name="<?php echo $this->get_field_name('thumb_image_size'); ?>" class="widefat" style="width:100%;">
                    <option <?php if ( 'thumbnail' == $instance['thumb_image_size'] ) echo 'selected="selected"'; ?>>thumbnail</option>
                    <option <?php if ( 'medium' == $instance['thumb_image_size'] ) echo 'selected="selected"'; ?>>medium</option>
                    <option <?php if ( 'large' == $instance['thumb_image_size'] ) echo 'selected="selected"'; ?>>large</option>
                </select>
            </p>
			<p>
				<label for="<?php echo $this->get_field_id('post_image_float'); ?>"><?php _e('Image float:', 'smart-post-list'); ?></label>
				<select id="<?php echo $this->get_field_id('post_image_float'); ?>" name="<?php echo $this->get_field_name('post_image_float'); ?>" class="widefat" style="width:100%;">
					<option <?php if ( 'top_of_excerpt' == $instance['post_image_float'] ) echo 'selected="selected"'; ?> value="top_of_excerpt"><?php _e('top of excerpt'); ?></option>
					<option <?php if ( 'right_of_excerpt' == $instance['post_image_float'] ) echo 'selected="selected"'; ?> value="right_of_excerpt"><?php _e('right of excerpt'); ?></option>
					<option <?php if ( 'left_of_excerpt' == $instance['post_image_float'] ) echo 'selected="selected"'; ?> value="left_of_excerpt"><?php _e('left of excerpt'); ?></option>
					<option <?php if ( 'left_in_excerpt' == $instance['post_image_float'] ) echo 'selected="selected"'; ?> value="left_in_excerpt"><?php _e('left in excerpt'); ?></option>
					<option <?php if ( 'right_in_excerpt' == $instance['post_image_float'] ) echo 'selected="selected"'; ?> value="right_in_excerpt"><?php _e('right in excerpt'); ?></option>
				</select>
			</p>
			<p>
				<div style="width: 50%; float: left;">
					<label for="<?php echo $this->get_field_id('thumb_image_width'); ?>"><?php _e('Image width', 'smart-post-list'); ?></label><br />
					<input id="<?php echo $this->get_field_id('thumb_image_width'); ?>" onkeypress="return isNumberKey(event)" name="<?php echo $this->get_field_name('thumb_image_width'); ?>" value="<?php echo $instance['thumb_image_width']; ?>" type='text' style="width: 70%;" />
				</div>
				<div style="width: 50%; float: left;">
    				<label for="<?php echo $this->get_field_id('thumb_image_height'); ?>"><?php _e('Image height', 'smart-post-list'); ?></label><br />
    				<input id="<?php echo $this->get_field_id('thumb_image_height'); ?>" onkeypress="return isNumberKey(event)" name="<?php echo $this->get_field_name('thumb_image_height'); ?>" value="<?php echo $instance['thumb_image_height']; ?>" type='text' style="width: 70%;" />
				</div>
				<em>(<?php _e('In case of both width and height are set the system will set image width. If you want to set up height leave width empty. So the ration won\'t be lost.', 'smart-post-list'); ?>)</em>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('number_of_columns'); ?>"><?php _e('Number of columns:', 'smart-post-list'); ?></label>
				<select id="<?php echo $this->get_field_id('number_of_columns'); ?>" name="<?php echo $this->get_field_name('number_of_columns'); ?>" class="widefat" style="width:100%;">
					<option <?php if ( '1' == $instance['number_of_columns'] ) echo 'selected="selected"'; ?> value="1"><?php _e('1 column'); ?></option>
					<option <?php if ( '2' == $instance['number_of_columns'] ) echo 'selected="selected"'; ?> value="2"><?php _e('2 column'); ?></option>
					<option <?php if ( '3' == $instance['number_of_columns'] ) echo 'selected="selected"'; ?> value="3"><?php _e('3 column'); ?></option>
					<option <?php if ( '4' == $instance['number_of_columns'] ) echo 'selected="selected"'; ?> value="4"><?php _e('4 column'); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('custom_widget_css_class'); ?>"><?php _e('Custom widget class:', 'smart-post-list'); ?></label>
				<input id="<?php echo $this->get_field_id('custom_widget_css_class'); ?>" class="custom_widget_css_class" name="<?php echo $this->get_field_name('custom_widget_css_class'); ?>" value="<?php echo $instance['custom_widget_css_class']; ?>" type='text' style="width: 100%;" />
				<em>(<?php _e('If you add interval(s) the system will truncate them.', 'smart-post-list'); ?>)</em>
			</p>
		<?php
	}

	/**
	 * Updates the Widget's data.
	 */
    function update($new_instance, $old_instance) {

    	$instance = $old_instance;
    	$instance['title'] = strip_tags($new_instance['title']);
    	$instance['show_title'] = ( isset( $new_instance['show_title'] ) ? 1 : 0 );
    	$instance['show_date'] = ( isset( $new_instance['show_date'] ) ? 1 : 0 );
    	$instance['show_excerpt'] = ( isset( $new_instance['show_excerpt'] ) ? 1 : 0 );
        $instance['show_number_of_comments'] = $new_instance['show_number_of_comments'];
    	$instance['excerpt_words_count'] = $new_instance['excerpt_words_count'];
    	$instance['show_number_of_comments'] = ( isset( $new_instance['show_number_of_comments'] ) ? 1 : 0 );
    	$instance['posts_count'] = $new_instance['posts_count'];
    	$instance['posts_offset'] = $new_instance['posts_offset'];
    	$instance['post_orderby'] = $new_instance['post_orderby'];
    	$instance['post_order_direction'] = $new_instance['post_order_direction'];
    	$instance['authors'] = $new_instance['authors'];
        $instance['thumb_on_post'] = $new_instance['thumb_on_post'];
        $instance['thumb_image_size'] = $new_instance['thumb_image_size'];
        $instance['thumb_image_width'] = $new_instance['thumb_image_width'];
        $instance['thumb_image_height'] = $new_instance['thumb_image_height'];
    	$instance['post_image_float'] = $new_instance['post_image_float'];
        $instance['show_hr_delimiter'] = ( isset( $new_instance['show_hr_delimiter'] ) ? 1 : 0 );
    	$instance['number_of_columns'] = $new_instance['number_of_columns'];
    	$instance['custom_widget_css_class'] = str_replace(' ', '', $new_instance['custom_widget_css_class']);
    	$instance['post_type'] = $new_instance ['post_type'];
    	$instance['post_type_options'] = $new_instance ['post_type_options'];

    	return $instance;
    }

  /**
   * Get's an instance.
   */
    function widget($args, $instance) {
        extract($args);
    	$title = apply_filters('widget_title', $instance['title'] );
    	$show_title = $instance['show_title'];
        $show_date = $instance['show_date'];
    	$show_excerpt = $instance['show_excerpt'];
    	$excerpt_words_count = $instance['excerpt_words_count'];
    	$show_number_of_comments = $instance['show_number_of_comments'];
    	$posts_count = $instance['posts_count'];
    	$post_orderby = $instance['post_orderby'];
    	$post_order_direction = $instance['post_order_direction'];
    	$posts_offset = $instance['posts_offset'];
    	$authors = $instance['authors'];
        $thumb_on_post = $instance['thumb_on_post'];
        $thumb_image_size = $instance['thumb_image_size'];
        $thumb_image_width = $instance['thumb_image_width'];
        $thumb_image_height = $instance['thumb_image_height'];
    	$post_image_float = $instance['post_image_float'];
        $show_hr_delimiter =  $instance['show_hr_delimiter'];
    	$number_of_columns =  (int) $instance['number_of_columns'];
    	$custom_widget_css_class =  $instance['custom_widget_css_class'];
    	$post_type = $instance['post_type'];
    	$post_type_options = $instance['post_type_options'];

    	// Make sure we use only numbers between the permeted.
        if (empty($number_of_columns) || $number_of_columns < 1 || $number_of_columns > 4) {
            $number_of_columns = 1;
        }

        // Remove doubling of widget class in case the theme missed that check
        if (strpos($before_widget, 'widget widget') !== false) {
            $before_widget = preg_replace('/widget widget/', "widget", $before_widget, 1);
        }

        // Adding the custom CSS for the particular Widget Instance
        if (!empty($custom_widget_css_class)) {
            $before_widget = preg_replace('/class="/', "class=\"{$custom_widget_css_class} ", $before_widget, 1);
        }

        echo $before_widget;

    	if ($title) {
            echo $before_title . $title . $after_title;
    	}

        // main div
        $posts_delimiter = '';
        if ($show_hr_delimiter) {
            $posts_delimiter = ' smart-post-list-separator';
        }
        echo '<ul style="    padding-left: 0px;" class="smart-post-list-main' . $posts_delimiter . '">';

    	$category_posts_result = '';

    	if (!isset($authors) || empty($authors)) {
    	    $authors = array();
    	}

    	$category_posts = array();
    	// If no filters were set we return empty posts array.
    	if ((!empty($post_type) && !empty($post_type_options))/* || !empty($authors)*/) {
    	    if (empty($post_type)) {
    	        // If no Post Type was selected we list all the posts for an author, because if no author was selected we wouldn't be here
    	        $post_type = get_post_types(array('show_ui' => true));
    	    }
    	    if (empty($posts_count) || $posts_count == 0) {
    	        $posts_count = -1;
    	    }
    	    $get_posts_arguments =  array( 'post_type' => $post_type,
                                           'posts_per_page' => $posts_count,
                                           'orderby' => $post_orderby,
                                           'order' => $post_order_direction,
                                           'offset' => (int) $posts_offset ,
                                           'author' => join(' ', $authors));

    	    if (!empty($post_type_options)) {
    	        $tax_query_args = array();
        	    foreach ($post_type_options as $taxonomy => $taxonomy_options) {
        	        $tax_query_args[] = array('taxonomy' => $taxonomy,
                    	    				  'field' => 'term_id',
                                			  'terms' => $taxonomy_options);
        	    }
        	    $tax_query_args['relation'] = 'OR';
        	    $get_posts_arguments['tax_query'] = $tax_query_args;
    	    }
            $category_posts = new WP_Query($get_posts_arguments);
    	}
    	
    	if ($category_posts) {
            $first = true;

            // Looping all posts for the front end.
    		$i = 1;
            foreach($category_posts->posts as $post) {
           		// Width for columns version.
                $single_container_style_width = 100 / $number_of_columns;

                $single_container_style_clear_left = '';
                if ($i % $number_of_columns == 0) {
                    $single_container_style_clear_left = ' clear: right;';
                }

                $category_posts_result .= '<li class="smart-post-list-single-container" style="list-style: none!important;width:100%">';
                $thumb_info = array();

           		// Create the HTML for the post Image Start
           		$category_posts_img = '';
           		switch ($thumb_on_post) {
                    case 'all':
                        $thumb_info = $this->add_img($post, $thumb_image_size, $thumb_image_width, $thumb_image_height);
                        $category_posts_img = $thumb_info[0];
       		        break;
    			    case 'first':
                        if ($first)
                        {
                            $thumb_info = $this->add_img($post, $thumb_image_size, $thumb_image_width, $thumb_image_height);
                            $category_posts_img = $thumb_info[0];
                            $first = false;
                        }
                        break;
                }
                // Create the HTML for the post Image End

        		$open_div_image = '';
                $close_div_image = '';
                $open_div_text = '';
                $close_div_text = '';

                if ($thumb_on_post != 'none') {
                    switch ($post_image_float) {
                        case 'top_of_excerpt':
                            $open_div_text = '<div class="text-top-of-excerpt">';
                            $close_div_text = '</div>';
                            $open_div_image = '<div class="image-top-of-excerpt img-container"' . $thumb_info[1] . '>';
                            $close_div_image = '</div>' . $open_div_text;
                            break;

                        case 'right_of_excerpt':
                            $open_div_text = '<div class="text-right-of-excerpt">';
                            $close_div_text = '</div>';
                            $open_div_image = '<div class="image-right-of-excerpt img-container"' . $thumb_info[1] . '>';
                            $close_div_image = '</div>' . $open_div_text;
                            break;

                        case 'left_of_excerpt':
                            $open_div_text = '<div class="text-left-of-excerpt">';
                            $close_div_text = '</div>';
                            $open_div_image = '<div style="float: left;margin-right: 5px;" class="image-left-of-excerpt img-container"' . $thumb_info[1] . '>';
                            $close_div_image = '</div>' . $open_div_text;
                            break;

                        case 'left_in_excerpt':
                            $open_div_text = '<div class="text-left-in-excerpt">';
                            $close_div_text = '</div>';
                            $open_div_image =  $open_div_text . '<div class="image-left-in-excerpt img-container"' . $thumb_info[1] . '>';
                            $close_div_image = '</div>';
                            break;

                        case 'right_in_excerpt':
                            $open_div_text = '<div class="text-right-in-excerpt">';
                            $close_div_text = '</div>';
                            $open_div_image = $open_div_text . '<div class="image-right-in-excerpt img-container"' . $thumb_info[1] . '>';
                            $close_div_image = '</div>';
                            break;
                    }

               		$category_posts_result .= $open_div_image;
               		$category_posts_result .= $category_posts_img;
                    $category_posts_result .= $close_div_image;
                }

                // Create the HTML for the post Text Start
                if ($show_title) {
                    $category_posts_result .= $this->add_title($post);
                }

                if ($show_date) {
                    $category_posts_result .= $this->add_date($post);
                }

                if ($show_number_of_comments) {
                    $category_posts_result .= $this->add_comments_num($post);
                }

                if ($show_excerpt) {
                    if (has_excerpt($post->ID)) {
                        $category_posts_result .= $this->add_excerpt($post, $excerpt_words_count);
                    } else {
                        $category_posts_result .= $this->add_content($post, $excerpt_words_count);
                    }
                }
                $category_posts_result .= $close_div_text;
                // Create the HTML for the post Text End

                $category_posts_result .= '</li>';

                if ($show_hr_delimiter) {
                    if ($i % $number_of_columns == 0) {
                        $category_posts_result .= '<li class="smart-post-list-delimiter"></li>';
                    } else if ($i % $number_of_columns <> 0 && $i == count($category_posts->posts)) {
                        $category_posts_result .= '<li class="smart-post-list-delimiter"></li>';
                    }
                }

                $i++;
            }
    	} else {
    		$category_posts_result .= _e("No posts found in this category", 'smart-post-list');
    	}

    	echo $category_posts_result;
    	echo '</ul>';
    	echo $after_widget;
    }

    /**
     * Adds Post Title.
     */
    function add_title($post) {
        $result = '';
		$result .= '<a href="' . get_permalink($post->ID) . '" class="smart-post-list-title" id="sml-titleid"><div class="hover-item">' . $post->post_title . '</div></a>';

		return $result;
    }

    /**
     * Adds Post Date.
     */
    function add_date($post) {
        $result = '';
        $result .= '<p class="smart-post-list-date" style="border-bottom: 1px dotted #D5D0C0;	font-size: 9pt;    color: #696969;">' . date(get_option('date_format'), strtotime($post->post_date)) . '</p>';

		return $result;
    }

    /**
     * Adds Post Comments.
     */
    function add_comments_num($post) {
        $result = '';
        $result .= '<p class="smart-post-list-comments"><a href="' . get_permalink($post->ID) . '#comments">' . __('Comments', 'post-in-category') . ': ' . (string)$post->comment_count . '</a></p>';

        return $result;
    }

    /**
     * Adds Post Content.
     */
	function add_content($post, $words_count) {
		$content = $this->prepare_content($post->post_content, $words_count);

        $result = '';
		$result .= '<p class="smart-post-list-excerpt">' . $content . '</p>';

		return $result;
	}

	/**
	 * Prepares the content for the posts list.
	 */
    function prepare_content($content, $words_count) {
        $content = strip_tags($content);
        $content = str_replace('&nbsp;', ' ', $content);
        $content = explode(" ", $content);

		if ($words_count < count($content))
		{
			$content = array_slice($content, 0, $words_count);
			array_push($content, "...");
		}
		$content = join(" ", $content);

        return $content;
    }

    /**
     * Getting the Excerpt parameter for post content.
     */
	function add_excerpt($post, $words_count) {
		$content = $this->prepare_content($post->post_excerpt, $words_count);

		$result = '';
		$result .= '<p class="smart-post-list-excerpt">' . $content . '</p>';

		return $result;
	}

	/**
	 * Add an Image to the post in the list.
	 */
	function add_img($post, $thumb_image_size, $thumb_image_width, $thumb_image_height) {
 	    $size = 'full';
        switch ($thumb_image_size) {
            case 'thumbnail':
                $size = 'thumbnail';
                break;
            case 'medium':
                $size = 'medium';
                break;
        }

        // Decide which HTML attribute for <img /> tag to set based on the Widget configuration
	    if (!empty($thumb_image_width) && !empty($thumb_image_height)) {
            $thumb_image_html_size = ' width="' . $thumb_image_width . '"';
            // IE8 fix.
            $thumb_container_style = ' style="width: ' . ($thumb_image_width + 5) . 'px;"';
        } else if (!empty($thumb_image_width) && empty($thumb_image_height)) {
            $thumb_image_html_size = ' width="' . $thumb_image_width . '" style="width: ' . $thumb_image_width . 'px;"';
            // IE8 fix.
            $thumb_container_style = ' style="width: ' . ($thumb_image_width + 5) . 'px;"';
        } else if (empty($thumb_image_width) && !empty($thumb_image_height)) {
            $thumb_image_html_size = ' height="' . ($thumb_image_height + 5) . '" style="height: ' . $thumb_image_height . 'px;"';
            // IE8 fix.
            $thumb_container_style = ' style="height: ' . ($thumb_image_height + 5) . 'px;"';
        } else {
            $thumb_image_html_size = '';
            // IE8 fix.
            $thumb_container_style = '';
        }

        $result = '';
        // Get the Post's Featured Image ID
        $attachment_id = get_post_thumbnail_id($post->ID);
        if ($attachment_id) {
            // Get the Post's Featured Image data
            $image_url = wp_get_attachment_image_src($attachment_id, $size);
            // IE8 fix.
            if (empty($thumb_container_style)) {
                $thumb_container_style = ' style="width: ' . ($image_url[1] + 5) . 'px;"';
            } else if (strpos($thumb_container_style, 'width:') === false) {
                $thumb_container_style = substr($thumb_container_style, 0, -1);
                $thumb_container_style .= ' width: ' . ($image_url[1] + 5) . 'px;"';
            }
            $result = '<a href="' . get_permalink($post->ID) . '"><img src="' . $image_url[0] . '" class="smart-post-list-image"' . $thumb_image_html_size . '></a>';
        }

        $result_array = array($result, $thumb_container_style);

		return $result_array;
	}
}

/**
 * Loading CSS and JS for the Widget.
 */
function post_in_category_init()
{
    wp_register_style('splw.css', SMART_POST_LIST_PLUGIN_URL . 'splw.css');
	wp_enqueue_style('splw.css');

    if (!is_admin()) {
        if (wp_script_is('jquery') === false) {
            wp_enqueue_script('jquery');
        }

        wp_register_script('splw.js', SMART_POST_LIST_PLUGIN_URL . 'splw.js');
        wp_enqueue_script('splw.js');
    }else{
	wp_register_script('splw_admin.js', SMART_POST_LIST_PLUGIN_URL . 'splw_admin.js');
	wp_enqueue_script('splw_admin.js');
    }

  	return register_widget("PostInCategory");
}

// Register hooks
add_action('admin_print_scripts', 'add_script');
add_action('admin_head', 'add_script_config');
add_action('admin_head', 'get_taxonomy_options');
add_action('wp_ajax_get_taxonomy_options', 'get_taxonomy_options_callback');

/**
 * Add script to admin page
 */
function add_script() {}

/**
 * Add script to admin page
 */
function add_script_config()
{
?>
    <script type="text/javascript">
    function isNumberKey(event) {
        var charCode = (event.which) ? event.which : event.keyCode;
        if (charCode < 32) return true;
        if (charCode > 47 && charCode < 58) return true;
        return false;
    }

    function onThumbOnPostSelect(list, inputId) {
        var input = document.getElementById(inputId)
        if (list.selectedIndex > 0) {
            input.disabled = false
        } else {
            input.blur()
            input.disabled = true
        }
    }

    // Validate whether the Custom Widget Class Name provided by the customer is a valid name.
    jQuery(function () {
    	jQuery(".custom_widget_css_class").blur(function () {
        	if (!jQuery(this).val().match(/^-?[_a-zA-Z]+[_a-zA-Z0-9-]*$/i)) {
            	alert("<?php echo _e('Please enter a valid Class Name.', 'smart-post-list'); ?>");
        	}
    	});
    });
    </script>
<?php
}

/**
 * Gets all options for a taxonomy via AJAX.
 */
function get_taxonomy_options() {
?>
<script type="text/javascript" >
jQuery(document).ready(function($) {
	 jQuery('.hide-if-no-js').click(function () {
		 performAJAXCallOnPageLoad001(jQuery(this).parents('.widget').find('select'), jQuery(this).parents('.widget').find('select').parent().find('.this_widget_iteration').val());
		 jQuery(this).unbind('click');
	 });

    jQuery('.post_type select').change(function () {
    	performAJAXCallOnPostTypeChange(jQuery(this));
    });
});

function performAJAXCallOnPostTypeChange (thisDropDown) {
    var data = {
		action: 'get_taxonomy_options',
		post_type: jQuery(thisDropDown).val(),
		categories_serialized: jQuery(thisDropDown).parent().find('.categories_serialized').val(),
		authors_serialized: jQuery(thisDropDown).parent().find('.authors_serialized').val(),
		this_widget_iteration: jQuery(thisDropDown).parent().find('.this_widget_iteration').val(),
		this_widget_iteration_name: jQuery(thisDropDown).parent().find('.this_widget_iteration_name').val()
	};

	jQuery.ajax({
		url: ajaxurl,
		data: data,
		type: 'POST',
		success: function(response) {
			jQuery(thisDropDown).parent().find('.smart-post-lists-admin-taxonomies').html(response);
		}
	});
}

function performAJAXCallOnPageLoad () {
    jQuery.each(jQuery('.post_type select'), function (index, value) {
        // Skip the base one which is not in any widget.
        if (jQuery(this).parent().find('.this_widget_iteration').val() != '__i__') {
        	var thisDropDown = jQuery(this);
        	var data = {
    			action: 'get_taxonomy_options',
    			post_type: jQuery(this).val(),
    			categories_serialized: jQuery(this).parent().find('.categories_serialized').val(),
    			authors_serialized: jQuery(this).parent().find('.authors_serialized').val(),
    			this_widget_iteration: jQuery(this).parent().find('.this_widget_iteration').val(),
    			this_widget_iteration_name: jQuery(this).parent().find('.this_widget_iteration_name').val()
    		};

        	jQuery.post(ajaxurl, data, function(response) {
        		jQuery(thisDropDown).parent().find('.smart-post-lists-admin-taxonomies').html(response);
        	});
        }
    });
}

function performAJAXCallOnPageLoad001 (thisDropDown, this_widget_iteration) {
	// var thisDropDown = jQuery(thisDropDown);
	var data = {
		action: 'get_taxonomy_options',
		post_type: jQuery(thisDropDown).val(),
		categories_serialized: jQuery(thisDropDown).parent().find('.categories_serialized').val(),
		authors_serialized: jQuery(thisDropDown).parent().find('.authors_serialized').val(),
		this_widget_iteration: this_widget_iteration,
		this_widget_iteration_name: jQuery(thisDropDown).parent().find('.this_widget_iteration_name').val()
	};

	jQuery.ajax({
		url: ajaxurl,
		data: data,
		type: 'POST',
		success: function(response) {
    		jQuery(thisDropDown).parent().find('.smart-post-lists-admin-taxonomies').html(response);
		}
	});
}
</script>
<?php
}
/**
 * Base HTML for the Post Type Taxonomy Options list in the Admin part of the Widget.
 */
function get_taxonomy_options_callback() {
	global $wpdb; // this is how you get access to the database

	$return = '';
	$authors_serialized = array();
	$post_type_taxonomies = get_object_taxonomies(array('post_type' => $_POST['post_type']), 'objects');
	foreach ($post_type_taxonomies as $post_type_taxonomy){
	    $selectedPost_type_taxonomy_option = array();
	    $categories_serialized = unserialize(urldecode($_POST['categories_serialized']));
	    $authors_serialized = unserialize(urldecode($_POST['authors_serialized']));
		if (is_array($categories_serialized)) {
		    if (!empty($categories_serialized[$post_type_taxonomy->name])) {
			    $selectedPost_type_taxonomy_option = $categories_serialized[$post_type_taxonomy->name];
		    }
		}

		$cattree = array();
		$post_type_taxonomy_options = get_terms($post_type_taxonomy->name);

		$post_type_taxonomy_option_info = array();
		foreach ($post_type_taxonomy_options as $post_type_taxonomy_option) {
			$id = $post_type_taxonomy_option->term_id;
			$data = array('name' => $post_type_taxonomy_option->name,
						  'count' => $post_type_taxonomy_option->count,
						  'parent' => $post_type_taxonomy_option->parent,
						  'childs' => array());
			$post_type_taxonomy_option_info[$id] = $data;
		}

		foreach ($post_type_taxonomy_option_info as $id => $post_type_taxonomy_option) {
			$parent_id = $post_type_taxonomy_option['parent'];
			if ($parent_id > 0) {
				$post_type_taxonomy_option_info[$parent_id]['childs'][$id] = $post_type_taxonomy_option;
			}
		}

		if (!empty($post_type_taxonomy_option_info)) {
    	    $return .= '<fieldset class="smart-post-lists-admin-fieldset">';
    	    $return .= '<legend>';
    	    $return .= $post_type_taxonomy->label;
    	    $return .= '</legend>';
    	    $return .= '<ul class="checklist">';

        	foreach ($post_type_taxonomy_option_info as $id => $post_type_taxonomy_option) {
        		if ($post_type_taxonomy_option['parent'] == 0) {
        			$return .= add_post_type_taxonomy_option_node($post_type_taxonomy, $selectedPost_type_taxonomy_option, $id, $post_type_taxonomy_option, '', '', $_POST['this_widget_iteration'], $_POST['this_widget_iteration_name']); // recursive
        		}
        	}

            $return .= '</ul>';
            $return .= '</fieldset>';
		}
	}

	// Get All Authors for this post type
	$this_widget_iteration_id_name = $_POST['this_widget_iteration_name'] . '[' . $_POST['this_widget_iteration'] . ']';
	$return .= get_all_authors_as_html($authors_serialized, $this_widget_iteration_id_name, $_POST['post_type']);

	echo $return;

	die(); // this is required to return a proper result
}

/**
 * HTML for the Post Type Taxonomy Options list in the Admin part of the Widget.
 *
 * @param $post_type_taxonomy - Object - The Post Type Taxonomy
 * @param $selectedPost_type_taxonomy_options - Array -  The options of the Post Type Taxonomy that were previously selected by the Customer to indicate to check them
 * @param $ptto_id - Int - The option ID of the Option of the particular Post Type
 * @param $post_type_taxonomy_option - Array - The Option of the Post Type
 * @param $indent - String - The Indent that will be used to indicate the child-parent relationship
 * @param $options - String - HTML code for the Checkboxes in the admin for the possible options
 * @param $this_widget_iteration - String - The Number of the particular widget instance of SPLW in the Client's system
 * @param $this_widget_iteration_name - String - "widget-" plus the id base of the plugin so we could use it in the AJAX call to create the Checkobxes' names and IDs of the HTML element
 */
function add_post_type_taxonomy_option_node($post_type_taxonomy, $selectedPost_type_taxonomy_options, $ptto_id, $post_type_taxonomy_option, $indent = '', $options = '', $this_widget_iteration = '', $this_widget_iteration_name = '') {
	$this_widget_iteration_id_name = $this_widget_iteration_name . '[' . $this_widget_iteration . ']';
    $option = '<li>' . $indent;
	$option .= '<input type="checkbox" id="' . $this_widget_iteration_id_name . '[post_type_options][' . $post_type_taxonomy->name . '][]" name="' . $this_widget_iteration_id_name . '[post_type_options][' . $post_type_taxonomy->name . '][]"';

	$get_posts_arguments =  array('post_type' => $_POST['post_type'],
	                              'posts_per_page' => '-1' // Get All the posts so we could count them
	                        );

    $tax_query_args = array('taxonomy' => $post_type_taxonomy->name,
	    				    'field' => 'term_id',
            			    'terms' => $ptto_id);
    $get_posts_arguments['tax_query'] = array($tax_query_args);
    $category_posts = new WP_Query($get_posts_arguments);

    $posts_cnt = count($category_posts->posts);

	foreach ($selectedPost_type_taxonomy_options as $selectedPost_type_taxonomy_option) {
	    if ($selectedPost_type_taxonomy_option == $ptto_id) {
			$option .= ' checked="checked"';
		}
	}

	$option .= ' value="' . $ptto_id . '" />';
	$option .= $post_type_taxonomy_option['name'];
	$option .= ' (' . $posts_cnt . ')';
	$option .= '</li>';

	$options .= $option;

	foreach ($post_type_taxonomy_option['childs'] as $child_id => $child) {
		add_post_type_taxonomy_option_node($post_type_taxonomy, $selectedPost_type_taxonomy_options, $child_id, $child, $indent . '&nbsp;&nbsp;&nbsp;&nbsp;', $options, $this_widget_iteration, $this_widget_iteration_name);
	}

	return $options;
}

/**
 * Getting HTML for all authors for admin.
 */
function get_all_authors_as_html($authors_serialized, $this_widget_iteration_id_name, $post_type = 'post') {
    global $wpdb;
	$authors_html = '';
	if (empty($authors_serialized) && !is_array($authors_serialized)) {
	    $authors_serialized = array();
	}
	$user_ids = $wpdb->get_results("SELECT u.ID, COUNT( posts.ID ) AS posts_count
									   FROM $wpdb->users u

									   LEFT JOIN $wpdb->usermeta um
									   ON u.ID = um.user_id

									   LEFT JOIN $wpdb->posts posts
									   ON posts.post_author = u.ID

									   WHERE um.meta_key = '" . $wpdb->prefix . "capabilities'
									     AND um.meta_value <> 'a:1:{s:10:\"subscriber\";s:1:\"1\";}'
									     AND posts.post_type = '" . $post_type . "'

									   GROUP BY u.ID

									   ORDER BY u.ID ASC");

	$authors_html .= '<fieldset class="smart-post-lists-admin-fieldset">';
    $authors_html .= '<legend>' . __('Authors', 'smart-post-list') . '</legend>';
	$authors_html .= '<ul class="checklist">';

	foreach($user_ids as $user_row) {
		$user = get_userdata($user_row->ID);
		if ($user->wp_capabilities != 'subscriber') {
		    $posts_count = $user_row->posts_count;
        	$authors_html .= add_author_node($authors_serialized, $user_row->ID, $user, $this_widget_iteration_id_name, $posts_count);
		}
	}

	$authors_html .= '</ul>';
	$authors_html .= '</fieldset>';

	return $authors_html;
}

/**
 * Add HTML node for the Authors list in the Admin part of the Widget.
 */
function add_author_node($selectedAuthors, $author_id, $author, $this_widget_iteration_id_name, $posts_count) {
	$option = '<li>';
	$option .= '<input type="checkbox" id="'. $this_widget_iteration_id_name .'[authors][]" name="'. $this_widget_iteration_id_name .'[authors][]"';

	foreach ($selectedAuthors as $selectedAuthor) {
		if ($selectedAuthor == $author_id) {
			$option .= ' checked="checked"';
		}
	}

	$option .= ' value="' . $author_id . '" />';
	$option .= $author->first_name . ' ' . $author->last_name . ' (' . $author->user_login . ') ' . '(' . $posts_count . ')';

	$post_types = get_post_types(array('show_ui' => true));
	$get_posts_arguments =  array('post_type' => $post_types,
	                              'posts_per_page' => '-1' // Get All the posts so we could count them
	                        );
	$option .= '</li>';
	return $option;
}

add_action( 'widgets_init', 'post_in_category_init' );?>