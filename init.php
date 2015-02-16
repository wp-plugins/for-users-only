<?php
/*
  Plugin Name: For Users Only
  Description: Allows access to the site for logged in users only
  Plugin URI: https://wordpress.org/plugins/for-users-only/
  Version: 1.0
  Author URI: https://gagan.pro
  Author: Gagan Deep Singh
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

require_once plugin_dir_path( __FILE__ ) . 'class-users-only.php';

add_action( 'plugins_loaded', array( 'Users_Only', 'get_instance' ) );
