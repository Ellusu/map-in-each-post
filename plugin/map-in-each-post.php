<?php
   /*
   Plugin Name: Map in Each Post
   description: A simple plugin to insert customizable maps in posts using shortcodes. Supports unique maps per post and custom post types.
   Version: 1.2
   Author: Matteo Enna
   Author URI: https://matteoenna.it/it/wordpress-work/
   Text Domain: map-in-each-post
   License: GPL2
   */

    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    require_once (dirname(__FILE__).'/class/mapInEachPost_Class.php');

    function mapInEachPost_Class_admin_notice() {
        $current_user = wp_get_current_user();
        $user_language = esc_html(get_user_meta($current_user->ID, 'locale', true));
    
        ?>
        <div class="notice notice-info is-dismissible">
            <p>
                <?php 
                // Translators: 1: Link to profile, 2: User language, 3: Link to translation instructions
                printf(
                    wp_kses(
                        /* translators: 1: Link to profile, 2: User language, 3: Link to translation instructions */
                        __('Hi, I\'m <a href="%1$s">Matteo</a>, the developer of <b>Map in Each Post</b>. If you are enjoying and finding this plugin useful, please consider helping us translate it into %2$s. Check if translations are available for your language and start contributing. <a href="%3$s">Click here to find out how you can help</a>.', 'map-in-each-post'),
                        array(
                            'a' => array(
                                'href' => array(),
                            ),
                            'b' => array(),
                        )
                    ),
                    esc_url('https://profiles.wordpress.org/matteoenna/'),
                    esc_html($user_language ? $user_language : __('your language', 'map-in-each-post')),
                    esc_url('https://make.wordpress.org/polyglots/handbook/translating/')
                ); 
                ?>
            </p>
        </div>
        <?php
    }

    add_action('admin_notices', 'mapInEachPost_Class_admin_notice');


    new mapInEachPost_Class();