(function($) {
    $(window).load(function () {
        if ( $('.donate-author-post').length > 0 ) {
			$('.donate-author-post').each(function(){
                $(this).show();
                $(this).children('button').click(async function(){
                    if ( $('#donate-author-post__wrapper').length == 0 ) {
                        let url = '/wp-json/donate-author-post/page';
                        let response = await fetch(url);
                        let text = await response.text();
                        $("body").append(text);
                        $('.dap-close').click(function(){
                            $('#donate-author-post__wrapper').hide();
                        });
                    } else {
                        $('#donate-author-post__wrapper').show();
                    }
                });
            });
		}
	});
}(jQuery));
