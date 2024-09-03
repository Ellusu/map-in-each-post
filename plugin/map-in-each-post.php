<?php
   /*
   Plugin Name: Map in Each Post
   description: A simple plugin to insert customizable maps in posts using shortcodes. Supports unique maps per post and custom post types.
   Version: 1.6
   Author: Matteo Enna
   Author URI: https://matteoenna.it/it/wordpress-work/
   Text Domain: map-in-each-post
   License: GPL2
   */

    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    require_once (dirname(__FILE__).'/class/mapInEachPost_Class.php');

    new mapInEachPost_Class();
