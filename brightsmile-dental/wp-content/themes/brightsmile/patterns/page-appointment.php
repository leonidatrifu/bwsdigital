<?php
/**
 * Title: Page: Book an appointment
 * Slug: brightsmile/page-appointment
 * Categories: brightsmile-pages
 * Post Types: page
 * Block Types: core/post-content
 * Description: Appointment request form with opening hours and FAQ.
 * Viewport width: 1400
 *
 * @package BrightSmile
 */
echo brightsmile_page_header( 'Book an appointment', 'Schedule your visit in under a minute', 'New and existing patients welcome. Pick a treatment and a time that suits you — we’ll take care of the rest.' ) . "\n\n";
foreach ( array( 'appointment-booking', 'steps' ) as $brightsmile_section ) {
	echo brightsmile_pattern( $brightsmile_section );
}
