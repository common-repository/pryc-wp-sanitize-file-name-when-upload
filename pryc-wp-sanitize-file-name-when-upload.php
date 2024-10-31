<?php
/*
 * Plugin Name: PRyC WP: Sanitize file name (when upload)
 * Plugin URI: https://pl.wordpress.org/plugins/pryc-wp-sanitize-file-name-when-upload/
 * Description: Plugin sanitize file name when upload files - remove space, ASCII characters, lowercase, etc...
 * Author: PRyC
 * Author URI: http://PRyC.pl
 * Version: 1.0.4
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

 
 
/* CODE: */

if ( ! defined( 'ABSPATH' ) ) exit;

function pryc_wp_sanitize_file_name( $filename ) {

	$filename = remove_accents( $filename ); // Converts all accent characters to ASCII characters
	
	$filename = strtolower( $filename ); // Make a string lowercase
		
	$filename = preg_replace( '/-_+/', '-', $filename ); // -_ to -
	$filename = preg_replace( '/_-+/', '-', $filename ); // _- to -	
		
	$filename = preg_replace( '/-+/', '-', $filename ); // Remove multiple -
	$filename = preg_replace( '/_+/', '_', $filename ); // Remove multiple _
	
	$filename = str_replace( '-.', '.', $filename ); // Remove - at the end (before dot)
	$filename = str_replace( '_.', '.', $filename ); // Remove _ at the end (before dot)
	
	$filename = preg_replace('/\.(?=.*\.)/', '', $filename); // Only one, last dot
    
    return $filename;
}
add_filter( 'sanitize_file_name', 'pryc_wp_sanitize_file_name', 10 );


/* END */

