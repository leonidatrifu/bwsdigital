<?php
/**
 * Title: Clinic in numbers
 * Slug: brightsmile/stats
 * Categories: brightsmile
 * Description: Four key numbers about the clinic.
 *
 * @package BrightSmile
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:group {"align":"wide","layout":{"type":"grid","columnCount":4,"minimumColumnWidth":"12rem"}} -->
<div class="wp-block-group alignwide"><?php
$stats = array(
	array( '15+', 'Years caring for Springfield' ),
	array( '12k', 'Happy patients treated' ),
	array( '8', 'Dentists &amp; specialists' ),
	array( '4.9★', 'Average patient rating' ),
);
foreach ( $stats as $stat ) :
	?><!-- wp:group {"className":"bs-stat","layout":{"type":"default"}} -->
<div class="wp-block-group bs-stat"><!-- wp:heading {"textAlign":"center","level":3,"textColor":"primary","fontSize":"xx-large"} -->
<h3 class="wp-block-heading has-text-align-center has-primary-color has-text-color has-xx-large-font-size"><?php echo $stat[0]; ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"contrast-2"} -->
<p class="has-text-align-center has-contrast-2-color has-text-color"><?php echo $stat[1]; ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
