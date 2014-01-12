(function($) {

// variabile globale sonar_wp_data contiene variabili dal back-end
$(function () {

	var container = document.querySelector('.cont-event');
	var msnry = new Masonry( container, {
	  // options
	  columnWidth: 2,
	  itemSelector: '.event'
	});

	// scripts..
	var map_element = $("#map");
	var map_latitude = map_element.attr("data-lat");
	var map_longitude = map_element.attr("data-long");
	var address = map_element.attr("data-address");
	var marker;

	var map_options = {
	    zoom: 16,
	    center: new google.maps.LatLng(45.47, 9.18),
	    mapTypeId: google.maps.MapTypeId.ROADMAP,
	    styles: get_customize_map_array_grey()
	};

	var map = new google.maps.Map(document.getElementById('map'), map_options);
	var myLatlng = new google.maps.LatLng( map_latitude, map_longitude );
    var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Hello World!'
  	});
	var geocoder = new google.maps.Geocoder();
	codeAddress( $("#map").attr("data-address") );
	
}); /* DOM ready  */

function map_controller () 
{
	var init = function () {

	}
}

/**
* Gets the address and performs a GEO query to get the coordinats
* @param: String ( the address )
**/
function codeAddress( address ) 
{
    //var address = $("#map").attr("data-address");
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
        map.panTo(
			marker.getPosition()
		);
      } else {
        console.log("Geocode was not found : " + status);
      }
    });
}

function get_customize_map_array_grey () 
{
	return [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]
}

function get_customize_map_array_turquoise () 
{
	return [{"stylers":[{"hue":"#16a085"},{"saturation":0}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]}];
}

})(jQuery);