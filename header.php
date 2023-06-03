<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package capside
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="https://fonts.cdnfonts.com/css/helvetica-neue-9" rel="stylesheet">
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
	
	<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
	<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php // wp_body_open(); ?>
<div id="page" class="site">
	<header id="masthead" class="site-header fixed-top">
		<div class="container-xxl">
			<div class="row align-items-center">
				<div class="col-6 col-sm-6 col-md-4 col-lg-4 site-branding">
					<?php the_custom_logo(); ?>
				</div>
				<nav class="col-6 col-sm-6 col-md-8 col-lg-8 d-flex align-items-center justify-content-end">
					<div class="d-none d-md-block d-lg-block">
						<?php
							wp_nav_menu([
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'container' => 'ul',
								'menu_class' => 'nav d-flex align-items-center'
							]);
						?>
					</div>
				</nav>
			</div>
		</div>
	</header>