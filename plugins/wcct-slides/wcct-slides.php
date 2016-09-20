<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://jeffikus.com
 * @since             1.0.0
 * @package           WCCT_Slides
 *
 * @wordpress-plugin
 * Plugin Name:       WordCamp Cape Town Slides
 * Plugin URI:        https://github.com/jeffikus/wcct-plugins
 * Description:       Extended functionality for WP-API for my WCCT slides to function.
 * Version:           1.0.0
 * Author:            Jeffikus
 * Author URI:        http://jeffikus.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wcct-slides
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * wcct_prepare_post extends WP-API data object
 * @param  json $data    	data object for output
 * @param  object $post    	post object
 * @param  object $request 	type of request
 * @return json $data 		data object for output
 * Source https://1fix.io/blog/2015/06/26/adding-fields-wp-rest-api/
 */
function wcct_prepare_post( $data, $post, $request ) {
	$_data = $data->data;

	// Get Post Thumbnail and add to the data object
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'full' );
	$_data['featured_image_thumbnail_url'] = $thumbnail[0];

	// Add Specific Categories to the data object
	if ( in_category( 'intro' ) ) {
		$_data['cat_name'] = 'Intro';
	}
	if ( in_category( 'title' ) ) {
		$_data['cat_name'] = 'Title';
	}
	if ( in_category( 'vertical' ) ) {
		$_data['cat_name'] = 'Vertical';
	}

	// Add Specific Custom Post Meta to the data object
	$_data['cf_author'] = get_post_meta( $post->ID, 'author', true );
	$_data['cf_footer'] = get_post_meta( $post->ID, 'footer', true );

	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_post', 'wcct_prepare_post', 10, 3 );