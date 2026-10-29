<?php
/**
 * Title: Why choose us (image + checklist)
 * Slug: brightsmile/why-us
 * Categories: brightsmile, about
 * Description: Two columns with an illustration and the clinic's key benefits.
 * Viewport width: 1400
 *
 * @package BrightSmile
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|70"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-rounded-lg"} -->
<figure class="wp-block-image size-full is-style-rounded-lg"><img src="<?php echo brightsmile_asset( 'images/clinic.svg' ); ?>" alt="Bright, modern treatment room at BrightSmile Dental"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow">Why patients choose us</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Dentistry that feels different — in the best way</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color">We built BrightSmile around one simple idea: nobody should dread going to the dentist. Every visit starts with a conversation, not a drill.</p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-checklist"} -->
<ul class="wp-block-list is-style-checklist"><!-- wp:list-item -->
<li><strong>Pain-free techniques</strong> — numbing gel, gentle tools and sedation options.</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong>Latest technology</strong> — low-dose digital X-rays and 3D intraoral scans.</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong>Clear, upfront pricing</strong> — a written plan before any treatment.</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong>Evening &amp; Saturday hours</strong> — care that fits around your life.</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo brightsmile_url( 'about-us' ); ?>">Meet our team</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
