<?php
/**
 * BrightSmile Dental theme functions.
 *
 * @package BrightSmile
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BRIGHTSMILE_VERSION', '1.0.0' );

require_once get_theme_file_path( 'inc/helpers.php' );
require_once get_theme_file_path( 'inc/demo-content.php' );

/**
 * Theme supports and editor styles.
 */
function brightsmile_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( array( 'style.css', 'assets/editor.css' ) );
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'brightsmile_setup' );

/**
 * Front-end stylesheet.
 */
function brightsmile_enqueue_assets() {
	wp_enqueue_style( 'brightsmile-style', get_stylesheet_uri(), array(), BRIGHTSMILE_VERSION . '.' . filemtime( get_theme_file_path( 'style.css' ) ) );
}
add_action( 'wp_enqueue_scripts', 'brightsmile_enqueue_assets' );

/**
 * Block style variations that editors can pick from the block sidebar.
 */
function brightsmile_register_block_styles() {
	register_block_style( 'core/group', array( 'name' => 'card', 'label' => __( 'Card', 'brightsmile' ) ) );
	register_block_style( 'core/group', array( 'name' => 'panel', 'label' => __( 'Rounded panel', 'brightsmile' ) ) );
	register_block_style( 'core/paragraph', array( 'name' => 'eyebrow', 'label' => __( 'Eyebrow label', 'brightsmile' ) ) );
	register_block_style( 'core/list', array( 'name' => 'checklist', 'label' => __( 'Checklist', 'brightsmile' ) ) );
	register_block_style( 'core/image', array( 'name' => 'rounded-lg', 'label' => __( 'Soft corners', 'brightsmile' ) ) );
}
add_action( 'init', 'brightsmile_register_block_styles' );

/**
 * Pattern categories shown in the block inserter.
 */
function brightsmile_register_pattern_categories() {
	register_block_pattern_category( 'brightsmile', array( 'label' => __( 'BrightSmile sections', 'brightsmile' ) ) );
	register_block_pattern_category( 'brightsmile-pages', array( 'label' => __( 'BrightSmile pages', 'brightsmile' ) ) );
}
add_action( 'init', 'brightsmile_register_pattern_categories' );

/**
 * Remind the admin to activate the appointments plugin that powers the forms.
 */
function brightsmile_plugin_notice() {
	if ( ! current_user_can( 'activate_plugins' ) || function_exists( 'brightsmile_appointments_init' ) ) {
		return;
	}
	echo '<div class="notice notice-warning"><p>';
	esc_html_e( 'BrightSmile Dental: activate the "BrightSmile Appointments" plugin to enable the booking and contact forms.', 'brightsmile' );
	echo '</p></div>';
}
add_action( 'admin_notices', 'brightsmile_plugin_notice' );
