<?php 

    class mapInEachPost_map_Class {

        public function __construct() {
            add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        }
    
        public function enqueue_scripts() {
            wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.0.3/dist/leaflet.css', array(), '1.0.3');
            wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.0.3/dist/leaflet-src.js', array(), '1.0.3', true);
    
            wp_enqueue_style('markercluster-css', 'https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.css', array(), '1.0.0');
            wp_enqueue_style('markercluster-default-css', 'https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.Default.css', array(), '1.0.0');
            wp_enqueue_script('markercluster-js', 'https://leaflet.github.io/Leaflet.markercluster/dist/leaflet.markercluster-src.js', array(), '1.0.0', true);
        }
    
        public function render($locations, $atts= []) {
            ob_start();
            $atts = $this->attsChecker($atts);
            include plugin_dir_path(__FILE__) . '../templates/map.php';
            return ob_get_clean();
        }

        public function attsChecker($atts = false) {

            $defaults = [
                'zoom' => 5,
                'lat'  => 39.216667,
                'lon'  => 9.11667
            ];
        
            if (!is_array($atts)) {
                return $defaults;
            }
        
            $parameters = [
                'zoom' => isset($atts['zoom']) ? $atts['zoom'] : $defaults['zoom'],
                'lat'  => isset($atts['lat']) ? $atts['lat'] : $defaults['lat'],
                'lon'  => isset($atts['lon']) ? $atts['lon'] : $defaults['lon']
            ];
            return $parameters;
        }
        
    }