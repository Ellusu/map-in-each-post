<?php
   /*
   Plugin Name: Map in Each Post
   description: Enhance WordPress security with Easy Basic Authentication plugin.
   Version: 1
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