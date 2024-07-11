<?php 
    if ( ! defined( 'ABSPATH' ) ) exit;

    require_once (dirname(__FILE__).'/mapInEachPost_map_Class.php');
    require_once (dirname(__FILE__).'/mapInEachPost_post_Class.php');
    require_once (dirname(__FILE__).'/mapInEachPost_configurator_Class.php');
    
    class mapInEachPost_Class {
    
        public $map;
        public $point;
    
        public function __construct() {
            $this->map = new mapInEachPost_map_Class();
            $this->point = new mapInEachPost_post_Class();
            $menu = new mapInEachPost_configurator_Class();
            add_action('template_redirect', [$this, 'check_and_add_shortcode']);
        }
    
        public function check_and_add_shortcode() {
            if ($this->is_supported_post_type()) {
                add_shortcode('mapInEachPost', [$this, 'mapInEachPost_function']);
            }
        }
    
        public function mapInEachPost_function($atts) {
            // Verifica se il metodo viene chiamato
            error_log('mapInEachPost_function called');
    
            return $this->map->render($this->getPoint(), $atts);
        }
    
        public function getPoint() {
            return $this->point->getlistPoint();
        }
    
        private function is_supported_post_type() {
            if (is_singular()) {
                $post_type = get_post_type();
                $selected_post_types = get_option('mapInEachPost_post_types', []);
                return in_array($post_type, $selected_post_types);
            } 
            return false;
        }
    }
    