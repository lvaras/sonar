
(function($) {


	// FUNZIONE STICK FOOTER
	$(window).bind("load", function() { 
	         
	       //setup the height and position for your sticky footer
	       footerHeight = 0,
	       footerTop = 0,
	       $footer = $("#footer");
	 
	       positionFooter();
	 
	       function positionFooter() {
	 
	               footerHeight = $footer.height();
	                 
	               if ( ($(document.body).height()+footerHeight) > $(window).height()) {
	                   $footer.css({
	                        position: "fixed"
	                   })
	                   $("#wrapper").css('padding-bottom', footerHeight+'px');
	               } else {
	                   $footer.css({
	                        position: "static"
	                   })
	               }
	 
	       }
	 
	       $(window)
	               .resize(positionFooter)
	 
	});
	
	// ATTIVA BOX SLIDER
	$(document).ready(function(){
		$('.bxslider').bxSlider();
	});
	
	
	
	
	
// variabile globale sonar_wp_data contiene variabili dal back-end
$(function () {

	//if( !$('body').hasClass('sonar-light') ) {
	//	$("body").backstretch('wp-content/themes/sonar/img/sonar_bg.jpg');
	//}

	// Inizializzo mappa
	map_controller = new map_controller();
	map_controller.init();

	var msnry_container = document.querySelector('.cont-wall');
	if(msnry_container !== null)
	{
		var msnry = new Masonry( msnry_container, {
		  columnWidth: 230,
		  itemSelector: '.box-wall'
		});
	}

}); /* DOM ready  */


function map_controller () 
{
	var self = this;
	self.geocoder = new google.maps.Geocoder();
	self.map_element = $("#map");
	self.map_latitude = self.map_element.attr("data-lat");
	self.map_longitude = self.map_element.attr("data-long");
	self.address = self.map_element.attr("data-address");
	self.marker;

	/**
	* Constructor
	**/
	self.init = function () 
	{
	//	self.codeAddress( $("#map").attr("data-address") );
	}
	/**
	* Gets the address and performs a GEO query to get the coordinats
	* @param: String ( the address )
	**/
	self.codeAddress = function ( address ) 
	{
	    self.geocoder.geocode( 
	    	{ 
	    		'address' : 'milano'
	    	} , 
		    function(results, status) 
		    {
		      if (status == google.maps.GeocoderStatus.OK) 
		      {
		      	var map_options = {
				    zoom: 16,
				    center: new google.maps.LatLng(45.47, 9.18),
				    mapTypeId: google.maps.MapTypeId.ROADMAP,
				    styles: get_customize_map_array_grey()
				}
				var map = new google.maps.Map(
					document.getElementById('map'), 
					map_options
				);
				var bounds = new google.maps.LatLngBounds();
		        map.setCenter(results[0].geometry.location);
		        marker = new google.maps.Marker({
		            map: map,
		            position: results[0].geometry.location
		        });
		        map.panTo(
					marker.getPosition()
				);
		      } 
		      else 
		      {
		        console.log("Geocode was not found : " + status);
		      }
		   	}
		);
	}

	self.toString = function ( address ) 
	{
		return self.map_latitude + 
				self.map_longitude +
					self.address;
	}


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