<?php
/**
 * Title: Header with top bar
 * Slug: brightsmile/header
 * Categories: header
 * Block Types: core/template-part/header
 * Description: Top info bar, logo, site title, main menu and booking button.
 *
 * @package BrightSmile
 */
?>
<!-- wp:group {"align":"full","className":"bs-site-header","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull bs-site-header"><!-- wp:group {"align":"full","className":"bs-topbar","style":{"spacing":{"padding":{"top":"0.45rem","bottom":"0.45rem"}}},"backgroundColor":"primary-dark","textColor":"base","fontSize":"small","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull bs-topbar has-base-color has-primary-dark-background-color has-text-color has-background has-small-font-size" style="padding-top:0.45rem;padding-bottom:0.45rem"><!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide"><!-- wp:paragraph -->
<p><?php echo brightsmile_info( 'street' ); ?>, <?php echo brightsmile_info( 'city' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"bs-topbar__secondary","style":{"spacing":{"blockGap":"1.5rem"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group bs-topbar__secondary"><!-- wp:paragraph -->
<p><?php echo brightsmile_info( 'hours_week' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="<?php echo brightsmile_info( 'phone_href' ); ?>">Call <?php echo brightsmile_info( 'phone' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"className":"bs-brand","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group bs-brand"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom"} -->
<figure class="wp-block-image size-full"><a href="<?php echo brightsmile_url(); ?>"><img src="<?php echo brightsmile_asset( 'images/logo-mark.svg' ); ?>" alt="BrightSmile Dental logo"/></a></figure>
<!-- /wp:image -->

<!-- wp:site-title {"level":0} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:navigation {"overlayBackgroundColor":"base","overlayTextColor":"contrast","layout":{"type":"flex","justifyContent":"right"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} /-->

<!-- wp:buttons {"className":"bs-header-cta"} -->
<div class="wp-block-buttons bs-header-cta"><!-- wp:button {"style":{"spacing":{"padding":{"top":"0.7rem","bottom":"0.7rem","left":"1.25rem","right":"1.25rem"}}}} -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo brightsmile_url( 'book-appointment' ); ?>" style="padding-top:0.7rem;padding-right:1.25rem;padding-bottom:0.7rem;padding-left:1.25rem">Book Appointment</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
