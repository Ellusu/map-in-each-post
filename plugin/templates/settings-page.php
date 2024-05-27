<?php
    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }
?>
<div class="wrap">
    <h1>Post Checkout Settings</h1>
    <form method="post" action="options.php">
        <?php
        settings_fields( 'post_checkout_settings' );
        do_settings_sections( 'post_checkout_settings' );
        submit_button();
        ?>
    </form>
</div>
