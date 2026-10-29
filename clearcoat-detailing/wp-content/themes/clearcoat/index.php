<?php
/**
 * Fallback template for pages, posts and archives.
 */

get_header();
?>

<div class="content">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( is_singular() ) : ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php else : ?>
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<span class="label"><?php echo esc_html( get_the_date() ); ?></span>
				<?php endif; ?>

				<?php
				if ( is_singular() ) {
					the_content();
				} else {
					the_excerpt();
				}
				?>
			</article>
		<?php endwhile; ?>

		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<h1><?php esc_html_e( 'Nothing here yet', 'clearcoat' ); ?></h1>
		<p><?php esc_html_e( 'This page could not be found. Try the homepage instead.', 'clearcoat' ); ?></p>
	<?php endif; ?>
</div>

<?php
get_footer();
