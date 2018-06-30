(function($) {
    $(window).load(function () {
        if ( $('.donate-author-post').length > 0 ) {
			$('.donate-author-post').each(function(){
                $(this).show();
                $(this).click(async function(){
                    let url = '/wp-json/donate-author-post/page';
                    let response = await fetch(url);
                    let text = await response.text();
                    $("body").append(text);
                });
            });
		}
	});
}(jQuery));
