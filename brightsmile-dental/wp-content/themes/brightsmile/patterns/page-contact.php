<?php
/**
 * Title: Page: Contact
 * Slug: brightsmile/page-contact
 * Categories: brightsmile-pages
 * Post Types: page
 * Block Types: core/post-content
 * Description: Contact cards, message form and map.
 * Viewport width: 1400
 *
 * @package BrightSmile
 */
echo brightsmile_page_header( 'Contact', 'We’d love to hear from you', 'Call, email or drop by — or send us a message below and we’ll get back to you within one working day.' ) . "\n\n";
foreach ( array( 'contact-cards', 'contact-form-map' ) as $brightsmile_section ) {
	echo brightsmile_pattern( $brightsmile_section );
}
