/* google map for events
	-------------------------*/
	(function googleMap($) {

		// create new map
		function new_map( $el ) {
			var customMapType = new google.maps.StyledMapType(
				[
					{
						"featureType": "administrative",
						"elementType": "labels.text.fill",
						"stylers": [
							{"color": "#777777"}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "labels.text.stroke",
						"stylers": [
							{"visibility": "off"}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "all",
						"stylers": [
							{"color": "#f2f2f2"}
						]
					},
					{
						"featureType": "poi",
						"elementType": "all",
						"stylers": [
							{"visibility": "off"}
						]
					},
					{
						"featureType": "road",
						"elementType": "all",
						"stylers": [
							{"saturation": -100},
							{"lightness": 45}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "all",
						"stylers": [
							{"visibility": "simplified"}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry",
						"stylers": [
							{"visibility": "simplified"},
							{"hue": "#00ff53"},
							{"saturation": "60"},
							{"lightness": "-10"},
							{"gamma": "1.10"}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "labels.text",
						"stylers": [
							{"color": "#656565"}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "labels.text.stroke",
						"stylers": [
							{"visibility": "off"}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry",
						"stylers": [
							{"hue": "#0081ff"},
							{"saturation": "70"},
							{"lightness": "-20"},
							{"gamma": "1.10"}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "labels.text",
						"stylers": [
							{"color": "#656565"}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "labels.text.stroke",
						"stylers": [
							{"visibility": "off"}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "labels.icon",
						"stylers": [
							{"visibility": "off"}
						]
					},
					{
						"featureType": "transit",
						"elementType": "all",
						"stylers": [
							{"visibility": "off"}
						]
					},
					{
						"featureType": "water",
						"elementType": "all",
						"stylers": [
							{"color": "#78c3f5"},
							{"visibility": "on"}
						]
					},
					{
						"featureType": "water",
						"elementType": "labels",
						"stylers": [
							{"visibility": "off"}
						]
					}
				],
				{
					name: 'Custom Style'
				}
			);

			var customMapTypeId = 'custom_style';


			var $markers = $el.find('.marker');
			var args = {
				zoom: 					15,
				center: 				new google.maps.LatLng(0, 0),
				mapTypeControl: false,
				zoomControl: 		true,
				scrollwheel: 		false,
				zoomControlOptions: {
					position: google.maps.ControlPosition.RIGHT_BOTTOM
				},
				scaleControl: 		 false,
				streetViewControl: false,
			};

			var map = new google.maps.Map( $el[0], args);
			map.mapTypes.set(customMapTypeId, customMapType);
			map.setMapTypeId(customMapTypeId);

			map.markers = [];
			// add markers
			$markers.each(function(){
		    add_marker( $(this), map );
			});

			center_map( map );

			return map;
		}


		// add markers
		function add_marker( $marker, map ) {

			var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

			var marker = new google.maps.Marker({
				position: latlng,
				map: map
			});

			map.markers.push( marker );

			// if marker contains HTML, add it to an infoWindow
			if( $marker.html() ) {
				// create info window
				var infowindow = new google.maps.InfoWindow({
					content: $marker.html()
				});

				// show info window when marker is clicked
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open( map, marker );
					if (!this.moved) {
						map.panBy(0,-50);
						this.moved = true;
					}
				});
			}

		}


		// center map
		function center_map( map ) {
			var bounds = new google.maps.LatLngBounds();

			// loop through all markers and create bounds
			$.each( map.markers, function( i, marker ){
				var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
				bounds.extend( latlng );
			});

			if( map.markers.length == 1 ) {
			   map.setCenter( bounds.getCenter() );
			   map.setZoom( 15 );
			} else {
				// fit to bounds
				map.fitBounds( bounds );
			}
		}


		var map = null;

		$(document).ready(function(){
			$('.acf-map').each(function(){
				// render map
				map = new_map( $(this) );
			});
		});

	})(jQuery);
