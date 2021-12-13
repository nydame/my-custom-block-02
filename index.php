<?php

/**
 * Plugin Name: My First Gutenberg Block
 * Plugin URI: https://pineapplesodasoftware.com/blocks
 * Description: This plugin demonstrates how to register a static block for the Gutenberg editor.
 * Version: 1.0.2
 * Author: Felicia Betancourt
 *
 * @package pss-blocks
 */

defined( 'ABSPATH' ) || exit;

/**
 * Load all translations for our plugin from the MO file.
*/
add_action( 'init', 'my_first_gutenberg_block_load_textdomain' );

function my_first_gutenberg_block_load_textdomain() {
	load_plugin_textdomain( 'pss-blocks', false, basename( __DIR__ ) . '/languages' );
}

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * Passes translations to JavaScript.
 */
function my_first_gutenberg_block_register_block() {

	if ( ! function_exists( 'register_block_type' ) ) {
		// Gutenberg is not active.
		return;
	}

	$asset_file = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php' );

	wp_register_script(
		'my-first-gutenberg-block',
		plugins_url( 'build/index.js', __FILE__ ),
		$asset_file['dependencies'],
		$asset_file['version'],
	);

	register_block_type( 'pss-blocks/my-first-gutenberg-block', array(
		'api_version' => 2,
		'editor_script' => 'my-first-gutenberg-block',
	) );

  if ( function_exists( 'wp_set_script_translations' ) ) {
    /**
     * May be extended to wp_set_script_translations( 'my-handle', 'my-domain',
     * plugin_dir_path( MY_PLUGIN ) . 'languages' ) ). For details see
     * https://make.wordpress.org/core/2018/11/09/new-javascript-i18n-support-in-wordpress/
     */
    wp_set_script_translations( 'my-first-gutenberg-block', 'pss-blocks' );
  }

}
add_action( 'init', 'my_first_gutenberg_block_register_block' );