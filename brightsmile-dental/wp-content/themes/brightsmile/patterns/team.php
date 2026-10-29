<?php
/**
 * Title: Meet the team
 * Slug: brightsmile/team
 * Categories: brightsmile, team
 * Description: Four team members with photo, role and short bio.
 *
 * @package BrightSmile
 */
$team = array(
	array( 'team-1', 'Dr. Emily Carter', 'Founder &amp; General Dentist', 'DDS with 20 years of experience and a special interest in nervous patients.' ),
	array( 'team-2', 'Dr. Marcus Lee', 'Implant Specialist', 'Board-certified in implantology; has placed more than 3,000 implants.' ),
	array( 'team-3', 'Dr. Sofia Alvarez', 'Orthodontist', 'Certified clear-aligner provider who loves a perfectly aligned smile.' ),
	array( 'team-4', 'Dr. Daniel Okafor', 'Pediatric Dentist', 'Makes visits fun for kids — and calm for their parents.' ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><?php echo brightsmile_section_intro( 'Our team', 'Meet the people behind your smile', 'Experienced, friendly and always learning — our dentists complete more than 50 hours of advanced training every year.' ); ?>

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"grid","columnCount":4,"minimumColumnWidth":"13rem"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50)"><?php foreach ( $team as $member ) : ?><!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"bs-avatar"} -->
<figure class="wp-block-image size-full bs-avatar"><img src="<?php echo brightsmile_asset( 'images/' . $member[0] . '.svg' ); ?>" alt="<?php echo esc_attr( wp_strip_all_tags( $member[1] ) ); ?>"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size"><?php echo $member[1]; ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0.25rem"}}},"textColor":"primary","fontSize":"small"} -->
<p class="has-primary-color has-text-color has-small-font-size" style="margin-top:0.25rem;font-weight:600"><?php echo $member[2]; ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size"><?php echo $member[3]; ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
