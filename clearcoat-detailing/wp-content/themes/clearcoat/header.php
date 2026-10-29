<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'clearcoat' ); ?></a>
<div class="wrap">
	<nav class="site-nav" aria-label="<?php esc_attr_e( 'Main', 'clearcoat' ); ?>">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'depth'          => 1,
				'fallback_cb'    => 'clearcoat_menu_fallback',
			)
		);
		?>
	</nav>
	<main id="main">
