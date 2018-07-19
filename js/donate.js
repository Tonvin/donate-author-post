(function($) {
    $(window).load(function () {
        if ( $('.donate-author-post').length > 0 ) {
			$('.donate-author-post').each(function(){
                $(this).show();
                $(this).children('button').click(function(){
                    if ( $('#donate-author-post__wrapper').length == 0 ) {
                        $.ajax({
                            method: "GET",
                            url: "/wp-json/donate-author-post/page",
                        }).done(function( res ) {
                            $('body').append(res.html);
                            $('.dap-close').click(function(){
                                $('#donate-author-post__wrapper').hide();
                            });
                        });
                    } else {
                        $('#donate-author-post__wrapper').show();
                    }
                });
            });
		}
	});
}(jQuery));
