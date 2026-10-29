<?php
/**
 * Title: Patient testimonials
 * Slug: brightsmile/testimonials
 * Categories: brightsmile, testimonials
 * Description: Three review cards with star ratings.
 *
 * @package BrightSmile
 */
$reviews = array(
	array( 'I’ve been terrified of dentists since childhood. Dr. Carter talked me through everything and I honestly didn’t feel a thing. I actually look forward to my check-ups now.', 'Sarah M.', 'Patient since 2021' ),
	array( 'My clear aligners finished two months early and the result is incredible. Booking online was easy and the team always ran on time.', 'James R.', 'Clear aligner treatment' ),
	array( 'Our kids love it here — the treasure box helps! The staff are so patient and explain things in a way children understand.', 'Priya &amp; Tom K.', 'Family patients' ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><?php echo brightsmile_section_intro( 'Kind words', 'Loved by patients of all ages' ); ?>

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"18rem"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50)"><?php foreach ( $reviews as $review ) : ?><!-- wp:group {"className":"is-style-card","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card"><!-- wp:paragraph {"className":"bs-stars","fontSize":"large"} -->
<p class="bs-stars has-large-font-size">★★★★★</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>“<?php echo $review[0]; ?>”</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--40)"><strong><?php echo $review[1]; ?></strong><br><span class="has-contrast-2-color"><?php echo $review[2]; ?></span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
