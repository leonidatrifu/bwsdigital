<?php
/**
 * Plugin Name:       BrightSmile Appointments
 * Description:       Appointment booking and contact form blocks for dental clinics. Requests are stored under "Appointments" in the dashboard and emailed to the clinic.
 * Version:           1.0.0
 * Requires at least: 6.6
 * Requires PHP:      7.4
 * Author:            BrightSmile Demo
 * License:           GPL-2.0-or-later
 * Text Domain:       brightsmile-appointments
 *
 * @package BrightSmileAppointments
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BSA_VERSION', '1.0.0' );
define( 'BSA_DIR', plugin_dir_path( __FILE__ ) );
define( 'BSA_URL', plugin_dir_url( __FILE__ ) );

require_once BSA_DIR . 'includes/forms.php';
require_once BSA_DIR . 'includes/admin.php';

/**
 * Register post types, styles and blocks.
 */
function brightsmile_appointments_init() {
	register_post_type(
		'bs_appointment',
		array(
			'labels'          => array(
				'name'               => __( 'Appointments', 'brightsmile-appointments' ),
				'singular_name'      => __( 'Appointment', 'brightsmile-appointments' ),
				'add_new'            => __( 'Add appointment', 'brightsmile-appointments' ),
				'add_new_item'       => __( 'Add appointment', 'brightsmile-appointments' ),
				'edit_item'          => __( 'Edit appointment', 'brightsmile-appointments' ),
				'all_items'          => __( 'All appointments', 'brightsmile-appointments' ),
				'search_items'       => __( 'Search appointments', 'brightsmile-appointments' ),
				'not_found'          => __( 'No appointment requests yet.', 'brightsmile-appointments' ),
				'not_found_in_trash' => __( 'No appointments in the trash.', 'brightsmile-appointments' ),
			),
			'public'          => false,
			'show_ui'         => true,
			'show_in_rest'    => false,
			'menu_position'   => 25,
			'menu_icon'       => 'dashicons-calendar-alt',
			'supports'        => array( 'title' ),
			'capability_type' => 'post',
		)
	);

	register_post_type(
		'bs_message',
		array(
			'labels'          => array(
				'name'          => __( 'Messages', 'brightsmile-appointments' ),
				'singular_name' => __( 'Message', 'brightsmile-appointments' ),
				'edit_item'     => __( 'View message', 'brightsmile-appointments' ),
				'all_items'     => __( 'Contact messages', 'brightsmile-appointments' ),
				'not_found'     => __( 'No messages yet.', 'brightsmile-appointments' ),
			),
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => 'edit.php?post_type=bs_appointment',
			'show_in_rest'    => false,
			'supports'        => array( 'title' ),
			'capability_type' => 'post',
			'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap'    => true,
		)
	);

	wp_register_style( 'brightsmile-forms', BSA_URL . 'assets/forms.css', array(), BSA_VERSION );

	register_block_type( BSA_DIR . 'blocks/appointment-form' );
	register_block_type( BSA_DIR . 'blocks/contact-form' );
}
add_action( 'init', 'brightsmile_appointments_init' );
