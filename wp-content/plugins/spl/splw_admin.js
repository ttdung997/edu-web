jQuery(document).ready(function() {
	jQuery(this).ajaxComplete(function(event, XMLHttpRequest, ajaxOptions) {
		if( ( ajaxOptions.data.search('action=save-widget') != -1 ) && ( ajaxOptions.data.search('id_base=smart-post-list-widget') != -1 ) ){
			
			var sidebar_id = '';
			var widget_id = '';
			var matches = new Array();
			if( matches = ajaxOptions.data.match( /sidebar\=([0-9a-zA-Z\_\-\+]+)/ ) ){
				sidebar_id = matches[1];
			}
			if( matches = ajaxOptions.data.match( /widget\-id\=([0-9a-zA-Z\_\-\+]+)/ ) ){
				widget_id = matches[1];
			}
			
			if( sidebar_id && widget_id ){
			
				var typeSelect = jQuery( '#widget-' + widget_id + '-post_type' );
				var w_iteration = 1;
				if( matches = ajaxOptions.data.match( /this\_widget\_iteration=([0-9]+)/ ) ){
					w_iteration = matches[1];
				};
				performAJAXCallOnPageLoad001( typeSelect, w_iteration );
				
				if( typeSelect.length ){
					typeSelect.change(function (){
						performAJAXCallOnPostTypeChange(jQuery(this));
					});
				};
				
			};
		};
	});
});
