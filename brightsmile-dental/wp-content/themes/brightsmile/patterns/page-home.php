<?php
/**
 * Title: Page: Home
 * Slug: brightsmile/page-home
 * Categories: brightsmile-pages
 * Post Types: page
 * Block Types: core/post-content
 * Description: Complete home page: hero, numbers, services, why us, steps, reviews and booking banner.
 * Viewport width: 1400
 *
 * @package BrightSmile
 */
foreach ( array( 'hero', 'stats', 'services-preview', 'why-us', 'steps', 'testimonials', 'cta' ) as $brightsmile_section ) {
	echo brightsmile_pattern( $brightsmile_section );
}
