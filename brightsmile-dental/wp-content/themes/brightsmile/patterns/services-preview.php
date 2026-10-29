<?php
/**
 * Title: Services overview (6 cards)
 * Slug: brightsmile/services-preview
 * Categories: brightsmile, services
 * Description: Section intro and six service cards linking to the Services page.
 * Viewport width: 1400
 *
 * @package BrightSmile
 */
$services_url = brightsmile_url( 'services' );
$cards        = array(
	array( 'tooth', 'Check-ups &amp; cleaning', 'Thorough exams, digital X-rays and gentle hygiene visits that keep problems from starting.' ),
	array( 'sparkle', 'Teeth whitening', 'Professional in-office and take-home whitening for a safe, noticeably brighter smile.' ),
	array( 'implant', 'Dental implants', 'Permanent, natural-looking replacements for missing teeth, planned with 3D imaging.' ),
	array( 'aligner', 'Clear aligners', 'Straighten teeth discreetly with custom, nearly invisible aligners — no metal brackets.' ),
	array( 'child', 'Children’s dentistry', 'Fun, fear-free visits that help kids build healthy habits from their very first tooth.' ),
	array( 'emergency', 'Emergency care', 'Toothache or broken tooth? We keep same-day slots open for urgent problems.' ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"base-2","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-2-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><?php echo brightsmile_section_intro( 'What we do', 'Complete dental care under one roof', 'Whether it’s a routine clean or a full smile makeover, you’ll find every treatment your family needs in one friendly practice.' ); ?>

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"18rem"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50)"><?php
foreach ( $cards as $card ) {
	echo brightsmile_icon_card( $card[0], $card[1], $card[2], 'Learn more', $services_url ) . "\n\n";
}
?></div>
<!-- /wp:group -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo $services_url; ?>">View all services &amp; prices</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
