(function($) {
    $(window).load(function () {
        'use strict';
        if ( 1 == $('#donate-author-post').length ) {
			$('#donate-author-post').show();
			$('#donate-author-post').click(async function(){
				let url = '/wp-json/donate-author-post/pay';
				try {
					let response = await fetch(url);
					return await response.text();
				} catch (e) {
					return e.message;
				}
			});
		}
	});
}(jQuery));
