<?php
/**
 * Small helpers used by the block patterns.
 *
 * Patterns are only templates: once a pattern is inserted into a page, the
 * resulting blocks are ordinary editable content stored in the database.
 *
 * @package BrightSmile
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * URL of a file in the theme's assets folder.
 */
function brightsmile_asset( $path ) {
	return esc_url( get_theme_file_uri( 'assets/' . ltrim( $path, '/' ) ) );
}

/**
 * URL of a page on this site, e.g. brightsmile_url( 'contact' ).
 */
function brightsmile_url( $slug = '' ) {
	return esc_url( home_url( $slug ? '/' . trim( $slug, '/' ) . '/' : '/' ) );
}

/**
 * Default clinic details used when patterns are inserted.
 * Change them later directly in the editor, or filter them here.
 */
function brightsmile_info( $key ) {
	$info = apply_filters(
		'brightsmile_clinic_info',
		array(
			'name'        => 'BrightSmile Dental',
			'phone'       => '(555) 123-4567',
			'phone_href'  => 'tel:+15551234567',
			'email'       => 'hello@brightsmile.example',
			'street'      => '128 Bright Street, Suite 200',
			'city'        => 'Springfield, IL 62701',
			'hours_week'  => 'Mon – Fri: 8:00 – 19:00',
			'hours_sat'   => 'Saturday: 9:00 – 14:00',
			'hours_sun'   => 'Sunday: Closed',
			'emergency'   => '(555) 987-6543',
		)
	);
	return isset( $info[ $key ] ) ? esc_html( $info[ $key ] ) : '';
}

/**
 * Return the rendered markup of one of the theme's pattern files.
 */
function brightsmile_pattern( $name ) {
	$file = get_theme_file_path( 'patterns/' . sanitize_file_name( $name ) . '.php' );
	if ( ! file_exists( $file ) ) {
		return '';
	}
	ob_start();
	include $file;
	return trim( ob_get_clean() ) . "\n\n";
}

/**
 * Centered section intro: eyebrow, H2 and optional lead paragraph.
 */
function brightsmile_section_intro( $eyebrow, $title, $lead = '' ) {
	$out  = '<!-- wp:group {"layout":{"type":"constrained","contentSize":"680px"}} -->' . "\n";
	$out .= '<div class="wp-block-group">';
	$out .= '<!-- wp:paragraph {"align":"center","className":"is-style-eyebrow"} -->' . "\n";
	$out .= '<p class="has-text-align-center is-style-eyebrow">' . $eyebrow . '</p>' . "\n";
	$out .= '<!-- /wp:paragraph -->' . "\n\n";
	$out .= '<!-- wp:heading {"textAlign":"center"} -->' . "\n";
	$out .= '<h2 class="wp-block-heading has-text-align-center">' . $title . '</h2>' . "\n";
	$out .= '<!-- /wp:heading -->';
	if ( $lead ) {
		$out .= "\n\n" . '<!-- wp:paragraph {"align":"center","textColor":"contrast-2"} -->' . "\n";
		$out .= '<p class="has-text-align-center has-contrast-2-color has-text-color">' . $lead . '</p>' . "\n";
		$out .= '<!-- /wp:paragraph -->';
	}
	$out .= '</div>' . "\n" . '<!-- /wp:group -->';
	return $out;
}

/**
 * Hero banner used at the top of inner pages.
 */
function brightsmile_page_header( $eyebrow, $title, $lead ) {
	$out  = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|60"}}},"gradient":"hero","layout":{"type":"constrained","contentSize":"780px"}} -->' . "\n";
	$out .= '<div class="wp-block-group alignfull has-hero-gradient-background has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--60)">';
	$out .= '<!-- wp:paragraph {"align":"center","className":"is-style-eyebrow"} -->' . "\n";
	$out .= '<p class="has-text-align-center is-style-eyebrow">' . $eyebrow . '</p>' . "\n";
	$out .= '<!-- /wp:paragraph -->' . "\n\n";
	$out .= '<!-- wp:heading {"textAlign":"center","level":1} -->' . "\n";
	$out .= '<h1 class="wp-block-heading has-text-align-center">' . $title . '</h1>' . "\n";
	$out .= '<!-- /wp:heading -->' . "\n\n";
	$out .= '<!-- wp:paragraph {"align":"center","textColor":"contrast-2","fontSize":"large"} -->' . "\n";
	$out .= '<p class="has-text-align-center has-contrast-2-color has-text-color has-large-font-size">' . $lead . '</p>' . "\n";
	$out .= '<!-- /wp:paragraph -->';
	$out .= '</div>' . "\n" . '<!-- /wp:group -->';
	return $out;
}

