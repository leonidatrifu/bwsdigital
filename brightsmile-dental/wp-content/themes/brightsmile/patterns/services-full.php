<?php
/**
 * Title: All services (8 cards)
 * Slug: brightsmile/services-full
 * Categories: brightsmile, services
 * Description: Grid of every treatment with icon and description.
 * Viewport width: 1400
 *
 * @package BrightSmile
 */
$cards = array(
	array( 'tooth', 'Check-ups &amp; hygiene', 'Comprehensive exam, digital X-rays, oral-cancer screening and a gentle scale &amp; polish. Recommended every six months.' ),
	array( 'sparkle', 'Teeth whitening', 'Brighten your smile by up to eight shades with in-office laser whitening or custom take-home trays.' ),
	array( 'implant', 'Dental implants', 'Titanium implants topped with a natural-looking crown — a permanent fix for one tooth or a whole arch.' ),
	array( 'aligner', 'Orthodontics &amp; aligners', 'Clear aligners and modern braces for teens and adults, planned with a 3D preview of your new smile.' ),
	array( 'child', 'Children’s dentistry', 'Friendly first visits, fluoride, fissure sealants and habit coaching for kids from age one.' ),
	array( 'root', 'Root canal therapy', 'Save an infected tooth with comfortable, microscope-guided treatment — usually in a single visit.' ),
	array( 'crown', 'Crowns, bridges &amp; veneers', 'Same-day ceramic crowns and handcrafted veneers that restore strength and transform your smile.' ),
	array( 'emergency', 'Emergency dentistry', 'Severe pain, swelling or a knocked-out tooth? Call us — we reserve same-day emergency appointments.' ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"align":"wide","layout":{"type":"grid","columnCount":4,"minimumColumnWidth":"15rem"}} -->
<div class="wp-block-group alignwide"><?php
foreach ( $cards as $card ) {
	echo brightsmile_icon_card( $card[0], $card[1], $card[2], 'Book this treatment', brightsmile_url( 'book-appointment' ) ) . "\n\n";
}
?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
