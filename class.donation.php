<?php
namespace DonateAuthorPost;
class Donation {

	public   function __construct() {
        $this->register_rest_route();
		add_filter( 'the_content', array($this, 'append_donation_button' ), 10, 2 );
        wp_register_style( 'donation-author-post.css', plugin_dir_url( __FILE__ ) . 'css/layout.css', array());       
        wp_enqueue_style( 'donation-author-post.css');
        wp_register_script( 'donation-author-post.js', plugin_dir_url( __FILE__ ) . 'js/donate.js', array('jquery'));
        wp_enqueue_script( 'donation-author-post.js' );
    }

	public  function append_donation_button($content) {
        load_plugin_textdomain( 'donate-author-post', false, basename(__DIR__).'/languages');
        $html = '<p id=donate-author-post style="display:none;"><button>'.__('Donate Author', 'donate-author-post').'</button></p>';
        return $content.$html;
    }

	public  function pay() {
        $pay['wechat']['title'] = '微信';
        $pay['wechat']['html'] = '<img src=http://tonvin.one234.xyz/images/pay/wechat.jpg />';
        $pay['alipay']['title'] = '支付宝';
        $pay['alipay']['html'] = '<img src=http://tonvin.one234.xyz/images/pay/alipay.jpg />';
        $pay['paypal']['title'] = '贝宝';
        $pay['paypal']['html'] = '<a href="https://www.paypal.me/tonvin" target=_blank>';
        return $pay;
    }
	public  function register_rest_route() {
        add_action( 'rest_api_init', function () {
            register_rest_route( 'donate-author-post', 'pay', array(
                'methods' => 'GET',
                'callback' => array($this, 'pay'),
                'args' => array(
                    'id' => array(
                        'validate_callback' => function($param, $request, $key) {
                            return is_numeric( $param );
                        }
            ),
            ),
        ));
        });
    }
}

