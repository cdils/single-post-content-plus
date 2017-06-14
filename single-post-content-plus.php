<?php
/**
 * Plugin Name:	Single Post Content Plus
 * Description:	Adds a sidebar/widget aka to single posts.
 * Version:		0.1.0
 * Author:		Carrie Dils
 * Author URI:	https://carriedils.com
 * Text Domain:	spcp
 * License:		GPL-2.0+
 * Github Plugin URI:	https://github.com/cdils/single-post-content-plus
 */

// If this file is called directly, abort
if ( !defined('ABSPATH') ) {
	die;
}

add_action( 'wp_enqueue_scripts', 'spcp_login_stylesheet' );
/**
 * Load plugin styles.
 *
 */
function spcp_login_stylesheet() {

	if ( apply_filters( 'spcp_load_styles', true ) ) {
		wp_enqueue_style( 'spcp-custom-stylesheet', plugin_dir_url(__FILE__) . 'spcp-styles.css' );
	}
}

// Uncomment the following line to keep spcp-custom-stylesheet from loading
// add_filter( 'spcp_load_styles', '__return_false' );

add_action( 'widgets_init', 'spcp_register_sidebar');
/**
 * Registers a sidebar called Post Content Plus.
 */
function spcp_register_sidebar() {
	
		register_sidebar( array(
			'name'			=> __( 'Post Content Plus', 'spcp'),
			'id'			=> 'spcp-sidebar',
			'description' 	=> __( 'Widgets in this area display on single posts', 'spcp' ),
			'before_widget'	=> '<div class="widget spcp-sidebar">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h2 class="widgettitle spcp-title">',
			'after_title'	=> '</h2>',
		) );

}

add_filter( 'the_content', 'spcp_display_sidebars' );
/**
 * Display sidebar on single posts.
 * 
 */
function spcp_display_sidebars( $content ) {

	if ( is_single() && is_active_sidebar( 'spcp-sidebar' ) && is_main_query()  ) {
		dynamic_sidebar( 'spcp-sidebar' );
	}

	return $content;
}
