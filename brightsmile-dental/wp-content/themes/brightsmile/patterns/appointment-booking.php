<?php
/**
 * Title: Appointment booking (form + sidebar)
 * Slug: brightsmile/appointment-booking
 * Categories: brightsmile, contact
 * Description: Appointment form (BrightSmile Appointments plugin) with opening hours and what to expect.
 * Viewport width: 1400
 *
 * @package BrightSmile
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|70"}}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"62%"} -->
<div class="wp-block-column" style="flex-basis:62%"><!-- wp:group {"className":"is-style-card","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card"><!-- wp:heading -->
<h2 class="wp-block-heading">Request your appointment</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color">Choose a treatment and your preferred time. We’ll call or email you to confirm — usually within a few hours.</p>
<!-- /wp:paragraph -->

<!-- wp:brightsmile/appointment-form /--></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-panel","backgroundColor":"base-2","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-panel has-base-2-background-color has-background"><!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size">What to expect</h3>
<!-- /wp:heading -->

<!-- wp:list {"className":"is-style-checklist"} -->
<ul class="wp-block-list is-style-checklist"><!-- wp:list-item -->
<li>Confirmation by phone or email within one working day</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Please arrive 10 minutes early for your first visit</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Bring your insurance card and a list of medications</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Free cancellation up to 24 hours before</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:separator {"className":"is-style-wide"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size">Opening hours</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo brightsmile_info( 'hours_week' ); ?><br><?php echo brightsmile_info( 'hours_sat' ); ?><br><?php echo brightsmile_info( 'hours_sun' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:separator {"className":"is-style-wide"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size">Prefer to call?</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Our front desk is happy to help: <a href="<?php echo brightsmile_info( 'phone_href' ); ?>"><strong><?php echo brightsmile_info( 'phone' ); ?></strong></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size">In severe pain? Call our emergency line on <?php echo brightsmile_info( 'emergency' ); ?> instead of booking online.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
