<?php
/**
 * Title: Frequently asked questions
 * Slug: brightsmile/faq
 * Categories: brightsmile, text
 * Description: Expandable questions and answers.
 *
 * @package BrightSmile
 */
$faqs = array(
	array( 'Do you accept dental insurance?', 'Yes. We work with most major PPO plans, including Delta Dental, Cigna, Aetna, MetLife and Guardian, and we file claims for you. Not insured? Ask about our BrightSmile membership plan.' ),
	array( 'I’m nervous about the dentist. Can you help?', 'Absolutely — around a third of our patients tell us they’re anxious. We offer longer appointments, numbing gel before injections, noise-cancelling headphones and sedation options.' ),
	array( 'How quickly can I get an appointment?', 'Most new patients are seen within the same week. Emergency patients are seen the same day whenever possible — just call us first thing in the morning.' ),
	array( 'What age should my child first visit?', 'We recommend a first “happy visit” by their first birthday or when the first tooth appears. It’s short, playful and helps children feel at home.' ),
	array( 'Do you offer payment plans?', 'Yes. Treatments over $500 can be spread over 6–24 months with 0% interest, subject to approval.' ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"base","layout":{"type":"constrained","contentSize":"820px"}} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><?php echo brightsmile_section_intro( 'FAQ', 'Questions patients often ask' ); ?>

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"},"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40)"><?php foreach ( $faqs as $faq ) : ?><!-- wp:details -->
<details class="wp-block-details"><summary><?php echo $faq[0]; ?></summary><!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php echo $faq[1]; ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
