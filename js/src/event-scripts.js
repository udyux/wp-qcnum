/* google map for events */
var initMap = (function() {
  var mapStyles = [
		{
			"featureType": "administrative",
			"elementType": "labels.text.fill",
			"stylers": [
				{"color": "#777777"}
			]
		},{
			"featureType": "administrative",
			"elementType": "labels.text.stroke",
			"stylers": [
				{"visibility": "off"}
			]
		},{
			"featureType": "landscape",
			"elementType": "all",
			"stylers": [
				{"color": "#f2f2f2"}
			]
		},{
			"featureType": "poi",
			"elementType": "all",
			"stylers": [
				{"visibility": "off"}
			]
		},{
			"featureType": "road",
			"elementType": "all",
			"stylers": [
				{"saturation": -100},
				{"lightness": 45}
			]
		},{
			"featureType": "road.highway",
			"elementType": "all",
			"stylers": [
				{"visibility": "simplified"}
			]
		},{
			"featureType": "road.highway",
			"elementType": "geometry",
			"stylers": [
				{"visibility": "simplified"},
				{"hue": "#00ff53"},
				{"saturation": "60"},
				{"lightness": "-10"},
				{"gamma": "1.10"}
			]
		},{
			"featureType": "road.highway",
			"elementType": "labels.text",
			"stylers": [
				{"color": "#656565"}
			]
		},{
			"featureType": "road.highway",
			"elementType": "labels.text.stroke",
			"stylers": [
				{"visibility": "off"}
			]
		},{
			"featureType": "road.arterial",
			"elementType": "geometry",
			"stylers": [
				{"hue": "#0081ff"},
				{"saturation": "70"},
				{"lightness": "-20"},
				{"gamma": "1.10"}
			]
		},{
			"featureType": "road.arterial",
			"elementType": "labels.text",
			"stylers": [
				{"color": "#656565"}
			]
		},{
			"featureType": "road.arterial",
			"elementType": "labels.text.stroke",
			"stylers": [
				{"visibility": "off"}
			]
		},{
			"featureType": "road.arterial",
			"elementType": "labels.icon",
			"stylers": [
				{"visibility": "off"}
			]
		},{
			"featureType": "transit",
			"elementType": "all",
			"stylers": [
				{"visibility": "off"}
			]
		},{
			"featureType": "water",
			"elementType": "all",
			"stylers": [
				{"color": "#78c3f5"},
				{"visibility": "on"}
			]
		},{
			"featureType": "water",
			"elementType": "labels",
			"stylers": [
				{"visibility": "off"}
			]
		}
	];

  var mapNode = document.getElementById('map');

  if (mapNode) {
    var position = {
      lat: parseFloat(mapNode.dataset.lat),
      lng: parseFloat(mapNode.dataset.lng)
    };

    var map = new google.maps.Map(mapNode, {
      center: position,
      styles: mapStyles,
  		zoomControl: true,
  		scrollwheel: false,
      scaleControl: false,
      mapTypeControl: false,
      zoom: parseFloat(mapNode.dataset.zoom),
  		zoomControlOptions: {position: google.maps.ControlPosition.RIGHT_BOTTOM}
    });

    var infowindow = new google.maps.InfoWindow({
      content: getInfoWindow()
    });

    var marker = new google.maps.Marker({
      map: map,
      position: position,
      animation: google.maps.Animation.DROP
    });

    marker.addListener('click', function() {
      infowindow.open(map, marker);
      if (!this.moved) {
        map.panBy(0,-50);
        this.moved = true;
      }
    });
  }

  function getInfoWindow() {
    var div = document.createElement('div');
    var h4 = document.createElement('h4');
    var p = document.createElement('p');
    var a = document.createElement('a');

    div.className = 'map__marker';
    h4.className = 'map__venue';
    p.className = 'map__address';
    a.className = 'map__link';

    h4.innerHTML = mapNode.dataset.venue;
    p.innerHTML = mapNode.dataset.address;
    a.href = mapNode.dataset.link;
    a.target = '_blank';

    div.appendChild(h4);
    div.appendChild(p);
    div.appendChild(a);

    return div;
  };

});
