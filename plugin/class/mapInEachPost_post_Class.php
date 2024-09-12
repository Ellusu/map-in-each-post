<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class mapInEachPost_post_Class {
    public function __construct() {
        add_action('add_meta_boxes', [$this, 'add_mapineachpost_points_metabox']);
        add_action('save_post', [$this, 'save_mapineachpost_points']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
    }

    public function enqueue_admin_scripts() {
        $plugin_url = plugin_dir_url(dirname(__FILE__));
        $component_url = $plugin_url . 'component/';

        wp_enqueue_script('map-in-each-post-admin', $component_url . 'js/map-in-each-post-admin.js', ['jquery'], null, true);
        wp_enqueue_style('map-in-each-post-admin-style', $component_url . 'css/map-in-each-post-admin.css');

        wp_localize_script('map-in-each-post-admin', 'mapInEachPostLabels', [
            'point' => esc_html__('Point', 'map-in-each-post'),
            'title' => esc_html__('Title', 'map-in-each-post'),
            'description' => esc_html__('Description', 'map-in-each-post'),
            'latitude' => esc_html__('Latitude', 'map-in-each-post'),
            'longitude' => esc_html__('Longitude', 'map-in-each-post'),
            'link' => esc_html__('Link', 'map-in-each-post'),
            'removePoint' => esc_html__('Remove point', 'map-in-each-post'),
        ]);
    }
    
    public function add_mapineachpost_points_metabox() {
        $selected_post_types = get_option('mapInEachPost_post_types', []);

        foreach ($selected_post_types as $post_type) {
            add_meta_box(
                'points_metabox',
                __('Points', 'map-in-each-post'),
                [$this, 'render_mapineachpost_points_metabox'],
                $post_type,
                'normal',
                'high'
            );
        }
    }

    public function render_mapineachpost_points_metabox($post) {
        $points = get_post_meta($post->ID, '_mapineachpost_points', true);
        error_log($points);
        $points = !empty($points) ? json_decode($points, true) : array();
        $enable_mapineachpost_points = get_post_meta($post->ID, '_enable_mapineachpost_points', true);
    
        do_action('before_render_mapineachpost_points_form', $post, $points);
    
        if (has_action('render_custom_mapineachpost_points_form')) {
            do_action('render_custom_mapineachpost_points_form', $post, $points);
        } else {
            include plugin_dir_path(__FILE__) . '../templates/post-point-metabox.php';
        }
    
        do_action('after_render_mapineachpost_points_form', $post, $points);
    }
    

    public function save_mapineachpost_points($post_id) {
        if (!isset($_POST['mapInEachPost_nonce_field']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['mapInEachPost_nonce_field'])), 'save_mapineachpost_points')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (isset($_POST['_enable_mapineachpost_points'])) {
            update_post_meta($post_id, '_enable_mapineachpost_points', '1');
        } else {
            delete_post_meta($post_id, '_enable_mapineachpost_points');
        }

        if (isset($_POST['points'])) {
            $points = stripslashes_deep($_POST['points']); // Rimuove eventuali backslashes extra
            $sanitized_mapineachpost_points = array();

            foreach ($points as $index => $point) {
                if (!empty($point['title']) || !empty($point['desc']) || !empty($point['lat']) || !empty($point['lon']) || !empty($point['link'])) {
                    
                    $title_with_htmlspecialchars = htmlspecialchars($point['title'], ENT_QUOTES, 'UTF-8');
                    $desc_with_htmlspecialchars = htmlspecialchars($point['desc'], ENT_QUOTES, 'UTF-8');
            
                    error_log(sanitize_text_field($point['title'])); // Logga il titolo dopo la sanificazione
                    $sanitized_mapineachpost_points[$index] = array(
                        'title' => sanitize_text_field($title_with_htmlspecialchars),
                        'desc'  => sanitize_textarea_field($desc_with_htmlspecialchars), // Sanifica l'area di testo
                        'lat'   => sanitize_text_field($point['lat']),
                        'lon'   => sanitize_text_field($point['lon']),
                        'link'  => esc_url_raw($point['link']),
                    );
                }
            }
            error_log("save");
            error_log(wp_json_encode($sanitized_mapineachpost_points)); // Logga i punti dopo la sanificazione
            if (!empty($sanitized_mapineachpost_points)) {
                update_post_meta($post_id, '_mapineachpost_points', wp_json_encode($sanitized_mapineachpost_points));
            } else {
                delete_post_meta($post_id, '_mapineachpost_points');
            }
        } else {
            delete_post_meta($post_id, '_mapineachpost_points');
        }

    }

    public function getlistPoint() {
        if (is_singular()) {
            $post_type = get_post_type();
            $selected_post_types = get_option('mapInEachPost_post_types', []);

            if ($selected_post_types && in_array($post_type, $selected_post_types)) {
                $enable_mapineachpost_points = get_post_meta(get_the_ID(), '_enable_mapineachpost_points', true);
                if ($enable_mapineachpost_points) {
                    $points = get_post_meta(get_the_ID(), '_mapineachpost_points', true);
                    $points = wp_json_decode($points, true); // cambiato json_decode a wp_json_decode

                    if (json_last_error() !== JSON_ERROR_NONE) {
                        return [];
                    }

                    return $points;
                }
            }
        }

        return [];
    }
}
