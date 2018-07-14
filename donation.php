<?php
namespace DonateAuthorPost;
class Donation {

	public   function __construct() {
        wp_register_style( 'donation-author-post', plugin_dir_url( __FILE__ ) . 'css/layout.css', array());       
        wp_enqueue_style( 'donation-author-post');
        wp_register_script( 'donation-author-post', plugin_dir_url( __FILE__ ) . 'js/donate.js', array('jquery'));
        wp_enqueue_script( 'donation-author-post' );
        $this->register_rest_route();
		add_filter( 'the_content', array($this, 'show_donation' ), 10, 2 );
    }

	public  function show_donation($content) {
        if ( is_single() ) {
            $html = '<p class=donate-author-post style="display:none;"><button>'.__('Donate Author', 'donate-author-post').'</button></p>';
            return $content.$html;
        }
        return $content;
    }

	public  function page() {

        $options = get_option('donate_author_post');
        if ( $options ) {
            foreach ( $options as $key=>$option ) {
                if ( $option['display'] == 'yes' ) {
                    $pay[$key]['title'] = $option['name'];
                    $pay[$key]['html'] = stripslashes($option['note']);
                }

            }
        }
        $html = '';
        foreach ( $pay as $p ) {
            $html .= '<div><p>'.$p['title'].'</p><p>'.$p['html'].'</p></div>';
        }
        //close button
        $html .= '<span class=dap-close title="close"><svg viewbox="0 0 40 40"><path class="dap-close-x" d="M 10,10 L 30,30 M 30,10 L 10,30" /></svg></span>';
        $html = '<div id=donate-author-post__wrapper><div id=donate-author-post>'.$html.'</div></div>';
        echo $html;
    }


	public  function register_rest_route() {
        add_action( 'rest_api_init', function () {
            register_rest_route( 'donate-author-post', 'page', array(
                'methods' => 'GET',
                'callback' => array($this, 'page'),
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

