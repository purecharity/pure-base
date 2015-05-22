(function( jQuery ) {
	'use strict';

  // Iframe specifics: Buttons
  jQuery(document).on('click', '.iframe-button', function(){
    if(jQuery(window).outerWidth() > 700){
      jQuery('.pc-backdrop').show();
      jQuery('.pc-backdrop').find('iframe').html('');
      jQuery('.pc-backdrop').find('iframe').attr('src', jQuery(this).attr('href'));
      return false;
    }
  })

  // Forms
  jQuery(document).on('submit', '.iframe-form', function(){
    if(jQuery(window).outerWidth() > 700){
      jQuery('.pc-backdrop').find('iframe').html('');
      jQuery('.pc-backdrop').find('iframe').attr('src', jQuery(this).attr('action')+'?'+jQuery(this).serialize());
      jQuery('.pc-backdrop').show();
      return false;
    }
  })

  jQuery(document).on('click', '.pc-backdrop', function(){
    jQuery(this).hide();
  })
  // Iframe specifics

})( jQuery );
