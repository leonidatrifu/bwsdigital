<?php
/**
 * Title: Home hero
 * Slug: brightsmile/hero
 * Categories: brightsmile, banner
 * Description: Big headline with booking buttons and an illustration.
 * Viewport width: 1400
 *
 * @package BrightSmile
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"gradient":"hero","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-hero-gradient-background has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"54%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:54%"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow">Family &amp; cosmetic dentistry</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Healthy smiles start with <em>gentle</em> care</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"large"} -->
<p class="has-contrast-2-color has-text-color has-large-font-size">Modern, pain-free dentistry for adults and children in the heart of Springfield. Same-week appointments, clear prices and a team that genuinely listens.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo brightsmile_url( 'book-appointment' ); ?>">Book an appointment</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo brightsmile_url( 'services' ); ?>">Explore our services</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size"><span class="bs-stars">★★★★★</span> <strong>4.9/5</strong> from 1,200+ patient reviews · Most insurance plans accepted</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"bs-hero-art"} -->
<figure class="wp-block-image size-full bs-hero-art"><img src="<?php echo brightsmile_asset( 'images/hero.svg' ); ?>" alt="Illustration of a happy, healthy tooth with a toothbrush"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
