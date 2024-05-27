<?php 

    require_once (dirname(__FILE__).'/mapInEachPost_map_Class.php');
    require_once (dirname(__FILE__).'/mapInEachPost_post_Class.php');
    require_once (dirname(__FILE__).'/mapInEachPost_configurator_Class.php');

/*
1) Parametri iniziali facoltativi: zoom e punto iniziale
2) Plugin Checker
2) Testi e traduzione
*/

    class mapInEachPost_Class {

        public $map;
        public $point;

        public function __construct() {
            $this->map = new mapInEachPost_map_Class();
            $this->point = new mapInEachPost_post_Class();
            $menu = new mapInEachPost_configurator_Class();
            if ($this->is_supported_post_type()) {
                add_shortcode('mapInEachPost', [$this,'mapInEachPost_function']);
            }

        }

        public function mapInEachPost_function($atts) {
            return $this->map->render($this->getPoint());
        }
    
        public function getPoint() {
            return $this->point->getlistPoint();
        }
    
        private function is_supported_post_type() {
            if (is_singular()) {
                $post_type = get_post_type();
                $selected_post_types = get_option('post_types', []);
                return in_array($post_type, $selected_post_types);
            }
            return false;
        }
    }