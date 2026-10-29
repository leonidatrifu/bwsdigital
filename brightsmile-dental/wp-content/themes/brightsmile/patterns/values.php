<?php
/**
 * Title: Our values (4 cards)
 * Slug: brightsmile/values
 * Categories: brightsmile, about
 * Description: Four value cards with icons.
 *
 * @package BrightSmile
 */
$values = array(
	array( 'heart', 'Gentle by default', 'Comfort comes first. We go at your pace and offer sedation for anxious patients.' ),
	array( 'tech', 'Modern technology', 'Digital X-rays, 3D scanning and same-day crowns mean fewer, faster visits.' ),
	array( 'tag', 'Honest pricing', 'You get a written estimate before treatment and we help you use your insurance.' ),
	array( 'family', 'For the whole family', 'From toddlers to grandparents — everyone can be seen at one friendly practice.' ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"base-2","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-2-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><?php echo brightsmile_section_intro( 'What we stand for', 'The values behind every visit' ); ?>

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"grid","columnCount":4,"minimumColumnWidth":"14rem"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50)"><?php
foreach ( $values as $value ) {
	echo brightsmile_icon_card( $value[0], $value[1], $value[2] ) . "\n\n";
}
?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
