<?php
/**
 * Front page: hero, services, process and booking.
 */

get_header();

$phone = clearcoat_option( 'clearcoat_phone' );
$email = clearcoat_option( 'clearcoat_email' );
?>

<header class="hero">
	<div class="hero-text">
		<span class="label"><?php echo esc_html( clearcoat_option( 'clearcoat_location' ) ); ?></span>
		<h1>Paint, cared for properly.</h1>
		<p class="lede">Hand washing, paint correction and ceramic coatings for daily drivers and weekend cars. We measure before we polish, and we never rush a cure.</p>
		<div class="actions">
			<a class="btn" href="#book">Book a detail</a>
			<a class="btn btn-quiet" href="#services">See pricing</a>
		</div>
	</div>
	<div class="panel" role="img" aria-label="Light moving across a polished paint panel"></div>
	<dl class="specs">
		<div><dt class="label">Cars detailed</dt><dd>2,400+</dd></div>
		<div><dt class="label">Coating warranty</dt><dd>5 years</dd></div>
		<div><dt class="label">Paint measured</dt><dd>Every panel</dd></div>
		<div><dt class="label">Rating</dt><dd>4.9 / 5</dd></div>
	</dl>
</header>

<section class="section" id="services" aria-labelledby="services-h">
	<div class="section-head">
		<span class="label">Services</span>
		<h2 id="services-h">Three ways in</h2>
		<p>Prices are for a sedan. SUVs and trucks add 20%. Every service starts with a two-bucket hand wash.</p>
	</div>
	<ul class="services">
		<li>
			<h3>Maintenance Wash</h3>
			<span class="price">$85</span>
			<p>Foam pre-wash, hand wash, wheels and tires, streak-free glass, interior vacuum and wipe-down.</p>
			<span class="label time">~1.5 hrs</span>
		</li>
		<li>
			<h3>Enhancement Detail</h3>
			<span class="price">$340</span>
			<p>Iron and clay decontamination, one-step polish to remove light swirls, and a sealant rated for 6 months.</p>
			<span class="label time">~5 hrs</span>
		</li>
		<li>
			<h3>Correction &amp; Ceramic</h3>
			<span class="price">From $1,200</span>
			<p>Paint depth readings on every panel, multi-stage correction, and a 9H ceramic coating with a 24-hour indoor cure.</p>
			<span class="label time">2 days</span>
		</li>
	</ul>
</section>

<section class="section" id="process" aria-labelledby="process-h">
	<div class="section-head">
		<span class="label">Process</span>
		<h2 id="process-h">How a correction goes</h2>
	</div>
	<ol class="steps">
		<li><h3>Inspect</h3><p>We check every panel under LED light and log paint thickness in microns.</p></li>
		<li><h3>Decontaminate</h3><p>Iron remover and clay bar lift what washing leaves behind.</p></li>
		<li><h3>Correct</h3><p>Machine polishing removes swirls while staying within safe clear coat limits.</p></li>
		<li><h3>Protect</h3><p>Coating goes on panel by panel, then cures overnight before you drive.</p></li>
	</ol>
</section>

<?php
// Anything written in the page set as the homepage appears here, above booking.
if ( is_page() ) :
	while ( have_posts() ) :
		the_post();
		if ( get_the_content() ) :
			?>
			<section class="section">
				<div class="entry"><?php the_content(); ?></div>
			</section>
			<?php
		endif;
	endwhile;
endif;
?>

<section class="section" id="book" aria-labelledby="book-h">
	<div class="book">
		<div class="book-text">
			<span class="label">Book</span>
			<h2 id="book-h">Most weeks we can fit you in within 5 days.</h2>
		</div>
		<dl class="contact">
			<?php if ( $phone ) : ?>
				<div><dt class="label">Call or text</dt><dd><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></dd></div>
			<?php endif; ?>
			<?php if ( $email ) : ?>
				<div><dt class="label">Email</dt><dd><a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a></dd></div>
			<?php endif; ?>
			<div><dt class="label">Hours</dt><dd><?php echo esc_html( clearcoat_option( 'clearcoat_hours' ) ); ?></dd></div>
		</dl>
	</div>
</section>

<?php
get_footer();
