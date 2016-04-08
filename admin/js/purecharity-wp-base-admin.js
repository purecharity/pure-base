jQuery(function($) {
	window.setTimeout(function(){
	  jQuery(document).ready(function(){
			var main_color = jQuery("#main_color").val();
			jQuery("#main_color").spectrum({
				preferredFormat: "hex",
			  color: main_color,
			  showInitial: true,
	    	showInput: true
			});
	  });
	}, 1000)
})