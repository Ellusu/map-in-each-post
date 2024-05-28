<?php
    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }
?>
<div class="wrap">
    <h1><?php echo esc_html__('Map in Each Post Settings', 'map-in-each-post'); ?></h1>
    <form method="post" action="options.php">
        <?php
        settings_fields( 'map-in-each-post_type_settings' );
        do_settings_sections( 'map-in-each-post_type_settings' );
        submit_button();
        ?>
    </form>
</div>
