<?php if ( get_header_image() ) : ?>
	<header class="main-header" style="background-image: url(<?php header_image(); ?>);">
	<?php else : ?>
		<header class="main-header no-cover">
		<?php endif; ?>
		<nav class="main-nav overlay clearfix">
			<?php if ( has_custom_logo() ) : ?>
				<a class="blog-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php $custom_logo_id = get_theme_mod( 'custom_logo' ); $image = wp_get_attachment_image_src( $custom_logo_id , 'full' ); echo $image[0]; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
			<?php endif; ?>
			<?php if ( has_nav_menu( 'top-menu' ) ) : ?>
				<a class="menu-button icon-menu" href="#"><span class="word">Menu</span></a>
			<?php endif; ?>
		</nav>

		<div class="vertical">
			<div class="main-header-content inner">
				<h1 class="page-title"><?php bloginfo( 'name' ); ?></h1>
				<h2 class="page-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
		</div>
		<a class="scroll-down icon-arrow-left" href="#content" data-offset="-45"><span class="hidden">Scroll Down</span></a>
	</header>