
		$(window).load(function() {
			$('.flexslider').flexslider();
		});


// Rewritten version
// By @mathias, @cheeaun and @jdalton

(function(doc) {

	var addEvent = 'addEventListener',
	    type = 'gesturestart',
	    qsa = 'querySelectorAll',
	    scales = [1, 1],
	    meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];

	function fix() {
		meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
		doc.removeEventListener(type, fix, true);
	}

	if ((meta = meta[meta.length - 1]) && addEvent in doc) {
		fix();
		scales = [.25, 1.6];
		doc[addEvent](type, fix, true);
	}

}(document));

// Tally up the field values for the 20th Anniversey Gala reservation form
$().ready(function() {
	 // tally on keyup
   $('#webform-client-form-989').keyup(function() {
     tallyForm();
   });
   // also tally on change
   $('#webform-client-form-989').change(function() {
     tallyForm();
   });
   
   function tallyForm() {
     // get ticket values and add up
     var total = 0;
     total = Number(total) + Number($('input[name="submitted[tickets][premium_ticket]"]').val() * 1000);
     total = Number(total) + Number($('input[name="submitted[tickets][priority_ticket]"]').val() * 500);
     total = Number(total) + Number($('input[name="submitted[tickets][individual_ticket]"]').val() * 350);
     total = Number(total) + Number($('input[name="submitted[tickets][additional_tickets]"]').val() * 200);
     // add table value from the checked radio button
     if ($('input[name="submitted[tables][table]"]:radio:checked').length > 0) {
    		total = Number(total) + Number($('input[name="submitted[tables][table]"]:radio:checked').val());
     }
     // update the total field
     if (total == NaN) {
     	total = 0;
     }
     $('input[name="submitted[gift_information][donation_amount]"]').val(total);
   }
});


// Mobile Menu
$().ready(function() {
	jQuery().mobileMenu({minWidth:800,selector:['#block-menu-accountmenu .content > ul','#block-nice_menus-1 .content > ul','#block-nice_menus-4 .content > ul']});

});



var resizeBackgroundImage = function() {
	
	var height = $(window).height();
	var width = $(window).width();
	
	var originalWidth = 2000;
	var originalHeight = 1150;
	
	var originalRatio = (2000 / 1150);			//1.739
	var derivedRatio = (width / height);		//.88
	
		
	if (width >= height) {	// landscape window
		
		if (width > (height * originalRatio)) { // if window is too wide
		
			$("#block-views-background_image-classic_2 img").width(width);
			$("#block-views-background_image-classic_2 img").height(width / originalRatio);

		
		} else {
		
			$("#block-views-background_image-classic_2 img").height(height);
			$("#block-views-background_image-classic_2 img").width(height * originalRatio);				
			
		}
		
	} else { // portrait widow
		
		$("#block-views-background_image-classic_2 img").height(height);
		$("#block-views-background_image-classic_2 img").width(height * originalRatio);
	
	}
};

// Full Size Background Image

$(window).resize(function() {
	resizeBackgroundImage();
});

$(document).ready(function() {
	resizeBackgroundImage();
});