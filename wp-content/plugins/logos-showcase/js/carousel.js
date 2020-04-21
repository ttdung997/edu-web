//$ = jQuery.noConflict();

	jQuery(document).ready(function($){

	//$ = jQuery.noConflict();	

		for (var key in lssliderparam) {			

			 var auto = (lssliderparam[key]['auto'] === 'true');
			 var pause = parseInt(lssliderparam[key]['pause']);
			 var autohover = (lssliderparam[key]['autohover'] === 'true');
			 var ticker = (lssliderparam[key]['ticker'] === 'true');
			 var tickerhover = (lssliderparam[key]['tickerhover'] === 'true');
			 var usecss = (lssliderparam[key]['usecss'] === 'true');
			 var autocontrols = (lssliderparam[key]['autocontrols'] === 'true');
			 var speed = parseInt(lssliderparam[key]['speed']);
			 var slidemargin = parseInt(lssliderparam[key]['slidemargin']);
			 var infiniteloop = (lssliderparam[key]['infiniteloop'] === 'true');
			 var pager = (lssliderparam[key]['pager'] === 'true');
			 var controls = (lssliderparam[key]['controls'] === 'true');
			 var slidewidth = parseFloat(lssliderparam[key]['slidewidth'])+20;
			 var minslides = parseInt(lssliderparam[key]['minslides']);
			 var maxslides = parseInt(lssliderparam[key]['maxslides']);
			 var moveslides = parseInt(lssliderparam[key]['moveslides']);

			 //fix bug of 1 slider only infinite loop not working
			 //another solution could be adding the slidemargin to 
			 //the slideWidth and align the images in the center
			 if(maxslides==1 && ticker==false){
			 	slidemargin = null;
			 }

			 var sliderDiv = $(lssliderparam[key]['divid']);
			 //sometimes the div is passed wrong, so we built a temp fix here:
			 //if(sliderDiv==false) {
			 	//sliderDiv = $('.lshowcase-wrap-carousel-1');
			 //}

			
			  

			sliderDiv.fadeIn('slow');

		    sliderDiv.bxSlider({				
		    auto: auto,		
			pause: pause,
			autoHover: autohover,
			ticker: ticker,
			tickerHover: tickerhover,
			useCSS: usecss,
			autoControls: autocontrols,
			mode: 'horizontal',
			speed: speed,
			slideMargin: slidemargin,
			infiniteLoop: infiniteloop,
		    pager: pager, 
			controls: controls,
		    slideWidth: slidewidth,
		    minSlides: minslides,
		    maxSlides: maxslides,
		    moveSlides: moveslides  		

		
			});

		}  

		
	});

