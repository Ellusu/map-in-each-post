<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

wp_nonce_field('save_mapineachpost_points', 'mapInEachPost_nonce_field');
$points = !empty($points) ? $points : array();
$enable_points = get_post_meta($post->ID, '_enable_mapineachpost_points', true);

?>
<p>
    <label for="_enable_mapineachpost_points"><?php echo esc_html__('Enable points for this post:', 'map-in-each-post'); ?></label>
    <input type="checkbox" id="_enable_mapineachpost_points" name="_enable_mapineachpost_points" value="1" <?php checked($enable_points, '1'); ?> />
</p>
<div id="points-container" style="<?php echo esc_attr($enable_points ? '' : 'display:none;'); ?>">
    <?php foreach ($points as $index => $point) :
        if (!$point) continue;
        ?>
        <table class="point-table">
            <thead>
                <tr>
                    <th colspan="2"><?php echo esc_html__('Point', 'map-in-each-post') . ' ' . esc_html( $index + 1 ); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label for="points[<?php echo esc_attr( $index ); ?>][title]"><?php echo esc_html__('Title', 'map-in-each-post'); ?>:</label></td>
                    <td><input type="text" name="points[<?php echo esc_attr( $index ); ?>][title]" value="<?php echo esc_attr($point['title']); ?>" /></td>
                </tr>
                <tr>
                    <td><label for="points[<?php echo esc_attr( $index ); ?>][desc]"><?php echo esc_html__('Description', 'map-in-each-post'); ?>:</label></td>
                    <td><input type="text" name="points[<?php echo esc_attr( $index ); ?>][desc]" value="<?php echo esc_attr($point['desc']); ?>" /></td>
                </tr>
                <tr>
                    <td><label for="points[<?php echo esc_attr( $index ); ?>][lat]"><?php echo esc_html__('Latitude', 'map-in-each-post'); ?>:</label></td>
                    <td><input type="text" name="points[<?php echo esc_attr( $index ); ?>][lat]" value="<?php echo esc_attr($point['lat']); ?>" /></td>
                </tr>
                <tr>
                    <td><label for="points[<?php echo esc_attr( $index ); ?>][lon]"><?php echo esc_html__('Longitude', 'map-in-each-post'); ?>:</label></td>
                    <td><input type="text" name="points[<?php echo esc_attr( $index ); ?>][lon]" value="<?php echo esc_attr($point['lon']); ?>" /></td>
                </tr>
                <tr>
                    <td><label for="points[<?php echo esc_attr( $index ); ?>][link]"><?php echo esc_html__('Link', 'map-in-each-post'); ?>:</label></td>
                    <td><input type="text" name="points[<?php echo esc_attr( $index ); ?>][link]" value="<?php echo esc_attr($point['link']); ?>" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="button" class="remove-point"><?php echo esc_html__('Remove point', 'map-in-each-post'); ?></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
    <?php endforeach; ?>
</div>
<button type="button" id="add-point" style="<?php echo esc_attr($enable_points ? '' : 'display:none;'); ?>"><?php echo esc_html__('Add point', 'map-in-each-post'); ?></button>