<?php
// add shortcode generator page
function lshowcase_shortcode_page_add()
{
	$menu_slug = 'edit.php?post_type=lshowcase';
	$submenu_page_title = 'Shortcode Generator';
	$submenu_title = 'Shortcode Generator';
	$capability = 'manage_options';
	$submenu_slug = 'logoiframe';
	$submenu_function = 'logoiframe_page';
	$defaultp = add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
	add_action($defaultp, 'lshowcase_enqueue_admin_js' );
}

function lshowcase_enqueue_admin_js()
{
	wp_deregister_script( 'lshowcaseadmin' );
	wp_register_script( 'lshowcaseadmin', plugins_url( '/js/shortcode-builder.js', __FILE__) , array(
		'jquery'
	));
	wp_enqueue_script( 'lshowcaseadmin' );
	wp_deregister_style( 'lshowcase-main-style' );
	wp_register_style( 'lshowcase-main-style', plugins_url( '/styles.css', __FILE__) , array() , false, false);
	wp_enqueue_style( 'lshowcase-main-style' );

	// in javascript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value

	wp_localize_script( 'lshowcaseadmin', 'ajax_object', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));
	wp_deregister_script( 'lshowcase-bxslider' );
	wp_register_script( 'lshowcase-bxslider', plugins_url( '/bxslider/jquery.bxslider.js', __FILE__) , array(
		'jquery'
	) , false, false);
	wp_enqueue_script( 'lshowcase-bxslider' );
	wp_deregister_style( 'lshowcase-bxslider-style' );
	wp_register_style( 'lshowcase-bxslider-style', plugins_url( '/bxslider/jquery.bxslider.css', __FILE__) , array() , false, false);
	wp_enqueue_style( 'lshowcase-bxslider-style' );
	wp_deregister_script( 'ls-jquery-ui' );
	wp_register_script( 'ls-jquery-ui', plugins_url( '/js/jquery-ui-1.10.2.custom.min.js', __FILE__) , array(
		'jquery'
	) , false, false);
	wp_enqueue_script( 'ls-jquery-ui' );
	wp_deregister_script( 'lshowcase-tooltip' );
	wp_register_script( 'lshowcase-tooltip', plugins_url( '/js/tooltip.js', __FILE__) , array(
		'ls-jquery-ui'
	) , false, false);
	wp_enqueue_script( 'lshowcase-tooltip' );

	wp_deregister_script( 'lshowcase-jgrayscale' );
	wp_register_script( 'lshowcase-jgrayscale', plugins_url( '/js/grayscale.js', __FILE__) , array(
		'jquery'
	) , false, false);
	wp_enqueue_script( 'lshowcase-jgrayscale' );

}

add_action( 'wp_ajax_lshowcase', 'lshowcase_run_preview' );

function lshowcase_run_preview()
{
	$orderby = $_POST['porder'];
	$category = $_POST['pcategory'];
	$activeurl = $_POST['purl'];
	$style = $_POST['pstyle'];
	$interface = $_POST['pinterface'];
	$tooltip = $_POST['ptooltip'];
	$limit = $_POST['plimit'];
	$slidersettings = "";
	$img = $_POST['pimg'];
	$html = build_lshowcase($orderby, $category, $activeurl, $style, $interface, $tooltip, $limit, $slidersettings, $img);
	echo $html;
	die(); // this is required to return a proper result
}