/**
 * A card with an icon, title, text and an optional link.
 */
function brightsmile_icon_card( $icon, $title, $text, $link_label = '', $link_url = '' ) {
	$out  = '<!-- wp:group {"className":"is-style-card","layout":{"type":"default"}} -->' . "\n";
	$out .= '<div class="wp-block-group is-style-card">';
	$out .= '<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"bs-icon"} -->' . "\n";
	$out .= '<figure class="wp-block-image size-full bs-icon"><img src="' . brightsmile_asset( 'icons/' . $icon . '.svg' ) . '" alt=""/></figure>' . "\n";
	$out .= '<!-- /wp:image -->' . "\n\n";
	$out .= '<!-- wp:heading {"level":3,"fontSize":"large"} -->' . "\n";
	$out .= '<h3 class="wp-block-heading has-large-font-size">' . $title . '</h3>' . "\n";
	$out .= '<!-- /wp:heading -->' . "\n\n";
	$out .= '<!-- wp:paragraph {"textColor":"contrast-2"} -->' . "\n";
	$out .= '<p class="has-contrast-2-color has-text-color">' . $text . '</p>' . "\n";
	$out .= '<!-- /wp:paragraph -->';
	if ( $link_label ) {
		$out .= "\n\n" . '<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}}} -->' . "\n";
		$out .= '<p style="font-weight:600"><a href="' . $link_url . '">' . $link_label . ' →</a></p>' . "\n";
		$out .= '<!-- /wp:paragraph -->';
	}
	$out .= '</div>' . "\n" . '<!-- /wp:group -->';
	return $out;
}

/**
 * Full-width call-to-action band.
 */
function brightsmile_cta( $title, $text ) {
	$out  = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->' . "\n";
	$out .= '<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--70)">';
	$out .= '<!-- wp:group {"align":"wide","className":"is-style-panel","gradient":"primary","textColor":"base","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->' . "\n";
	$out .= '<div class="wp-block-group alignwide is-style-panel has-base-color has-primary-gradient-background has-text-color has-background">';
	$out .= '<!-- wp:group {"style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"default"}} -->' . "\n";
	$out .= '<div class="wp-block-group">';
	$out .= '<!-- wp:heading {"textColor":"base"} -->' . "\n";
	$out .= '<h2 class="wp-block-heading has-base-color has-text-color">' . $title . '</h2>' . "\n";
	$out .= '<!-- /wp:heading -->' . "\n\n";
	$out .= '<!-- wp:paragraph {"fontSize":"large"} -->' . "\n";
	$out .= '<p class="has-large-font-size">' . $text . '</p>' . "\n";
	$out .= '<!-- /wp:paragraph -->';
	$out .= '</div>' . "\n" . '<!-- /wp:group -->' . "\n\n";
	$out .= '<!-- wp:buttons -->' . "\n" . '<div class="wp-block-buttons">';
	$out .= '<!-- wp:button {"backgroundColor":"base","textColor":"primary-dark"} -->' . "\n";
	$out .= '<div class="wp-block-button"><a class="wp-block-button__link has-primary-dark-color has-base-background-color has-text-color has-background wp-element-button" href="' . brightsmile_url( 'book-appointment' ) . '">Book an appointment</a></div>' . "\n";
	$out .= '<!-- /wp:button -->' . "\n\n";
	$out .= '<!-- wp:button {"className":"is-style-outline"} -->' . "\n";
	$out .= '<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="' . brightsmile_info( 'phone_href' ) . '">Call ' . brightsmile_info( 'phone' ) . '</a></div>' . "\n";
	$out .= '<!-- /wp:button -->';
	$out .= '</div>' . "\n" . '<!-- /wp:buttons -->';
	$out .= '</div>' . "\n" . '<!-- /wp:group -->';
	$out .= '</div>' . "\n" . '<!-- /wp:group -->';
	return $out;
}
