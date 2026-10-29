<?php
/**
 * Title: Page: Services
 * Slug: brightsmile/page-services
 * Categories: brightsmile-pages
 * Post Types: page
 * Block Types: core/post-content
 * Description: All treatments, price list, FAQ and booking banner.
 * Viewport width: 1400
 *
 * @package BrightSmile
 */
echo brightsmile_page_header( 'Services', 'Treatments for every smile', 'From routine check-ups to implants and clear aligners, all your dental care is delivered under one roof by our specialist team.' ) . "\n\n";
foreach ( array( 'services-full', 'pricing', 'faq', 'cta' ) as $brightsmile_section ) {
	echo brightsmile_pattern( $brightsmile_section );
}
