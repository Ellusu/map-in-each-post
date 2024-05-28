<?php
    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }
    wp_nonce_field('save_mapineachpost_points', 'points_nonce');
    $points = !empty($points) ? $points : array();
    $enable_points = get_post_meta($post->ID, '_enable_points', true);
?>
<p>
    <label for="enable_mapineachpost_points">Abilita points per questo post:</label>
    <input type="checkbox" id="enable_mapineachpost_points" name="enable_mapineachpost_points" value="1" <?php checked($enable_points, '1'); ?> />
</p>
<div id="points-container" style="<?php echo $enable_points ? '' : 'display:none;'; ?>">
    <?php foreach ($points as $index => $point) :
        if (!$point) continue;
        ?>
        <table class="point-table">
            <thead>
                <tr>
                    <th colspan="2">Point <?php echo esc_html( $index ) + 1; ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label for="points[<?php echo esc_html( $index ); ?>][title]"><?php echo esc_html__('Title', 'map-in-each-post'); ?>:</label></td>
                    <td><input type="text" name="points[<?php echo esc_html( $index ); ?>][title]" value="<?php echo esc_attr($point['title']); ?>" /></td>
                </tr>
                <tr>
                    <td><label for="points[<?php echo esc_html( $index ); ?>][desc]"><?php echo esc_html__('Description', 'map-in-each-post'); ?>:</label></td>
                    <td><input type="text" name="points[<?php echo esc_html( $index ); ?>][desc]" value="<?php echo esc_attr($point['desc']); ?>" /></td>
                </tr>
                <tr>
                    <td><label for="points[<?php echo esc_html( $index ); ?>][lat]"><?php echo esc_html__('Latitude', 'map-in-each-post'); ?>:</label></td>
                    <td><input type="text" name="points[<?php echo esc_html( $index ); ?>][lat]" value="<?php echo esc_attr($point['lat']); ?>" /></td>
                </tr>
                <tr>
                    <td><label for="points[<?php echo esc_html( $index ); ?>][lon]"><?php echo esc_html__('Longitude', 'map-in-each-post'); ?>:</label></td>
                    <td><input type="text" name="points[<?php echo esc_html( $index ); ?>][lon]" value="<?php echo esc_attr($point['lon']); ?>" /></td>
                </tr>
                <tr>
                    <td><label for="points[<?php echo esc_html( $index ); ?>][link]"><?php echo esc_html__('Link', 'map-in-each-post'); ?>:</label></td>
                    <td><input type="text" name="points[<?php echo esc_html( $index ); ?>][link]" value="<?php echo esc_attr($point['link']); ?>" /></td>
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
<button type="button" id="add-point" style="<?php echo $enable_points ? '' : 'display:none;'; ?>"><?php echo esc_html__('Add point', 'map-in-each-post'); ?></button>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var enablePointsCheckbox = document.getElementById('enable_mapineachpost_points');
    var pointsContainer = document.getElementById('points-container');
    var addPointButton = document.getElementById('add-point');

    enablePointsCheckbox.addEventListener('change', function () {
        var isChecked = this.checked;
        pointsContainer.style.display = isChecked ? '' : 'none';
        addPointButton.style.display = isChecked ? '' : 'none';
    });

    document.getElementById('add-point').addEventListener('click', function () {
        var container = document.getElementById('points-container');
        var index = container.querySelectorAll('.point-table').length;
        var html = `
        <table class="point-table">
            <thead>
                <tr>
                    <th colspan="2">Point ` + (index + 1) + `</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label for="points[` + index + `][title]"><?php echo esc_html__('Title', 'map-in-each-post'); ?>:</label></td>
                    <td><input type="text" name="points[` + index + `][title]" value="" /></td>
                </tr>
                <tr>
                    <td><label for="points[` + index + `][desc]"><?php echo esc_html__('Description', 'map-in-each-post'); ?>:</label></td>
                    <td><input type="text" name="points[` + index + `][desc]" value="" /></td>
                </tr>
                <tr>
                    <td><label for="points[` + index + `][lat]"><?php echo esc_html__('Latitude', 'map-in-each-post'); ?>:</label></td>
                    <td><input type="text" name="points[` + index + `][lat]" value="" /></td>
                </tr>
                <tr>
                    <td><label for="points[` + index + `][lon]"><?php echo esc_html__('Longitude', 'map-in-each-post'); ?>:</label></td>
                    <td><input type="text" name="points[` + index + `][lon]" value="" /></td>
                </tr>
                <tr>
                    <td><label for="points[` + index + `][link]"><?php echo esc_html__('Link', 'map-in-each-post'); ?>:</label></td>
                    <td><input type="text" name="points[` + index + `][link]" value="" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="button" class="remove-point"><?php echo esc_html__('Remove point', 'map-in-each-post'); ?></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        `;
        container.insertAdjacentHTML('beforeend', html);
        attachRemoveEvents();
    });

    function attachRemoveEvents() {
        var buttons = document.getElementsByClassName('remove-point');
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].removeEventListener('click', removeEvent);
            buttons[i].addEventListener('click', removeEvent);
        }
    }

    function removeEvent(e) {
        e.target.closest('table').remove();
    }

    attachRemoveEvents();
});
</script>
<style>
    .point-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }
    .point-table th {
        background-color: #f2f2f2;
        padding: 10px;
        text-align: left;
    }
    .point-table td {
        padding: 10px;
    }
    .point-table input[type="text"] {
        width: 100%;
    }
    .remove-point {
        background-color: #f44336;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }
    .remove-point:hover {
        background-color: #d32f2f;
    }
</style>
