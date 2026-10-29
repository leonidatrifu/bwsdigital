<?php
/**
 * Title: Contact form and map
 * Slug: brightsmile/contact-form-map
 * Categories: brightsmile, contact
 * Description: Message form (BrightSmile Appointments plugin) next to a map.
 * Viewport width: 1400
 *
 * @package BrightSmile
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|70"}}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"55%"} -->
<div class="wp-block-column" style="flex-basis:55%"><!-- wp:group {"className":"is-style-card","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card"><!-- wp:heading -->
<h2 class="wp-block-heading">Send us a message</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color">Questions about a treatment, insurance or prices? Write to us and a member of our team will get back to you within one working day.</p>
<!-- /wp:paragraph -->

<!-- wp:brightsmile/contact-form /--></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Find us</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color">We’re two minutes from the Capitol Avenue bus stop, with free patient parking behind the building and step-free access.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<div class="bs-map"><iframe title="Map showing the BrightSmile Dental location" src="https://www.openstreetmap.org/export/embed.html?bbox=-89.6620%2C39.7760%2C-89.6380%2C39.7880&amp;layer=mapnik&amp;marker=39.7817%2C-89.6501" loading="lazy"></iframe></div>
<!-- /wp:html --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
