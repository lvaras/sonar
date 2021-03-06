<div class="sonar_event_manager">
	<form>
		<?php wp_nonce_field( 'event_custom_box', 'event_custom_box_nonce' ); ?>
		<h4>Starts</h4>
		<label for="event_starting_date">From:</label>
		<input type="text" id="event_starting_date" 
			name="event_meta[starting_date]" value="<?php echo get_post_meta( get_the_ID() , '_starting_date' , true ) ?>">

		<label for="event_starting_time">at:</label>
		<input type="text" id="event_starting_time" 
			name="event_meta[starting_time]" value="<?php echo get_post_meta( get_the_ID() , '_starting_time' , true ) ?>">

		<h4>Finishes</h4>
		<label for="event_ending_date">To:</label>
		<input type="text" id="event_ending_date" 
			name="event_meta[ending_date]" value="<?php echo get_post_meta( get_the_ID() , '_ending_date' , true ) ?>">
		<label>at:</label>
		<input type="text" id="ending_time" 
			name="event_meta[ending_time]" value="<?php echo get_post_meta( get_the_ID() , '_ending_time' , true ) ?>">
		<div class="clear"></div>

		<div style="padding: 20px 0 20px 0;">
			<label for="map_tracking">
				Map options: <br/>
				Choose between geo cordinates or address to track this event on the map.
			</label>
			<div class="clear"></div>
			<select name="event_meta[map_tracking]" id="map_tracking" style="width: 30%;">
				<option value="address">Address</option>
				<option value="geo_cordinates">Lat & Long</option>   
			</select>
		</div>

		<div class="geo_cordinates_box geo_option">
			<label for="event_latitude">Lat:</label>
			<input type="text" name="event_meta[latitude]" id="event_latitude"></input>
			<label for="event_longitude">Long:</label>
			<input type="text" name="event_meta[longitude]" id="event_longitude"></input>
		</div>

		<div class="address_box geo_option">
			<label for="event_address">Adress:</label>
			<input type="text" name="event_meta[address]" id="event_address"></input>
		</div>

		<div class="event_price">
			<label for="event_free_ticket">Is free event:</label>
			<input type="checkbox" name="event_meta[free_ticket]" id="event_free_ticket" />
			<div class="clear"></div>
			<label for="event_ticket_price">Ticket Price:</label>
			<input type="text" name="event_meta[ticket_price]" id="event_ticket_price"/>
			<label for="event_ticket_price_currency">Currency:</label>
			<input type="text" name="event_meta[ticket_price_currency]" id="event_ticket_price_currency"/>
		</div>
		<div class="clear"></div>
	</form>
</div>