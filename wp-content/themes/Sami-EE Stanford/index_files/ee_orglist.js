// ee_orglist/js/ee_orglist.js
// default javascript for ee_orglist module

(function($) {

  if( jQuery('.page-people-faculty').length > 0 ) {
    if( !jQuery('select[name=area] option:selected').text().match('-- Show All --') ) {
      jQuery('.page-people-faculty h1.title').append( ' / <small>' + jQuery('select[name=area] option:selected').text() + '</small>' );
    }
  }

  if( jQuery('#ee-orglist-mail-admin').length > 0) { // Fancy autosize for admin form.
      jQuery.getScript('https://cdnjs.cloudflare.com/ajax/libs/autosize.js/1.18.4/jquery.autosize.min.js')
        .done(function(data) {
          jQuery('textarea').on('focus', function(){
            jQuery(this).autosize().css('transition', 'height 0.8s');
          });
        });
  }

  if( $('#sort_form').length > 0 ) { // Autosubmit function for people lists
    if(chosen) { // Is chosen active?
      if(jQuery('select').chosen) { // Are we already using the chosen module, or javascript
        setTimeout(function(){
          jQuery('select').not('.chosen-processed').chosen({
            disable_search:true,
            width:'100%'
          });
        }, 10);
      } else { // No?  Load from cdn
        jQuery.getScript('https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js')
          .done(function(data) {
            jQuery("#sort_form select").chosen({
              disable_search_threshold: 10,
              width: '100%'
            });
          })
          .error(function(data) {
            console.error(Drupal.t('There was an error enabling chosen!'));
          });
      }
    }
    search = document.location.href.split('&') // Clean up the URL
    if(search.length > 3) {
      for(i=0;i<=2;i++) {
        search.pop();
      }
      window.history.replaceState('','',search.join('&'));
      results = document.location.href.match('&results=[0-9]+');
      if(jQuery('select[name=results]').length > 0) {
        var resultReplace = '&results=' + jQuery('select[name=results]').val();
      }
      else if(jQuery('input[name=results]').length > 0) {
        var resultReplace = '';
      }
      replace = document.location.href.replace(results, resultReplace );
      window.history.replaceState('','',replace);
    }

    $('#sort-wrapper select').on('change', function(e) {
      e.preventDefault();
     $('#sort-wrapper form').submit();

    });
    $('#sort-wrapper #form_reset').on('click', function(e) {
        e.preventDefault();
        document.location.href = $('#sort-wrapper #form_reset').attr('data-url');
    });
  }


})(jQuery); // End Javascript
