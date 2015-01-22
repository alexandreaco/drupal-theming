(function ($) {
  $.fn.mobileMenu = function(options){
    var defaults = {
      menuClose: 'X', //menu closed text
      menuOpen: '<span></span><span></span><span></span>', //menu open text
      expand: "+", //expand text
      contract: "-", //contract text
      navigationText: '', //Used in the navigation menu
      stripStyle: true, //strip all styling from
      selector: [this], //order the menu should go array of selectors
      minWidth: 450 //Minimum window width for menu to show
    };
    
    var options = $.extend(defaults, options);
    var menu = '';
    var selectors = [];
    for(var x=0;x<options.selector.length;x++){
      selectors.push(jQuery(options.selector[x]));
    }

    if ( (navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i)) || (navigator.userAgent.match(/Android/i)) || (navigator.userAgent.match(/Blackberry/i)) || (navigator.userAgent.match(/Windows Phone/i)) ) {
	var isMobile = true;
    }
    
    if ( (navigator.userAgent.match(/MSIE 8/i)) || (navigator.userAgent.match(/MSIE 7/i)) ) {
	jQuery('html').css("overflow-y" , "scroll");
    }

    function _buildMenu(){
      currentWidth = window.innerWidth || document.documentElement.clientWidth;
      if(options.minWidth >= currentWidth){
	if(jQuery('#mobile-menu').length === 0){
	  menu = jQuery('<div id="mobile-menu" />');
	  var label = jQuery('<span />')
			.addClass('menu-label')
			.text(options.navigationText);

	  var link = jQuery("<a />").attr('id','nav')
	    .addClass('menu-reveal')
	    .html(options.menuOpen).click(function(){
	      jQuery('#mobile-menu a.menu-reveal').toggleClass('expanded');
	      jQuery('#mobile-menu nav > ul').animate({height:'toggle'},"slow",function(data){});
	    
	      if(jQuery(this).html() == options.menuClose){
		jQuery(this).html(options.menuOpen);
	      }else{
		jQuery(this).html(options.menuClose);
	      }                        
	  });

	  jQuery(menu).append(label);	  
	  jQuery(menu).append(link);
	  jQuery(menu).append('<nav />');
	  jQuery('nav',menu).append('<ul />');
	
	  jQuery(options.selector).each(function(i,item){
	    var data = jQuery(item).html();
	    jQuery('> nav > ul',menu).append(data);
	    jQuery(item).addClass('menuProcessed').hide();
	  });

	  if(options.stripStyle){
	    jQuery('ul,li *',menu).removeAttr('style');
	    jQuery('ul,li *',menu).removeAttr('class');
	    jQuery('ul,li *',menu).removeAttr('id');
	  }

	  jQuery('*',menu).addClass('clearfix');
	  jQuery('ul li:last-child',menu).addClass('last-menu-item');
	  
	  jQuery('li ul',menu).each(function(i,item){
	    var expand = jQuery('<a class="expander"/>')
			.text(options.expand)
			.click(function(){
			  jQuery(this)
			    .parent()
			    .find('> ul')
			    .animate({height:'toggle'},"slow",function(data){});
			  
			  if(jQuery(this).html() == options.expand)
			    jQuery(this).text(options.contract);
			  else
			    jQuery(this).text(options.expand);
			    
			  return false;
			});
	    jQuery(this).parent().append(expand);
	  });
	  
	  jQuery('> nav ul',menu).hide();
	  
	  jQuery('body').prepend(menu);
	}
      }else{
	jQuery('#mobile-menu').remove();
	jQuery('.menuProcessed').show();
      }
    }
    
    if(!isMobile){
      jQuery(window).resize(function(){
	_buildMenu();
      });
    }
    window.onorientationchange = function() {
      _buildMenu();
    }
    _buildMenu();
  }
})(jQuery);
