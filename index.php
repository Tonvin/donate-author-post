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
require_once('class.donation.php');
use DonateAuthorPost\Donation;
new Donation();
