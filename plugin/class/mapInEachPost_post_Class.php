<?php

class mapInEachPost_post_Class {
    public function __construct() {
        add_action('add_meta_boxes', [$this, 'add_mapineachpost_points_metabox']);
        add_action('save_post', [$this, 'save_mapineachpost_points']);
    }

    public function add_mapineachpost_points_metabox() {
        $selected_post_types = get_option('post_types', []);

        foreach ($selected_post_types as $post_type) {
            add_meta_box(
                'points_metabox',
                'Points',
                [$this, 'render_mapineachpost_points_metabox'],
                $post_type,
                'normal',
                'high'
            );
        }
    }

    public function render_mapineachpost_points_metabox($post) {
        $points = get_post_meta($post->ID, '_mapineachpost_points', true);
        $points = !empty($points) ? json_decode($points, true) : array();
        $enable_mapineachpost_points = get_post_meta($post->ID, '_enable_mapineachpost_points', true);

        include plugin_dir_path(__FILE__) . '../templates/post-point-metabox.php';
    }

    public function save_mapineachpost_points($post_id) {
        if (!isset($_POST['points_nonce']) || !wp_verify_nonce($_POST['points_nonce'], 'save_mapineachpost_points')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (isset($_POST['enable_mapineachpost_points'])) {
            update_post_meta($post_id, '_enable_mapineachpost_points', '1');
        } else {
            delete_post_meta($post_id, '_enable_mapineachpost_points');
        }

        if (isset($_POST['points'])) {
            $points = $_POST['points'];
            $sanitized_mapineachpost_points = array();

            foreach ($points as $index => $point) {
                if (!empty($point['title']) || !empty($point['desc']) || !empty($point['lat']) || !empty($point['lon']) || !empty($point['link'])) {
                    $sanitized_mapineachpost_points[$index] = array(
                        'title' => sanitize_text_field($point['title']),
                        'desc' => sanitize_text_field($point['desc']),
                        'lat' => sanitize_text_field($point['lat']),
                        'lon' => sanitize_text_field($point['lon']),
                        'link' => esc_url_raw($point['link']),
                    );
                }
            }

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
            $selected_post_types = get_option('post_types', []);

            if ($selected_post_types && in_array($post_type, $selected_post_types)) {
                $enable_mapineachpost_points = get_post_meta(get_the_ID(), '_enable_mapineachpost_points', true);
                if ($enable_mapineachpost_points) {
                    $points = get_post_meta(get_the_ID(), '_mapineachpost_points', true);
                    $points = json_decode($points, true);

                    if (json_last_error() !== JSON_ERROR_NONE) {
                        return '<p>Errore nella decodifica dei dati degli points.</p>';
                    }

                    return $points;
                }
            }
        }

        return [];
    }
}
