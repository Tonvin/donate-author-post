<?php
namespace DonateAuthorPost;
class Setting {

    function __construct() {
        add_filter('plugin_action_links', array($this, 'add_plugin_action_links'), 10, 2);
        add_action('admin_menu', array($this, 'add_options_menu'));
    }

    public function add_plugin_action_links($links, $file) {
        if ($file == plugin_basename(dirname(__FILE__) . '/main.php')) {
            $links[] = '<a href="options-general.php?page=donate-author-post-settings&section=param">Setting</a>';
        }
        return $links;
    }

    public function add_options_menu() {
        add_options_page('Donate Author Post', 'Donate Author Post', 'manage_options', 'donate-author-post-settings', array($this, 'show_options_page'));
    }

    public function show_options_page() {
        $tab = $_GET['tab'];
        if ( isset($_POST['_wpnonce']) && $_POST['_wpnonce'] ) {
            $tab = $this->save_channel();
            //$this->show_page('pay');
        }

        $options = get_option('donate_author_post');
        $tabs = array_keys($options);
        if ( in_array($tab, $tabs)) {
            $pay = $options[$tab];
        } else {
            $tab = 'new';
        }
        
        $section = strval($_GET['section']);
        $sections = array('channels');
        if ( !in_array($section, $sections)) {
            $section = $sections[0];
        }

        /*
        */

        /*
        $class['param'] = '';
        $class['auth'] = '';
        if ( $section == 'channels' ) {
            $class['param'] = 'nav-tab-active';
            $options = array();
            $options['type'] = '';
            $options = get_option('donate_author_post');
        }
         */
        ?>
        <?php
        include_once "pages/layout.php";
        ?>
        <div class="wrap">
            <h1 class='nav-tab-wrapper'>
                <a href='?page=donate-author-post-settings&section=channels' class='nav-tab <?php echo $class['param'];?>'>Channels</a>
            </h1>
            <div class="tabs">
<?php
        if ( is_array($options) ) {
            foreach ( $options as $k=>$v ) {
                if ( $k == $tab ) {
                    echo "<span class=current>$k</span>";
                } else {
                    echo "<span><a href='?page=donate-author-post-settings&section=channels&tab=".$k."'>".$k."</a></span>";
                }
            }
        }
?>
<?php
                if ( 'new' == $tab ) {
                    echo "<span>New+</span>";
                } else {
                    echo "<span><a href='?page=donate-author-post-settings&section=channels&tab=new'>New+</a></span>";
                }
?>
            </div>
        </div>
        <?php
        if ( $section == 'channels' ) {
            if ( $tab == 'new' ) {
                include_once "pages/new.php";
            } else {
                include_once "pages/pay.php";
            }
            //$this->show_channels_page($options);
        }
    }

    public function save_param() {
            if ( isset($_POST['_wpnonce']) && $_POST['_wpnonce'] ) {
                $options = array();
                $options['site'] = '';
                $options['token'] = '';
                $options['type'] = '';
                $nonce = $_POST['_wpnonce'];
                if (!wp_verify_nonce($nonce, 'donate_author_post_param')) {
                    wp_die('Error! Nonce Security Check Failed! please save the settings again.');
                }
                if(isset($_POST['site']) && !empty($_POST['site'])){
                    $site= sanitize_text_field($_POST['site']);
                    $options['site'] = $site;
                }
                if(isset($_POST['token']) && !empty($_POST['token'])){
                    $token= sanitize_text_field($_POST['token']);
                    $options['token'] = $token;
                }
                if(isset($_POST['type']) && !empty($_POST['type'])){
                    $type = sanitize_text_field($_POST['type']);
                    $options['type'] = $type;
                }
                if(isset($_POST['jspush']) && !empty($_POST['jspush'])){
                    $jspush = sanitize_text_field($_POST['jspush']);
                    $options['jspush'] = $jspush;
                }
                update_option('donate_author_post', $options);
                echo '<div id="message" class="updated fade"><p><strong>';
                echo '保存成功';
                echo '</strong></p></div>';
            }
        }           

    public function save_channel() {
                $option = array();
                $option['name'] = '';
                $option['note'] = '';
                $option['display'] = '';
                $nonce = $_POST['_wpnonce'];
                if (!wp_verify_nonce($nonce, 'donate_author_post')) {
                    wp_die('Error! Nonce Security Check Failed! please save the settings again.');
                }
                if(isset($_POST['name']) && !empty($_POST['name'])){
                    $name= sanitize_text_field($_POST['name']);
                    $option['name'] = $name;
                }
                if(isset($_POST['note']) && !empty($_POST['note'])){
                    $note= sanitize_text_field($_POST['note']);
                    $option['note'] = $note;
                }
                if(isset($_POST['display']) && !empty($_POST['display'])){
                    $display= sanitize_text_field($_POST['display']);
                    $option['display'] = $display;
                }
                $options = get_option('donate_author_post');
                $options[$name] = $option;
                update_option('donate_author_post', $options);
                return $name;
                /*
                echo '<div id="message" class="updated fade"><p><strong>';
                echo 'Add success.';
                echo '</strong></p></div>';
                */
        }           

        public function save_auth() {
                if ( isset($_POST['_wpnonce']) && $_POST['_wpnonce'] ) {
                    $nonce = $_POST['_wpnonce'];
                    if (!wp_verify_nonce($nonce, 'donate_author_post_auth')) {
                        wp_die('Error! Nonce Security Check Failed! please save the settings again.');
                    }
                    $options = array();
                    $options['email'] = '';
                    $options['key'] = '';
                    if(isset($_POST['email']) && !empty($_POST['email'])){
                        $email = sanitize_email($_POST['email']);
                        $options['email'] = $email;
                    }
                    if(isset($_POST['key']) && !empty($_POST['key'])){
                        $key = sanitize_text_field($_POST['key']);
                        $options['key'] = $key;
                    }
                    echo '<div id="message" class="updated fade"><p><strong>';
                    echo $info;
                    echo '</strong></p></div>';
                }
            }           

    public function show_channels_page($options) {
        include_once 'pages/channels.php';
    }

    public function show_pay_page($tab) {
        include_once "pages/$tab.php";
    }

}
