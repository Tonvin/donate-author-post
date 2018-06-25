<?php
namespace DonateAuthorPost;
class Donation {

	public   function __construct() {
		add_filter( 'the_content', array($this, 'append_donation_button' ), 10, 2 );
        wp_register_style( 'donation-author-post.css', plugin_dir_url( __FILE__ ) . 'css/layout.css', array());       
        wp_enqueue_style( 'donation-author-post.css');
    }

	public  function append_donation_button($content) {
        load_plugin_textdomain( 'donate-author-post', false, basename(__DIR__).'/languages');
        $html = '<p id=donate-author-post><button>'.__('Donate Author', 'donate-author-post').'</button></p>';
        return $content.$html;
    }
}
