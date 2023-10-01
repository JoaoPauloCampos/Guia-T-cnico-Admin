<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script>
	
	var geocoder;
	var map;
	
	function initialize() {
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(latitude, longitude);
		var mapOptions = {
			zoom: 8,
			center: latlng
		}
		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

		var loc = new google.maps.LatLng(latitude, longitude);

		var marker = new google.maps.Marker({
			map: map,
			position: loc
		});
	}

	google.maps.event.addDomListener(window, 'load', initialize);

  function codeAddress() {
    var address = document.getElementById("ChurchAddress").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        map.setZoom(17);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });

        document.getElementById("ChurchLat").value = results[0].geometry.location.lat();
        document.getElementById("ChurchLng").value = results[0].geometry.location.lng();
      } else {
        alert("Não foi possível obter as coordenadas deste endereço: " + status);
      }
    });
  }

</script>

<style>

	#map-canvas {
        height: 300px;
        margin: 0;
        padding: 0;
	}

      #panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }

      /*
      Provide the following styles for both ID and class,
      where ID represents an actual existing "panel" with
      JS bound to its name, and the class is just non-map
      content that may already have a different ID with
      JS bound to its name.
      */

      #panel, .panel {
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #panel select, #panel input, .panel select, .panel input {
        font-size: 15px;
      }

      #panel select, .panel select {
        width: 100%;
      }

      #panel i, .panel i {
        font-size: 12px;
      }

    </style>

<div id="map-canvas"></div>