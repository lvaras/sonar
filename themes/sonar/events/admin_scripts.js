(function($) {

$(function () {

	// starting date
	$(".sonar_event_manager #event_starting_date").datepicker({
	  dateFormat: 'yy-mm-dd',//'dd-mm-yy',
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      minDate: 0,
      onClose: function( selectedDate ) {
        $(".sonar_event_manager #event_ending_date").datepicker( "option", "minDate", selectedDate );
      }
    });
	  // starting time
    $(".sonar_event_manager #event_starting_time").timepicker({ 'step': 30 , 'timeFormat': 'G:i' });

    //ending date
    $(".sonar_event_manager #event_ending_date").datepicker({
      dateFormat: 'yy-mm-dd',//'dd-mm-yy',
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      minDate: 0
    });
    // ending time
    $(".sonar_event_manager #ending_time").timepicker({ 'step': 30 , 'timeFormat': 'G:i' });

    // select field
    $(".sonar_event_manager #map_tracking").change(function () {
      console.log($(this).val());
    	switch($(this).val()) 
      {
    		case "address":
          $(".geo_cordinates_box").fadeOut().promise().done(function () {
            $(".address_box").fadeIn();
          });
    		break;
    		case "geo_cordinates":
    			$(".address_box").fadeOut().promise().done(function () {
            $(".geo_cordinates_box").fadeIn();
          });
    		break;
    		default:
    		break;
    	}
    });


});

})(jQuery);
