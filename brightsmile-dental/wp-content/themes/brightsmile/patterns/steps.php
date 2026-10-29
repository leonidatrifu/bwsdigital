<?php
/**
 * Title: Your first visit (3 steps)
 * Slug: brightsmile/steps
 * Categories: brightsmile
 * Description: Three numbered steps explaining how booking works.
 *
 * @package BrightSmile
 */
$steps = array(
	array( '01', 'Book online in a minute', 'Pick a service and a time that suits you. We’ll confirm by phone or email within one working day.' ),
	array( '02', 'Meet your dentist', 'A relaxed consultation, a full check-up and digital scans — with everything explained in plain language.' ),
	array( '03', 'Get your personal plan', 'Leave with a clear treatment plan and price. No pressure, no surprises, just a healthier smile.' ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"base-2","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-2-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><?php echo brightsmile_section_intro( 'How it works', 'Your first visit, step by step' ); ?>

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"16rem"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50)"><?php foreach ( $steps as $step ) : ?><!-- wp:group {"className":"is-style-card","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"700"}},"textColor":"accent","fontSize":"xx-large"} -->
<p class="has-accent-color has-text-color has-xx-large-font-size" style="font-weight:700"><?php echo $step[0]; ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size"><?php echo $step[1]; ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php echo $step[2]; ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
