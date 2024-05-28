<?php
    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }
?>
<div id="map" style="width: 100%; height: 500px;"></div>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 50,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Points &copy 2012 LINZ'
        }),
        latlng = L.latLng(<?php echo esc_html($atts['lat']); ?>, <?php echo esc_html($atts['lon']); ?>);

        var map = L.map('map', {center: latlng, zoom: <?php echo esc_html($atts['zoom']); ?>, layers: [tiles]});
        var markers = L.markerClusterGroup();

        <?php foreach ($locations as $location) {
            $title = esc_js($location['title']);
            $desc = esc_js($location['desc']);
            $lat = esc_js($location['lat']);
            $lon = esc_js($location['lon']);
            $link = esc_js($location['link']);
        ?>
            var title = '<strong><?php echo esc_html($title); ?></strong><p><?php echo esc_html($desc); ?></p><p><a href="<?php echo esc_url($link); ?>" target="_blank">View</a></p>';
            var marker = L.marker(new L.LatLng(<?php echo esc_html($lat); ?>, <?php echo esc_html($lon); ?>), { title: title });
            marker.bindPopup(title);
            markers.addLayer(marker);
        <?php } ?>

        map.addLayer(markers);
    });
</script>