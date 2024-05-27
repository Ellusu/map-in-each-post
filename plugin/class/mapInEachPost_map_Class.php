<?php 

    class mapInEachPost_map_Class {

        public function __construct() {
            //add_shortcode('map_in_each_post', array($this, 'render'));
            add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        }
    
        public function enqueue_scripts() {
            // Leaflet CSS and JS
            wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.0.3/dist/leaflet.css', array(), '1.0.3');
            wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.0.3/dist/leaflet-src.js', array(), '1.0.3', true);
    
            // MarkerCluster CSS and JS
            wp_enqueue_style('markercluster-css', 'https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.css', array(), '1.0.0');
            wp_enqueue_style('markercluster-default-css', 'https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.Default.css', array(), '1.0.0');
            wp_enqueue_script('markercluster-js', 'https://leaflet.github.io/Leaflet.markercluster/dist/leaflet.markercluster-src.js', array(), '1.0.0', true);
        }
    
        public function render($locations) {
            ob_start();
            include plugin_dir_path(__FILE__) . '../templates/map.php';
            return ob_get_clean();
        }
    }