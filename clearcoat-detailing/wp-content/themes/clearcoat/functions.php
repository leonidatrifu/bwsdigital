<?php
/**
 * Clearcoat theme setup.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function clearcoat_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus(
		array(
			'primary' => __( 'Top menu', 'clearcoat' ),
		)
	);
}
add_action( 'after_setup_theme', 'clearcoat_setup' );

function clearcoat_assets() {
	wp_enqueue_style(
		'clearcoat-fonts',
		'https://fonts.googleapis.com/css2?family=Archivo:wdth,wght@125,500;125,700&family=IBM+Plex+Sans:wght@400;500&family=IBM+Plex+Mono:wght@400&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'clearcoat-style',
		get_stylesheet_uri(),
		array( 'clearcoat-fonts' ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'clearcoat_assets' );

/**
 * Contact details, editable in Appearance > Customize > Business details.
 */
function clearcoat_defaults() {
	return array(
		'clearcoat_location' => 'Mobile & studio detailing · Portland, OR',
		'clearcoat_phone'    => '(503) 555-0148',
		'clearcoat_email'    => 'book@clearcoatdetail.com',
		'clearcoat_hours'    => 'Tue–Sat, 8am–6pm',
	);
}

function clearcoat_option( $key ) {
	$defaults = clearcoat_defaults();
	return get_theme_mod( $key, isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' );
}

function clearcoat_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'clearcoat_business',
		array(
			'title'    => __( 'Business details', 'clearcoat' ),
			'priority' => 30,
		)
	);

	$fields = array(
		'clearcoat_location' => __( 'Tagline above the headline', 'clearcoat' ),
		'clearcoat_phone'    => __( 'Phone', 'clearcoat' ),
		'clearcoat_email'    => __( 'Email', 'clearcoat' ),
		'clearcoat_hours'    => __( 'Hours', 'clearcoat' ),
	);
	$defaults = clearcoat_defaults();

	foreach ( $fields as $id => $label ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $defaults[ $id ],
				'sanitize_callback' => 'clearcoat_email' === $id ? 'sanitize_email' : 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $label,
				'section' => 'clearcoat_business',
				'type'    => 'clearcoat_email' === $id ? 'email' : 'text',
			)
		);
	}
}
add_action( 'customize_register', 'clearcoat_customize_register' );

/**
 * Fallback menu used until a "Top menu" is assigned in Appearance > Menus.
 */
function clearcoat_menu_fallback() {
	$base = is_front_page() ? '' : home_url( '/' );
	echo '<ul>';
	echo '<li><a href="' . esc_url( $base . '#services' ) . '">' . esc_html__( 'Services', 'clearcoat' ) . '</a></li>';
	echo '<li><a href="' . esc_url( $base . '#process' ) . '">' . esc_html__( 'Process', 'clearcoat' ) . '</a></li>';
	echo '<li><a href="' . esc_url( $base . '#book' ) . '">' . esc_html__( 'Book', 'clearcoat' ) . '</a></li>';
	echo '</ul>';
}
