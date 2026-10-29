<?php
/**
 * One-time demo content import.
 *
 * When the theme is activated it creates the five demo pages (as normal,
 * editable WordPress pages built from the theme's patterns), sets the static
 * front page, enables pretty permalinks and creates the main navigation menu.
 * Existing pages with the same slug are never overwritten.
 *
 * @package BrightSmile
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Pages created on activation: slug => [ title, pattern file, menu label ].
 */
function brightsmile_demo_pages() {
	return array(
		'home'             => array( 'Home', 'page-home', 'Home' ),
		'about-us'         => array( 'About Us', 'page-about', 'About Us' ),
		'services'         => array( 'Services', 'page-services', 'Services' ),
		'book-appointment' => array( 'Book an Appointment', 'page-appointment', 'Book Appointment' ),
		'contact'          => array( 'Contact', 'page-contact', 'Contact' ),
	);
}

/**
 * Create the demo pages and menu. Safe to call more than once.
 */
function brightsmile_install_demo_content() {
	if ( get_option( 'brightsmile_demo_installed' ) ) {
		return;
	}

	// Pretty permalinks so links such as /services/ work.
	if ( ! get_option( 'permalink_structure' ) ) {
		global $wp_rewrite;
		$wp_rewrite->set_permalink_structure( '/%postname%/' );
	}

	// Only replace the site title/tagline if they are still WordPress defaults.
	$default_names = array( '', 'My WordPress Website', 'My WordPress Site', 'WordPress' );
	if ( in_array( get_option( 'blogname' ), $default_names, true ) ) {
		update_option( 'blogname', 'BrightSmile Dental' );
	}
	if ( in_array( get_option( 'blogdescription' ), array( '', 'Just another WordPress site' ), true ) ) {
		update_option( 'blogdescription', 'Gentle, modern dentistry for the whole family' );
	}

	$ids   = array();
	$order = 0;
	foreach ( brightsmile_demo_pages() as $slug => $page ) {
		$existing = get_page_by_path( $slug );
		if ( $existing ) {
			$ids[ $slug ] = $existing->ID;
			continue;
		}
		$ids[ $slug ] = wp_insert_post(
			array(
				'post_type'     => 'page',
				'post_status'   => 'publish',
				'post_title'    => $page[0],
				'post_name'     => $slug,
				'menu_order'    => $order++,
				'post_content'  => wp_slash( brightsmile_pattern( $page[1] ) ),
				'page_template' => 'page-landing',
			)
		);
	}

	if ( ! empty( $ids['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['home'] );
	}

	// Main menu (Appearance → Editor → Navigation).
	$links = '';
	foreach ( brightsmile_demo_pages() as $slug => $page ) {
		if ( empty( $ids[ $slug ] ) || is_wp_error( $ids[ $slug ] ) ) {
			continue;
		}
		$attrs = array(
			'label' => $page[2],
			'type'  => 'page',
			'id'    => (int) $ids[ $slug ],
			'url'   => get_permalink( $ids[ $slug ] ),
			'kind'  => 'post-type',
		);
		// The header already has a "Book Appointment" button on desktop.
		if ( 'book-appointment' === $slug ) {
			$attrs['className'] = 'bs-mobile-only';
		}
		$links .= '<!-- wp:navigation-link ' . wp_json_encode( $attrs, JSON_UNESCAPED_SLASHES ) . ' /-->' . "\n";
	}
	wp_insert_post(
		array(
			'post_type'    => 'wp_navigation',
			'post_status'  => 'publish',
			'post_title'   => 'Main Menu',
			'post_content' => wp_slash( $links ),
		)
	);

	update_option( 'brightsmile_demo_installed', 1 );
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'brightsmile_install_demo_content' );
