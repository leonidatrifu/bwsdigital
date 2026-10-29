<?php
/**
 * Title: Contact details (4 cards)
 * Slug: brightsmile/contact-cards
 * Categories: brightsmile, contact
 * Description: Address, phone, email and opening hours.
 *
 * @package BrightSmile
 */
$cards = array(
	array( 'pin', 'Visit us', brightsmile_info( 'street' ) . '<br>' . brightsmile_info( 'city' ) . '<br>Free parking behind the building' ),
	array( 'phone', 'Call us', '<a href="' . brightsmile_info( 'phone_href' ) . '">' . brightsmile_info( 'phone' ) . '</a><br>Emergencies: ' . brightsmile_info( 'emergency' ) ),
	array( 'mail', 'Email us', '<a href="mailto:' . brightsmile_info( 'email' ) . '">' . brightsmile_info( 'email' ) . '</a><br>We reply within one working day' ),
	array( 'clock', 'Opening hours', brightsmile_info( 'hours_week' ) . '<br>' . brightsmile_info( 'hours_sat' ) . '<br>' . brightsmile_info( 'hours_sun' ) ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|40"}}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:group {"align":"wide","layout":{"type":"grid","columnCount":4,"minimumColumnWidth":"14rem"}} -->
<div class="wp-block-group alignwide"><?php
foreach ( $cards as $card ) {
	echo brightsmile_icon_card( $card[0], $card[1], $card[2] ) . "\n\n";
}
?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
