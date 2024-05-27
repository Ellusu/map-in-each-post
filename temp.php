<?php
    /* Template Name: page-speaker */ 
if(strpos($_SERVER["REQUEST_URI"],'/it/')===0) {
	$prossimamente = 'Prossimamente';	
}else{
	$prossimamente = 'Coming soon';		
}
get_header(); ?>

<div id="content-wrap" class="container">
	<header class="page-header">
		<?php the_title( '<h2 class="page-title">', '</h2>' ); ?>
	</header>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="single-page-wrapper">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
				<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" integrity="sha512-07I2e+7D8p6he1SIM+1twR5TIrhUQn9+I6yjqD53JQjFiMf8EtC93ty0/5vJTZGF8aAocvHYNEDJajGdNx1IsQ==" crossorigin="" />
	<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet-src.js" integrity="sha512-WXoSHqw/t26DszhdMhOXOkI7qCiv5QWXhH9R7CgvgZMHz1ImlkVQ3uNsiQKu5wwbbxtPzFXd1hK4tzno2VqhpA==" crossorigin=""></script>
	<link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/example/screen.css" />

	<link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.css" />
	<link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.Default.css" />
	<script src="https://leaflet.github.io/Leaflet.markercluster/dist/leaflet.markercluster-src.js"></script>

                        <div id="map" style="width: 100%;"></div>
         	<script type="text/javascript">

		var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				maxZoom: 18,
				attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Points &copy 2012 LINZ'
			}),
			latlng = L.latLng(42.7627812,9.1070471);
		var map = L.map('map', {center: latlng, zoom: 6, layers: [tiles]});
		var markers = L.markerClusterGroup();
		
        <?php
		$loops = array(
            array(
                'title' => 'Codici a confronto',
                'desc'  => 'Cagliari - 24/10/2015',
                'lat'   => '39.2278863',
                'lon'   => '9.1070471',
                'link'  => 'https://matteoenna.it/it/materiale-linux-day-2015-cagliari/'
            ),  
            array(
                'title' => 'Super insegnati digitali',
                'desc'  => 'Cagliari - 02/04/2016',
                'lat'   => '39.2151136',
                'lon'   => '9.1115809',
                'link'  => 'https://matteoenna.it/it/super-insegnanti-digitali/'
            ),   
            array(
                'title' => 'Tour Linux School: Siti Web, Html e Css',
                'desc'  => 'Macomer - 22/10/2016',
                'lat'   => '40.2627812',
                'lon'   => '8.7682721',
                'link'  => 'https://matteoenna.it/it/partecipero-al-linux-day-2016-a-macomer/'
            ),   
            array(
                'title' => 'Sviluppare in Open Source',
                'desc'  => 'Macomer - 22/10/2016',
                'lat'   => '40.2627812',
                'lon'   => '8.7682721',
                'link'  => 'https://matteoenna.it/it/partecipero-al-linux-day-2016-a-macomer/'
            ),   
            array(
                'title' => 'NerdBot',
                'desc'  => 'Cagliari - 02/10/2016',
                'lat'   => '39.2174296',
                'lon'   => '9.1070263',
                'link'  => 'https://matteoenna.it/it/nerd-bot-corso-bot-telegram-a-cagliari/'
            ),  
            array(
                'title' => 'Radio X: Open Data',
                'desc'  => 'Cagliari - 02/03/2017',
                'lat'   => '39.21469',
                'lon'   => '9.1186547',
                'link'  => 'https://matteoenna.it/it/open-data-day-2017-ospite-di-radio-x/'
            ),  
            array(
                'title' => 'Open Sardegna',
                'desc'  => 'Nuoro - 15/09/2017',
                'lat'   => '40.3195633',
                'lon'   => '9.3282727',
                'link'  => 'https://matteoenna.it/it/nuoro-intervento-sorsiaperiweb/'
            ),         
            array(
                'title' => 'La settimana del Rosadigitale 2018',
                'desc'  => 'Nuoro - 15/12/2017',
                'lat'   => '40.3195633',
                'lon'   => '9.3282727',
                'link'  => 'https://matteoenna.it/it/sorsiaperiweb-terzo-appuntamento-ci-anche/'
            ),            
            array(
                'title' => 'Telegram insegna',
                'desc'  => 'Macomer - 28/10/2017',
                'lat'   => '40.2627812',
                'lon'   => '8.7682721',
                'link'  => 'https://matteoenna.it/it/linux-day-2017-macomer-software-libero/'
            ),           
            array(
                'title' => 'Software Libero = Cittadino Libero: scoprirermo tutte le soluzioni “libere”',
                'desc'  => 'Macomer - 28/10/2017',
                'lat'   => '40.2627812',
                'lon'   => '8.7682721',
                'link'  => 'https://matteoenna.it/it/linux-day-2017-macomer-software-libero/'
            ),           
            array(
                'title' => 'StartUp: alcune Case History di uso del Software Libero',
                'desc'  => 'Milano - 27/10/2018',
                'lat'   => '45.517428',
                'lon'   => '9.2124727',
                'link'  => 'https://matteoenna.it/it/startup-e-software-libero-linux-day-milano/'
            ),           
            array(
                'title' => 'PHP: un linguaggio, come tanti, vivo grazie alle community Open source',
                'desc'  => 'Milano - 26/10/2019',
                'lat'   => '45.517428',
                'lon'   => '9.2124727',
                'link'  => 'https://matteoenna.it/it/linux-day-2019-secondo-voi-potevo-mancare/'
            ),          
            array(
                'title' => 'Drupal è diventato un CMF, e WordPress che fa?',
                'desc'  => 'Milano - 23/11/2019',
                'lat'   => '45.5184464',
                'lon'   => '9.210917',
                'link'  => 'https://matteoenna.it/it/wordcamp-milano-2019-saro-volunteers-e-speaker/'
            ),          
            array(
                'title' => 'Conosciamo WordPress e la sua community davanti a un buon caffè',
                'desc'  => 'Cagliari - 23/12/2019',
                'lat'   => '39.216305',
                'lon'   => '9.123274',
                'link'  => 'https://www.meetup.com/it-IT/Cagliari-WordPress-Meetup/events/267268581/'
            ),       
            array(
                'title' => 'I was a shy guy and I didn’t speak English, but then I discovered WordCamps!',
                'desc'  => 'Ginevra - 09/04/2022',
                'lat'   => '46.220461',
                'lon'   => '6.098683',
                'link'  => 'https://matteoenna.it/it/wordcamp-ginevra-2022-si-torna-in-presenza-e-saro-speaker/'
            ) ,              
            array(
                'title' => 'Varnish Cache, il web accelerator Open Source',
                'desc'  => 'Milano - 22/10/2022',
                'lat'   => '45.5184464',
                'lon'   => '9.210917',
                'link'  => 'https://matteoenna.it/it/varnish-cache-linux-day-2022-milano/'
            ),              
            array(
                'title' => 'Velocizzare WordPress, possiamo farlo con Varnish Cache!',
                'desc'  => 'Torino - 15/04/2023',
                'lat'   => '45.0501866',
                'lon'   => '7.6666622',
                'link'  => 'https://matteoenna.it/it/wordcamp-torino-2023-speaker-dove-tutto-e-iniziato/'
            ),              
            array(
                'title' => 'Crescere (come professionista) con WordPress, su WordPress',
                'desc'  => 'Milano - 11/10/2023',
                'lat'   => '45.478127',
                'lon'   => '9.228763',
                'link'  => 'https://matteoenna.it/it/speaker-al-wordpress-meetup-milano/'
            ),              
            array(
                'title' => 'Le best practice di un buon sviluppo web, lavorare con i CMS senza essere cugini',
                'desc'  => 'Milano - 28/10/2023',
                'lat'   => '45.5197',
                'lon'   => '9.21062',
                'link'  => 'https://matteoenna.it/it/linux-day-2023-sara-a-milano/'
            ),              
            array(
                'title' => 'Hook e child: sviluppare plugin facilmente estendibili!',
                'desc'  => 'Verona - 18/11/2023',
                'lat'   => '45.4399961',
                'lon'   => '10.9719328',
                'link'  => 'https://matteoenna.it/it/speaker-a-wordcamp-verona-2023-parlero-di-plugin-estendibili/'
            )
        );
        
        foreach($loops as $loop){
            $title  = $loop['title'];
            $lat    = $loop['lat'];
            $lng    = $loop['lon'];
            $link   = $loop['link'];
            $desc   = $loop['desc'];
        ?>
            
			var title = '<strong><?php echo $title; ?></strong><p><?php echo $desc; ?> </p><p><a href=\"<?php echo $link; ?>\" target=\"_blank\">View</a></p>';

			var marker = L.marker(new L.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>), { title: title });
			marker.bindPopup(title);
			markers.addLayer(marker);
 
 <?php } ?>

		map.addLayer(markers);
	</script>    
			</div><!-- .single-page-wrapper  -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>

</div><!-- .container -->

<?php
get_footer();
