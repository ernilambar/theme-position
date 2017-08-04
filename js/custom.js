(function( $ ) {
	'use strict';

	$(document).ready(function(){
		$('.lazy').Lazy({
			onError: function(element) {
				var data_src = $( element ).attr( 'data-src' );
				var new_url = data_src.replace( '.png', '.jpg' );
				$( element ).attr( 'data-src', new_url );
				$( element ).attr( 'src', new_url );
			}
		});
	});

})( jQuery );
