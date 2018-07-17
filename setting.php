<?php
namespace DonateAuthorPost;
class Setting {

    function __construct() {
        add_filter('plugin_action_links', array($this, 'add_plugin_action_links'), 10, 2);
        add_action('admin_menu', array($this, 'add_options_menu'));
    }

    public function add_plugin_action_links($links, $file) {
        if ($file == plugin_basename(dirname(__FILE__) . '/index.php')) {
            $links[] = '<a href="options-general.php?page=donate-author-post-settings&section=channels">'.__('Setting', 'donate-author-post').'</a>';
        }
        return $links;
    }

    public function add_options_menu() {
        add_options_page(__('Donate Author Post', 'donate-author-post'), __('Donate Author Post', 'donate-author-post'), 'manage_options', 'donate-author-post-settings', array($this, 'show_options_page'));
    }

    public function show_options_page() {
        $act = $_POST['act'];
        if ( !in_array($act, array('delete', 'update', 'insert'))) {
            $act = false;
        }
        if ( isset($_POST['_wpnonce']) && $_POST['_wpnonce'] ) {
            $nonce = $_POST['_wpnonce'];
            if (!wp_verify_nonce($nonce, 'donate_author_post')) {
                wp_die('Error! Nonce Security Check Failed! please save the settings again.');
            }

            if ( $act == 'update' ) {
                $tab = $this->update_channel();
            } elseif ( $act == 'insert' ) {
                $tab = $this->insert_channel();
            } elseif ( $act == 'delete' ) {
                $this->delete_channel();
                $tab = null;
            }
        } else {
            $tab = $_GET['tab'];
        }

        $options = get_option('donate_author_post');
        if ( $options ) {
            $tabs = array_keys($options);
            if ( $tab == '' ) {
                $tab = $tabs[0];
            }
            $pay = $options[$tab];
            $pay['note'] = stripslashes($pay['note']);
        } else {
            $tab = 'new';
        }

        
        $section = strval($_GET['section']);
        $sections = array('channels');
        if ( !in_array($section, $sections)) {
            $section = $sections[0];
        }
        ?>
        <?php
        include_once "pages/layout.php";
        ?>
        <div class="wrap">
            <h1 class='nav-tab-wrapper'>
            <a href='?page=donate-author-post-settings&section=channels' class='nav-tab <?php echo $class['param'];?>'><?php echo __('Channels', 'donate-author-post');?></a>
            </h1>
            <div class="tabs">
<?php
        if ( is_array($options) ) {
            foreach ( $options as $k=>$v ) {
                if ( $k == $tab ) {
                    echo "<span class=current>".$v['name']."</span>";
                } else {
                    echo "<span><a href='?page=donate-author-post-settings&section=channels&tab=".$k."'>".$v['name']."</a></span>";
                }
            }
        }
?>
<?php
                if ( 'new' == $tab ) {
                    echo "<span>".__('New', 'donate-author-post')."+</span>";
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

    public function insert_channel() {
                $option = array();
                $option['name'] = '';
                $option['note'] = '';
                $option['display'] = '';
                if(isset($_POST['name']) && !empty($_POST['name'])){
                    $name= sanitize_text_field($_POST['name']);
                    $option['name'] = $name;
                }
                if(isset($_POST['note']) && !empty($_POST['note'])){
                    $note= $_POST['note'];
                    $option['note'] = $note;
                }
                if(isset($_POST['display']) && !empty($_POST['display'])){
                    $display= sanitize_text_field($_POST['display']);
                    $option['display'] = $display;
                }
                if ( $option['name'] ) {
                    $options = get_option('donate_author_post');
                    $tab = substr(uniqid(), -6);
                    $options[$tab] = $option;
                    update_option('donate_author_post', $options);
                    return $tab;
                }
                return 'new';
    }


    public function update_channel() {
                $option = array();
                $option['name'] = '';
                $option['note'] = '';
                $option['display'] = '';
                if(isset($_POST['pay_id']) && !empty($_POST['pay_id'])){
                    $pay_id= sanitize_text_field($_POST['pay_id']);
                }
                if(isset($_POST['name']) && !empty($_POST['name'])){
                    $name= sanitize_text_field($_POST['name']);
                    $option['name'] = $name;
                }
                if(isset($_POST['note']) && !empty($_POST['note'])){
                    $note= $_POST['note'];
                    $option['note'] = $note;
                }
                if(isset($_POST['display']) && !empty($_POST['display'])){
                    $display= sanitize_text_field($_POST['display']);
                    $option['display'] = $display;
                }
                $options = get_option('donate_author_post');
                $options[$pay_id] = $option;
                update_option('donate_author_post', $options);
                return $pay_id;
        }           

    public function delete_channel() {
                if(isset($_POST['pay_id']) && !empty($_POST['pay_id'])){
                    $pay_id= sanitize_text_field($_POST['pay_id']);
                }
                $options = get_option('donate_author_post');
                if ( isset($options[$pay_id]) ) {
                    unset($options[$pay_id]);
                }
                update_option('donate_author_post', $options);
                return true;
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
