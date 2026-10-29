<?php
/**
 * Title: Footer with contact details
 * Slug: brightsmile/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Description: Four-column footer with about text, quick links, services and contact details.
 *
 * @package BrightSmile
 */
?>
<!-- wp:group {"align":"full","className":"bs-site-footer","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|40"}}},"gradient":"navy","textColor":"accent-soft","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull bs-site-footer has-accent-soft-color has-navy-gradient-background has-text-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"34%"} -->
<div class="wp-block-column" style="flex-basis:34%"><!-- wp:group {"className":"bs-brand","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group bs-brand"><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo brightsmile_asset( 'images/logo-mark.svg' ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:site-title {"level":0} /--></div>
<!-- /wp:group -->

<!-- wp:paragraph -->
<p>Gentle, modern dentistry for the whole family. From your child’s first check-up to a brand-new smile, our team makes every visit calm, clear and comfortable.</p>
<!-- /wp:paragraph -->

<!-- wp:social-links {"className":"is-style-logos-only","layout":{"type":"flex"}} -->
<ul class="wp-block-social-links is-style-logos-only"><!-- wp:social-link {"url":"https://facebook.com","service":"facebook"} /-->

<!-- wp:social-link {"url":"https://instagram.com","service":"instagram"} /-->

<!-- wp:social-link {"url":"https://www.google.com/maps","service":"google"} /-->

<!-- wp:social-link {"url":"https://youtube.com","service":"youtube"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"textColor":"base","fontSize":"large"} -->
<h3 class="wp-block-heading has-base-color has-text-color has-large-font-size">Quick links</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li><a href="<?php echo brightsmile_url(); ?>">Home</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo brightsmile_url( 'about-us' ); ?>">About us</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo brightsmile_url( 'services' ); ?>">Services</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo brightsmile_url( 'book-appointment' ); ?>">Book an appointment</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo brightsmile_url( 'contact' ); ?>">Contact</a></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"textColor":"base","fontSize":"large"} -->
<h3 class="wp-block-heading has-base-color has-text-color has-large-font-size">Services</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li><a href="<?php echo brightsmile_url( 'services' ); ?>">Check-ups &amp; cleaning</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo brightsmile_url( 'services' ); ?>">Teeth whitening</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo brightsmile_url( 'services' ); ?>">Dental implants</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo brightsmile_url( 'services' ); ?>">Clear aligners</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo brightsmile_url( 'services' ); ?>">Children’s dentistry</a></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"26%"} -->
<div class="wp-block-column" style="flex-basis:26%"><!-- wp:heading {"level":3,"textColor":"base","fontSize":"large"} -->
<h3 class="wp-block-heading has-base-color has-text-color has-large-font-size">Visit us</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo brightsmile_info( 'street' ); ?><br><?php echo brightsmile_info( 'city' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="<?php echo brightsmile_info( 'phone_href' ); ?>"><?php echo brightsmile_info( 'phone' ); ?></a><br><a href="mailto:<?php echo brightsmile_info( 'email' ); ?>"><?php echo brightsmile_info( 'email' ); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo brightsmile_info( 'hours_week' ); ?><br><?php echo brightsmile_info( 'hours_sat' ); ?><br><?php echo brightsmile_info( 'hours_sun' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:separator {"align":"wide","className":"is-style-wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|30"}}}} -->
<hr class="wp-block-separator alignwide has-alpha-channel-opacity is-style-wide" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--30)"/>
<!-- /wp:separator -->

<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide"><!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">© 2026 BrightSmile Dental. All rights reserved.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><a href="<?php echo brightsmile_url( 'privacy-policy' ); ?>">Privacy policy</a> · Emergency line: <a href="tel:+15559876543"><?php echo brightsmile_info( 'emergency' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
