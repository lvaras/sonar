<?php

if ( !function_exists( 'optionsframework_init' ) ) {

/*-----------------------------------------------------------------------------------*/
/* Options Framework Theme
/*-----------------------------------------------------------------------------------*/

/* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */

if ( get_stylesheet_directory() == get_template_directory() ) {
	define('OPTIONS_FRAMEWORK_URL', get_template_directory() . '/admin/theme_options/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/theme_options/');
} else {
	define('OPTIONS_FRAMEWORK_URL', get_stylesheet_directory() . '/admin/theme_options/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/admin/theme_options/');
}

require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">

jQuery(document).ready(function() {

	
	jQuery('input[id*="showhidden"]').click(function() {
		var id_input = jQuery(this).attr('id').split('_')[0];
		jQuery('[id*="section-' + id_input + '"]').each(function (index, el) {
			if( jQuery(el).attr('id').indexOf('texthidden') > -1 ) {
				jQuery(el).fadeToggle(400);
				return false;
			}
		});
	});
	

	jQuery('input[id*="showhidden"]').each(function (index, input) {
		if(jQuery(input).is(':checked'))
		{
			var id_input = jQuery(this).attr('id').split('_')[0];
			jQuery('[id*="section-' + id_input + '"]').each(function (index, el) {
				console.log(jQuery(el));
				if( jQuery(el).attr('id').indexOf('texthidden') > -1 ) {
					jQuery(el).show();
					return false;
				}
			});
		}
	});
	
});
</script>

<?php
}

/* 
 * Turns off the default options panel from Twenty Eleven
 */
 
add_action('after_setup_theme','remove_twentyeleven_options', 100);

function remove_twentyeleven_options() {
	remove_action( 'admin_menu', 'twentyeleven_theme_options_add_page' );
}