function lshowcase_shortcode_page()
{ 
	settings_fields( 'lshowcase-plugin-settings' );
	$options = get_option( 'lshowcase-settings' );
	
	?>
	

	  <?php echo build_lshowcase('name','doi-tac','new','normal','hcarousel','false','100','','0'); ?>
    
    
<?php
	$options = get_option( 'lshowcase-settings' );
	$mode = "'horizontal'";
	$slidewidth = $options['lshowcase_thumb_width'];
	
	$autoscroll = $options['lshowcase_carousel_autoscroll'];
	$pausetime = $options['lshowcase_carousel_pause'];
	$autohover = $options['lshowcase_carousel_autohover'];
	$pager = $options['lshowcase_carousel_pager'];
	$tickerhover = $autohover;
	$ticker = 'false';
	$usecss = 'true';
	$auto = 'true';

	if ($autoscroll == 'false') {
		$auto = 'false';
	}

	if ($autoscroll=='ticker') {
		$ticker = 'true';
		$tickerhover = $autohover;
		$autoscroll = 'true';
		$pager = 'false';
		$auto = 'false';
		
		if ($tickerhover=='true') {
			$usecss = 'false';
		} 
	}

	$autocontrols = $options['lshowcase_carousel_autocontrols'];
	$speed = $options['lshowcase_carousel_speed'];
	$slidemargin = $options['lshowcase_carousel_slideMargin'];
	$loop = $options['lshowcase_carousel_infiniteLoop'];
	$controls = $options['lshowcase_carousel_controls'];
	$minslides = $options['lshowcase_carousel_minSlides'];
	$maxslides = $options['lshowcase_carousel_maxSlides'];
	$moveslides = $options['lshowcase_carousel_moveSlides'];



?>
<script type="text/javascript">

	
	
	function checkslider()
	{
	
		 
		 var layout = document.getElementById( 'interface' ).value;

		 

		if(document.getElementsByName('use_defaults')[1].checked) { 

			
			var slidewidth = <?php echo $slidewidth; ?>;

			var imgwo = document.getElementsByName('lshowcase_image_size_overide')[0].value;
			if (imgwo!="") {

				 var imgwarray = imgwo.split(",");
				 slidewidth = parseInt(imgwarray[0]);
			};

			var autoscroll = document.getElementsByName('lshowcase_carousel_autoscroll')[0].value;
			var pause = parseInt(document.getElementsByName('lshowcase_carousel_pause')[0].value);
			
			var autohover = (document.getElementsByName('lshowcase_carousel_autohover')[0].value === 'true');
			var pager = (document.getElementsByName('lshowcase_carousel_pager')[0].value === 'true');

			

			var tickerhover = autohover;
			var ticker = false;			
			var usecss = true;
			var auto = true;


			if (autoscroll == 'false') {
				auto = false;
			}

			if (autoscroll=='ticker') {
				ticker = true;
				tickerhover = autohover;
				pager = false;
				auto = false;
				
				if (tickerhover==true) {
					usecss = false;
				} 
			}


			var autocontrols = (document.getElementsByName('lshowcase_carousel_autocontrols')[0].value === 'true');
			var speed = parseInt(document.getElementsByName('lshowcase_carousel_speed')[0].value);
			var slidemargin = parseInt(document.getElementsByName('lshowcase_carousel_slideMargin')[0].value);
			var infiniteloop = (document.getElementsByName('lshowcase_carousel_infiniteLoop')[0].value === 'true');
			
			var controls = (document.getElementsByName('lshowcase_carousel_controls')[0].value === 'true');
			var minslides = parseInt(document.getElementsByName('lshowcase_carousel_minSlides')[0].value);
			var maxslides = parseInt(document.getElementsByName('lshowcase_carousel_maxSlides')[0].value);
			var moveslides = parseInt(document.getElementsByName('lshowcase_carousel_moveSlides')[0].value);

		}


		else {

			 var mode = <?php echo $mode; ?>;
			 var slidewidth = <?php echo $slidewidth; ?>;
			 var auto = <?php echo $auto; ?>;
			 var pause = <?php echo $pausetime; ?>;
			 var autohover = <?php echo $autohover; ?>;
			 var ticker = <?php echo $ticker; ?>;
			 var tickerhover = <?php echo $tickerhover; ?>;
			 var usecss = <?php echo $usecss; ?>;
			 var autocontrols = <?php echo $autocontrols; ?>;
			 var speed = <?php echo $speed; ?>;
			 var slidemargin = <?php echo $slidemargin; ?>;
			 var infiniteloop = <?php echo $loop; ?> ;
			 var pager = <?php echo $pager; ?>;
			 var controls = <?php echo $controls; ?>;		 
			 var minslides = <?php echo $minslides; ?>;
			 var maxslides = <?php echo $maxslides; ?>;
			 var moveslides = <?php echo $moveslides; ?>;
		}
	
	if(layout=="hcarousel" ) {

		 var sliderDiv = jQuery( '.lshowcase-wrap-carousel-0' );

		sliderDiv.fadeIn('slow');
			
		sliderDiv.bxSlider({
		
			auto: auto,		
			pause: pause,
			autoHover: autohover,
			ticker: ticker,
			tickerHover: tickerhover,
			useCSS: usecss,
			autoControls: autocontrols,
			mode: mode,
			speed: speed,
			slideMargin: slidemargin,
			infiniteLoop: infiniteloop,
		    pager: pager, 
			controls: controls,
		    slideWidth: slidewidth+20,
		    minSlides: minslides,
		    maxSlides: maxslides,
		    moveSlides: moveslides,
		    autoDirection: 'next'	//change to 'prev' if you want to reverse order

			});
		}

		
	}
	
	
	function checktooltip() {
		
	var tooltip = document.getElementById( 'tooltip' ).value;
	
	if(tooltip=="true" || tooltip=="true-description") {
		
			jQuery( '.lshowcase-tooltip' ).tooltip({
			content: function () { return jQuery(this).attr('title') },
			position: {
			my: "center bottom-20",
			at: "center top",
			using: function( position, feedback ) {
			jQuery( this ).css( position );
			jQuery( "<div>" )
			.addClass( "lsarrow" )
			.addClass( feedback.vertical )
			.addClass( feedback.horizontal )
			.appendTo( this );
			}
			}
			});
		}

	}

	function checkgrayscale() {
		
		
		jQuery(".lshowcase-jquery-gray").fadeIn(500);
		
		// clone image
		jQuery('.lshowcase-jquery-gray').each(function(){
			var el = jQuery(this);
			el.css({"position":"absolute"}).wrap("<div class='img_wrapper' style='display: inline-block'>").clone().addClass('ls_img_grayscale').css({"position":"absolute","z-index":"998","opacity":"0"}).insertBefore(el).queue(function(){
				var el = jQuery(this);
				el.parent().css({"width":this.width,"height":this.height});
				el.dequeue();
			});
			this.src = ls_grayscale(this.src);
		});
		
		// Fade image 
		jQuery('.lshowcase-jquery-gray').mouseover(function(){
			jQuery(this).parent().find('img:first').stop().animate({opacity:1}, 1000);
		})
		jQuery('.ls_img_grayscale').mouseout(function(){
			jQuery(this).stop().animate({opacity:0}, 1000);
		});		
	
	}
	
	
	
	 </script>
     <?php
}
?>