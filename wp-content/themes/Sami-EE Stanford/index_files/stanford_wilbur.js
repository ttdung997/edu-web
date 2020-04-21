(function ($) {

if( window.localStorage.getItem('greetee') == null ) {
  window.localStorage.setItem('greetee', '1');
  console.group('Electrical Engineering');
  console.info('Hello there developer.');
  console.groupEnd();
}

Drupal.behaviors.stanford_wilbur = {

  attach: function (context, settings) {
    console.group('Electrical Engineering Drupal');
   // jQuery(window).on('load resize', function(e) {
   //   if( jQuery('#views_slideshow_cycle_div_featured_slider-block_0').length > 0 || jQuery('img.sidebar-resize').length > 0 ) {
   //     if( jQuery('#views_slideshow_cycle_div_featured_slider-block_0').length > 0 ) {
   //       jQuery('#block-menu-menu-user-path').css('height', jQuery('#views_slideshow_cycle_div_featured_slider-block_0').height() - 44 );
   //     } else {
   //       jQuery('#block-menu-menu-user-path').css('cssText', 'min-height:' + (jQuery('img.sidebar-resize').height() - 24) + 'px !important' );
   //     }
   //   }
   // });
   setTimeout(
     function() {
    if( jQuery('.vco-message').length > 0 ) {
        jQuery('.vco-explainer').fadeOut(3000);
//      jQuery('.vco-bezel').height('88px');
//      jQuery('.vco-message').append('<p>Click to dismiss</p>');
      
    } }, 3000);
    if( jQuery('#field-abstract').length > 0 ) {
      console.info('Starting jQuery niceScroll');
      jQuery('video').removeAttr('width');
      jQuery('#field-abstract-trunc .field .field-items .field-item').css({'overflow':'scroll', 'max-height':'306px'});
      jQuery('#field-abstract-trunc .field .field-items .field-item').niceScroll({
        cursorcolor:"#FBFAF6",
        autohidemode:false,
        cursorborder:'1px solid #d5d2c5',
        cursorwidth:12,
        cursorborderradius:3,
        mousescrollstep:20,
        bouncescroll:true,
        railpadding:{
          left:20
        }
      })
      console.info('Ending jQuery niceScroll');
    }

   /* jQuery(window).on('load', function(e) {
      e.preventDefault();
      setTimeout(function() {
        if( jQuery('.media-image.media-shadow').length > 0 ) {
          var $thumb = jQuery('.media-image.media-shadow img').clone();
          jQuery('div.thumbnail.thumb-photo img').remove();
          jQuery('div.thumbnail.thumb-photo').append($thumb);
        }
      }, 1200);
    }); */
   /* jQuery(document).on('click', '.media-image.media-shadow', function(e) {
      e.preventDefault();
      if( jQuery('.media-image.media-shadow').length > 0 ) {
        var $thumb = jQuery('.media-image.media-shadow img').clone();
        jQuery('div.thumbnail.thumb-photo img').remove();
        jQuery('div.thumbnail.thumb-photo').append($thumb);
      }
    }); */
    jQuery(window).on('keyup', function(e) {

      if( e.keyCode == 27 ) {
        jQuery('div.tabs .nav.nav-tabs').slideToggle();
        jQuery('#admin-menu, #admin-shortcuts').fadeToggle();
        if( jQuery('html body.admin-menu').css('margin-top') == '0px') {
          jQuery('html body.admin-menu').css('cssText','margin-top:29px !important');
        } else {
          jQuery('html body.admin-menu').css('cssText','margin-top:0px !important');
        }
      }
    });
    console.groupEnd();
  }

}

}(jQuery) );
