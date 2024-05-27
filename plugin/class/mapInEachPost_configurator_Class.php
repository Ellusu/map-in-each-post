<?php

class mapInEachPost_configurator_Class {

    public function __construct() {
        add_action( 'admin_menu', [ $this, 'create_settings_page' ] );
        add_action( 'admin_init', [ $this, 'setup_sections' ] );
        add_action( 'admin_init', [ $this, 'setup_fields' ] );
    }

    public function create_settings_page() {
        $page_title = 'Post Checkout Settings';
        $menu_title = 'Post Checkout';
        $capability = 'manage_options';
        $slug = 'post_checkout_settings';
        $callback = [ $this, 'settings_page_content' ];
        $icon = 'dashicons-location-alt';
        $position = 100;

        add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
    }

    public function settings_page_content() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        if ( isset( $_GET['settings-updated'] ) ) {
            add_settings_error( 'post_checkout_messages', 'post_checkout_message', 'Settings Saved', 'updated' );
        }

        settings_errors( 'post_checkout_messages' );

        include plugin_dir_path( __FILE__ ) . '../templates/settings-page.php';
    }

    public function setup_sections() {
        add_settings_section( 'mapInEachPost_checkout_section', 'Post Checkout Settings', null, 'post_checkout_settings' );
    }

    public function setup_fields() {
        add_settings_field( 'post_types', 'Post Types', [ $this, 'field_callback' ], 'post_checkout_settings', 'mapInEachPost_checkout_section' );
        register_setting( 'post_checkout_settings', 'post_types' );
    }

    public function field_callback( $arguments ) {
        $post_types = get_option( 'post_types' );
        $all_post_types = get_post_types( [ 'public' => true ], 'objects' );

        foreach ( $all_post_types as $post_type ) {
            $checked = in_array( $post_type->name, (array) $post_types ) ? 'checked' : '';
            echo '<input type="checkbox" name="post_types[]" value="' . esc_attr( $post_type->name ) . '" ' . $checked . ' />';
            echo '<label for="post_types[]">' . esc_html( $post_type->label ) . '</label><br>';
        }
    }
}
