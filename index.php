<?php
/*
Plugin Name: Donate Author Post
Author: Tonvin Tian<itonvin@gmail.com>
Description: Reader can donate to author while like the post.
Author URI: https://tonvin.xyz
Text Domain: donate-author-post
*/
if ( !function_exists( 'add_action' ) ) {
	echo 'Called directly denied';
	exit;
}
require_once('donation.php');
require_once('setting.php');
use DonateAuthorPost\Donation;
use DonateAuthorPost\Setting;
load_plugin_textdomain( 'donate-author-post', false, basename(__DIR__).'/languages');
new Donation();
new Setting();
