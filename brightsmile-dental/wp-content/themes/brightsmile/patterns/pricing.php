<?php
/**
 * Title: Price list
 * Slug: brightsmile/pricing
 * Categories: brightsmile, services
 * Description: Two-column price list for common treatments.
 * Viewport width: 1400
 *
 * @package BrightSmile
 */
$columns = array(
	array(
		'General &amp; preventive',
		array(
			array( 'New patient exam &amp; X-rays', '$89' ),
			array( 'Hygiene clean &amp; polish', '$95' ),
			array( 'Child check-up (under 12)', '$59' ),
			array( 'Tooth-coloured filling', 'from $140' ),
			array( 'Emergency appointment', '$120' ),
		),
	),
	array(
		'Cosmetic &amp; restorative',
		array(
			array( 'In-office whitening', '$399' ),
			array( 'Take-home whitening kit', '$249' ),
			array( 'Ceramic crown (same day)', 'from $950' ),
			array( 'Dental implant incl. crown', 'from $2,450' ),
			array( 'Clear aligners (full case)', 'from $3,200' ),
		),
	),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"base-2","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-2-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><?php echo brightsmile_section_intro( 'Transparent pricing', 'Clear prices, no surprises', 'Prices below are guides for self-paying patients. You will always receive a written estimate before treatment. 0% payment plans available.' ); ?>

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"blockGap":{"left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50)"><?php foreach ( $columns as $column ) : ?><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-card","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card"><!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size"><?php echo $column[0]; ?></h3>
<!-- /wp:heading -->

<?php foreach ( $column[1] as $row ) : ?><!-- wp:group {"className":"bs-price-row","style":{"spacing":{"margin":{"top":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group bs-price-row" style="margin-top:0"><!-- wp:paragraph -->
<p><?php echo $row[0]; ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"700"}},"textColor":"primary"} -->
<p class="has-primary-color has-text-color" style="font-weight:700"><?php echo $row[1]; ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<?php endforeach; ?></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
