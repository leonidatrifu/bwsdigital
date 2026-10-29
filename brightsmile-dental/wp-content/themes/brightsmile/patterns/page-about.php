<?php
/**
 * Title: Page: About us
 * Slug: brightsmile/page-about
 * Categories: brightsmile-pages
 * Post Types: page
 * Block Types: core/post-content
 * Description: Story, values, team and booking banner.
 * Viewport width: 1400
 *
 * @package BrightSmile
 */
echo brightsmile_page_header( 'About us', 'Caring for Springfield’s smiles since 2009', 'We’re an independent, family-run practice that combines a warm welcome with the latest dental technology.' ) . "\n\n";
foreach ( array( 'about-story', 'stats', 'values', 'team', 'cta' ) as $brightsmile_section ) {
	echo brightsmile_pattern( $brightsmile_section );
}
